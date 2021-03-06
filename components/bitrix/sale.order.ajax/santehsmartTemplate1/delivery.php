<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

?>

    <script type="text/javascript">
        function fShowStore(id, showImages, formWidth, siteId) {
            var strUrl = '<?=$templateFolder?>' + '/map.php';
            var strUrlPost = 'delivery=' + id + '&showImages=' + showImages + '&siteId=' + siteId;

            var storeForm = new BX.CDialog({
                'title': '<?=GetMessage('SOA_ORDER_GIVE')?>',
                head: '',
                'content_url': strUrl,
                'content_post': strUrlPost,
                'width': formWidth,
                'height': 450,
                'resizable': false,
                'draggable': false
            });

            var button = [
                {
                    title: '<?=GetMessage('SOA_POPUP_SAVE')?>',
                    id: 'crmOk',
                    'action': function () {
                        GetBuyerStore();
                        BX.WindowManager.Get().Close();
                    }
                },
                BX.CDialog.btnCancel
            ];
            storeForm.ClearButtons();
            storeForm.SetButtons(button);
            storeForm.Show();
        }

        function GetBuyerStore() {
            BX('BUYER_STORE').value = BX('POPUP_STORE_ID').value;
            //BX('ORDER_DESCRIPTION').value = '<?=GetMessage("SOA_ORDER_GIVE_TITLE")?>: '+BX('POPUP_STORE_NAME').value;
            BX('store_desc').innerHTML = BX('POPUP_STORE_NAME').value;
            BX.show(BX('select_store'));
        }

        function showExtraParamsDialog(deliveryId) {
            var strUrl = '<?=$templateFolder?>' + '/delivery_extra_params.php';
            var formName = 'extra_params_form';
            var strUrlPost = 'deliveryId=' + deliveryId + '&formName=' + formName;

            if (window.BX.SaleDeliveryExtraParams) {
                for (var i in window.BX.SaleDeliveryExtraParams) {
                    strUrlPost += '&' + encodeURI(i) + '=' + encodeURI(window.BX.SaleDeliveryExtraParams[i]);
                }
            }

            var paramsDialog = new BX.CDialog({
                'title': '<?=GetMessage('SOA_ORDER_DELIVERY_EXTRA_PARAMS')?>',
                head: '',
                'content_url': strUrl,
                'content_post': strUrlPost,
                'width': 500,
                'height': 200,
                'resizable': true,
                'draggable': false
            });

            var button = [
                {
                    title: '<?=GetMessage('SOA_POPUP_SAVE')?>',
                    id: 'saleDeliveryExtraParamsOk',
                    'action': function () {
                        insertParamsToForm(deliveryId, formName);
                        BX.WindowManager.Get().Close();
                    }
                },
                BX.CDialog.btnCancel
            ];

            paramsDialog.ClearButtons();
            paramsDialog.SetButtons(button);
            //paramsDialog.adjustSizeEx();
            paramsDialog.Show();
        }

        function insertParamsToForm(deliveryId, paramsFormName) {
            var orderForm = BX("ORDER_FORM"),
                paramsForm = BX(paramsFormName);
            wrapDivId = deliveryId + "_extra_params";

            var wrapDiv = BX(wrapDivId);
            window.BX.SaleDeliveryExtraParams = {};

            if (wrapDiv)
                wrapDiv.parentNode.removeChild(wrapDiv);

            wrapDiv = BX.create('div', {props: {id: wrapDivId}});

            for (var i = paramsForm.elements.length - 1; i >= 0; i--) {
                var input = BX.create('input', {
                        props: {
                            type: 'hidden',
                            name: 'DELIVERY_EXTRA[' + deliveryId + '][' + paramsForm.elements[i].name + ']',
                            value: paramsForm.elements[i].value
                        }
                    }
                );

                window.BX.SaleDeliveryExtraParams[paramsForm.elements[i].name] = paramsForm.elements[i].value;

                wrapDiv.appendChild(input);
            }

            orderForm.appendChild(wrapDiv);

            BX.onCustomEvent('onSaleDeliveryGetExtraParams', [window.BX.SaleDeliveryExtraParams]);
        }
        function showCur(id) {
            window.alert(id);
        }
    </script>

    <input type="hidden" name="BUYER_STORE" id="BUYER_STORE" value="<?= $arResult["BUYER_STORE"] ?>"/>

<?
if (!empty($arResult["DELIVERY"])) {
    ?>
    <div class="group group--el underlined">
        <?
        ksort($arResult["DELIVERY"]);//sort by delivery id
        foreach ($arResult["DELIVERY"] as $delivery_id => $arDelivery) {
            if (intval($delivery_id) != 62) {
                ?>
                <div class="col col-4-tl">
                    <div class="radio<? if ($arDelivery["CHECKED"] == "Y") echo " radio--selected"; ?>"
                         data-qcontent="element__buttons__radio">
                        <input class="radio__input" type="radio"
                               id="ID_DELIVERY_ID_<?= $arDelivery["ID"] ?>"
                               value="<?= $arDelivery["ID"] ?>"
                               name="<?= htmlspecialcharsbx($arDelivery["FIELD_NAME"]) ?>"<? if ($arDelivery["CHECKED"] == "Y") echo " checked"; ?>
                               onclick="submitForm();"/>
                        <label class="radio__label"
                               for="ID_DELIVERY_ID_<?= $arDelivery["ID"] ?>"><?= htmlspecialcharsbx($arDelivery["NAME"]) ?></label>
                    </div>
                </div>
                <?
            }
        }
        ?>
    </div>
    <div class="order__points">
        <?
        foreach ($arResult["DELIVERY"] as $delivery_id => $arDelivery) {
            if (intval($delivery_id) != 62) {
                ?>
                <div class="group<? if ($arDelivery["CHECKED"] == "Y") echo " group--el"; ?>">
                    <?
                    if ($delivery_id == 59):?>
                        <div class="col col-4-tl">
                            <div id='curier'><label>Адрес для доставки курьером:<br><textarea
                                            name="<?= $arDelivery["CHECKED"] == 'Y' ? 'ORDER_PROP_7' : '' ?>"
                                            length="15" <?= $arDelivery["CHECKED"] == 'Y' ? '' : 'readonly' ?>></textarea></label><br>
                            </div>
                        </div>
                    <? endif; ?>
                    <? if ($delivery_id == 58) $APPLICATION->IncludeComponent(
                        "orangerocket:delivery_points_forOrder",
                        "",
                        Array(
                            "IBLOC_ID" => 18,
                            "CHECKED" => $arDelivery["CHECKED"]
                        ),
                        false
                    ); ?>
                </div>
                <?
            }
        } ?>
    </div>
    <?
}
?>