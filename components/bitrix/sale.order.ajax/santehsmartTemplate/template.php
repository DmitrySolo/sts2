<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if ($USER->IsAuthorized() || $arParams["ALLOW_AUTO_REGISTER"] == "Y") {
    if ($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y") {
        if (strlen($arResult["REDIRECT_URL"]) > 0) {
            $APPLICATION->RestartBuffer();
            ?>
            <script type="text/javascript">
                window.top.location.href = '<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';
            </script>
            <?
            die();
        }

    }
}

$APPLICATION->SetAdditionalCSS($templateFolder."/style.css");
$this->addExternalJs($templateFolder . "/script.js");

CJSCore::Init(array('fx', 'popup', 'window', 'ajax'));
?>

<div class="page page--order">
    <div class="page__content page__contentundefined" data-qcontent="level__page">
        <div class="group">
            <div class="col col-12-tl">
                <h1 class="page__title">Оформление заказа</h1>
            </div>
        </div>
        <main><!-- split modules/order -->
            <div id="order_form_div" class="order-checkout order__content" data-qcontent="module__order">
                <NOSCRIPT>
                    <div class="errortext"><?= GetMessage("SOA_NO_JS") ?></div>
                </NOSCRIPT>

                <?
                if (!function_exists("getColumnName")) {
                    function getColumnName($arHeader)
                    {
                        return (strlen($arHeader["name"]) > 0) ? $arHeader["name"] : GetMessage("SALE_" . $arHeader["id"]);
                    }
                }

                if (!function_exists("cmpBySort")) {
                    function cmpBySort($array1, $array2)
                    {
                        if (!isset($array1["SORT"]) || !isset($array2["SORT"]))
                            return -1;

                        if ($array1["SORT"] > $array2["SORT"])
                            return 1;

                        if ($array1["SORT"] < $array2["SORT"])
                            return -1;

                        if ($array1["SORT"] == $array2["SORT"])
                            return 0;
                    }
                }
                ?>
                <div class="bx_order_make group group--md">
                    <?
                    if (!$USER->IsAuthorized() && $arParams["ALLOW_AUTO_REGISTER"] == "N") {
                        if (!empty($arResult["ERROR"])) {
                            foreach ($arResult["ERROR"] as $v)
                                echo ShowError($v);
                        } elseif (!empty($arResult["OK_MESSAGE"])) {
                            foreach ($arResult["OK_MESSAGE"] as $v)
                                echo ShowNote($v);
                        }

                        include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/auth.php");
                    } else {
                        if ($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y") {
                            if (strlen($arResult["REDIRECT_URL"]) == 0) {
                                include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/confirm.php");
                            }
                        } else {
                            ?>
                            <script type="text/javascript">
                                var BXFormPosting = false;
                                function submitForm(val) {
                                    if (BXFormPosting === true)
                                        return true;

                                    BXFormPosting = true;
                                    if (val != 'Y') {
                                        BX('confirmorder').value = 'N';

                                        var orderForm = BX('ORDER_FORM');
                                        BX.showWait();

                                        BX.ajax.submit(orderForm, ajaxResult);
                                    } else {
                                        var orderForm = BX('ORDER_FORM');
                                        BX.showWait();

                                        window.orderUIObject.clickOrderSaveAction(function () {
                                            BX.ajax.submit(orderForm, ajaxResult);
                                        });
                                    }

                                    return true;
                                }

                                function ajaxResult(res) {
                                    try {
                                        var json = JSON.parse(res);
                                        BX.closeWait();

                                        if (json.error) {
                                            BXFormPosting = false;
                                            return;
                                        }
                                        else if (json.redirect) {
                                            window.top.location.href = json.redirect;
                                        }
                                    }
                                    catch (e) {
                                        BXFormPosting = false;
                                        BX('order_form_content').innerHTML = res;
                                    }
                                    window.orderUIObject.initTabs();
                                    if(window.init_yam_project_1)
                                        window.init_yam_project_1();

                                    BX.closeWait();
                                }

                                function SetContact(profileId) {
                                    BX("profile_change").value = "Y";
                                    submitForm();
                                }
                            </script>
                        <? if ($_POST["is_ajax_post"] != "Y")
                        {
                        ?>
                            <form action="<?= $APPLICATION->GetCurPage(); ?>" method="POST" name="ORDER_FORM"
                                  id="ORDER_FORM" enctype="multipart/form-data">
                                <?= bitrix_sessid_post() ?>
                                <div class="col col-9-tl" id="order_form_content">
                                    <?
                                    }
                                    else {
                                        $APPLICATION->RestartBuffer();
                                    }
                                    if (!empty($arResult["ERROR"]) && $arResult["USER_VALS"]["FINAL_STEP"] == "Y") {
                                        foreach ($arResult["ERROR"] as $v)
                                            echo ShowError($v);
                                        ?>
                                        <script type="text/javascript">
                                            top.BX.scrollToNode(top.BX('ORDER_FORM'));
                                        </script>
                                        <?
                                    }
                                    $arResult['AJAX_PATH'] = $templateFolder;
                                    $rsUser = $USER->GetByID($USER->GetID());
                                    $arUser = $rsUser->Fetch();
                                    $entity = $arUser['UF_PARTNER_XML_ID'];
                                    $arResult['PARTNER_ID'] = 0;
                                    $arResult['PARTNER_XML_ID'] = 0;
                                    if($entity) $arResult['PARTNER_XML_ID'] = $entity;
                                    ?>
                                    <ul class="order__steps">
                                        <li class="order__checkPoint order__way order__checkPoint--active">
                                            <div class="order__checkPointNum">1</div>
                                            <span class="order__checkPointTitle">Тип плательщика</span>
                                        </li>
                                        <li class="order__checkPoint order__way">
                                            <div class="order__checkPointNum">2</div>
                                            <span class="order__checkPointTitle">Способ доставки</span>
                                        </li>
                                        <li class="order__checkPoint order__way">
                                            <div class="order__checkPointNum">3</div>
                                            <span class="order__checkPointTitle">Способ оплаты</span>
                                        </li>
                                        <li class="order__checkPoint order__way">
                                            <div class="order__checkPointNum">4</div>
                                            <span class="order__checkPointTitle">Контактные данные</span>
                                        </li>
                                        <li class="order__checkPoint">
                                            <div class="order__checkPointNum">5</div>
                                            <span class="order__checkPointTitle">Завершение покупки</span>
                                        </li>
                                    </ul>
                                    <section class="order__form order__form--active order__form--personal clearfix">
                                        <? include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/person_type.php"); ?>
                                        <button class="toOrder active notEdit icon-to-right" data-qcontent="element__buttons__toOrder">Далее</button>
                                    </section>
                                    <section class="order__form clearfix order__form--delivery">
                                        <? include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/delivery.php"); ?>
                                        <button class="toOrder active notEdit icon-to-right" data-qcontent="element__buttons__toOrder">Далее</button>
                                    </section>
                                    <section class="order__form clearfix order__form--paysystem">
                                        <? include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/paysystem.php"); ?>
                                        <button class="toOrder active notEdit icon-to-right" data-qcontent="element__buttons__toOrder">Далее</button>
                                    </section>
                                    <section class="order__form order__form--client clearfix">
                                        <?
                                        include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/props.php");
                                        include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/related_props.php");
                                        if (strlen($arResult["PREPAY_ADIT_FIELDS"]) > 0)
                                            echo $arResult["PREPAY_ADIT_FIELDS"];
                                        ?>
                                        <button class="toOrder active notEdit icon-to-right" data-qcontent="element__buttons__toOrder">Далее</button>
                                    </section>
                                    <section class="order__form clearfix order__form--summary">
                                        <? include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/summary.php"); ?>
                                        <button class="toOrder active notEdit icon-to-right" data-qcontent="element__buttons__toOrder">Далее</button>
                                    </section>

                                    <?
                                    if ($_POST["is_ajax_post"] != "Y")
                                    {
                                    $STS_ADC = $APPLICATION->get_cookie("STS_ADC");
                                    $STS_ARN = $APPLICATION->get_cookie("STS_ARN");
                                    ?>
                                </div>
                                <div class="col col-12-tp hidden">
                                    <section class="order__form clearfix order__form--confirmed">
                                        <div class="order__checkPoint--gone">
                                            <div class="order__checkPointNum"></div>
                                            <h3 class="order__fsuccesTitle">Заказ оформлен</h3>
                                            <p class="order__fsuccesTitle text">Ваш заказ <span class="order__number">№1111519  </span>от 17.01.2018 15:48:54 успешно создан.</p>
                                            <p class="text">Вы можете следить за выполнением своего заказа в Персональном разделе сайта. Обратите внимание, что для входа в этот раздел вам необходимо будет ввести логин и пароль пользователя сайта.</p>
                                        </div>
                                    </section>
                                </div>
                                <input type="hidden" name="ORDER_PROP_69" value="<?= $STS_ADC ?>">
                                <input type="hidden" name="ORDER_PROP_71" value="<?= $STS_ARN ?>">
                                <input type="hidden" name="ORDER_PROP_72" value="<?=$arResult['PARTNER_ID']?>">
                                <input type="hidden" name="ORDER_PROP_73">
                                <input type="hidden" name="ORDER_PROP_74">
                                <input type="hidden" name="ORDER_PROP_75">
                                <input type="hidden" name="confirmorder" id="confirmorder" value="Y">
                                <input type="hidden" name="profile_change" id="profile_change" value="N">
                                <input type="hidden" name="is_ajax_post" id="is_ajax_post" value="Y">
                                <input type="hidden" name="json" value="Y">
                                <div class="col col-3-tl">
                                    <section class="order__info">
                                        <h5 class="order__infoTitle">Состав заказа:</h5><span class="order__infoItem">Товаров: 1 шт</span><span
                                                class="order__infoItem">На сумму: 123 000 р </span><span
                                                class="order__infoItem">Доставка: 1 000 р</span>
                                        <h6 class="order__infoSumm">Итого: 124 000 р</h6>
                                        <button class="button button--fastBuy" data-qcontent="element__buttons__button">Изменить cостав заказа</button>
                                    </section>
                                    <div class="bxOrder__tab_block5">
                                        <label style="display:block;text-align:center;font-size:18px;" class="conf-label"><input
                                                    type="checkbox" name="confidential" id="confidential"
                                                    style="margin-right:10px;">Я согласен с <a href="/politika-konfidentsialnosti/">Политикой конфиденциальности</a></input></label>
                                        <script>var preSubmitForm = function () {
                                                var conf = $('#confidential').is(':checked');
                                                if (conf) {
                                                    submitForm('Y');
                                                } else {
                                                    $('.conf-label').css('color', 'red').css('font-weight', 'bold');
                                                }
                                            }</script>
                                        <div class="bx_ordercart_order_pay_center"><a href="javascript:void();"
                                                                                      onclick="preSubmitForm(); return false;"
                                                                                      id="ORDER_CONFIRM_BUTTON"
                                                                                      class="checkout"><?= GetMessage("SOA_TEMPL_BUTTON") ?></a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?
                        if ($arParams["DELIVERY_NO_AJAX"] == "N")
                        {
                            ?>
                            <div style="display:none;"><? $APPLICATION->IncludeComponent("bitrix:sale.ajax.delivery.calculator", "", array(), null, array('HIDE_ICONS' => 'Y')); ?></div>
                        <?
                        }
                        }
                        else
                        {
                        ?>
                            <script type="text/javascript">
                                top.BX('confirmorder').value = 'Y';
                                top.BX('profile_change').value = 'N';
                            </script>
                            <?
                            die();
                        }
                        }
                    }
                    ?>
                    <script>
                        window.orderUIObject.init(JSON.parse('<?=json_encode(array(
                            "PARTNER_ID" => $arResult['PARTNER_ID'],
                            "PARTNER_ID_1" => $arResult['PARTNER_ID_1'],
                            "PARTNER_ID_2" => $arResult['PARTNER_ID_2'],
                            "PARTNER_ID_3" => $arResult['PARTNER_ID_3'],
                            "AJAX_PATH" => $arResult['AJAX_PATH'],
                        ))?>'));
                    </script>
                </div>
            </div>
        </main>
    </div>
</div>