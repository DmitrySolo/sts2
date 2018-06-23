<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Sale\DiscountCouponsManager;

if (!empty($arResult["ERROR_MESSAGE"]))
    ShowError($arResult["ERROR_MESSAGE"]);

$bDelayColumn = false;
$bDeleteColumn = false;
$bWeightColumn = false;
$bPropsColumn = false;
$bPriceType = false;

$IBLOCK_ID = 10;

if ($normalCount > 0):
    ?>
    <div class="cartPage__content" id="basket_items_list" data-qcontent="module__cartPage">
        <div class="cartPage">
            <div class="group group--md">
                <div class="col col-9-tl" id="basket_items"><!-- split modules/cartProduct -->
                    <?
                    foreach ($arResult["GRID"]["ROWS"] as $k => $arItem):

                        if ($arItem["DELAY"] == "N" && $arItem["CAN_BUY"] == "Y"):

                            $old_price = 0;

                            if(CModule::IncludeModule("iblock")) {
                                $db_props = CIBlockElement::GetProperty($IBLOCK_ID, $arItem["PRODUCT_ID"], array("sort" => "asc"), Array("CODE" => 'OLD_PRICE'));
                                if ($ar_props = $db_props->Fetch())
                                    $old_price = $ar_props["VALUE"];
                            }

                            ?>
                            <div class="cartProduct__content" data-qcontent="module__cartProduct"
                                 id="<?= $arItem["ID"] ?>">
                                <div class="productInline__content" data-qcontent="component__productInline">
                                    <div class="group group--md group--va-middle">
                                        <div class="col col-2-tp"><a class="productInline__link"
                                                                     href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                                                <?
                                                if (strlen($arItem["PREVIEW_PICTURE_SRC"]) > 0):
                                                    $url = $arItem["PREVIEW_PICTURE_SRC"];
                                                elseif (strlen($arItem["DETAIL_PICTURE_SRC"]) > 0):
                                                    $url = $arItem["DETAIL_PICTURE_SRC"];
                                                else:
                                                    $url = $templateFolder . "/images/no_photo.png";
                                                endif;
                                                ?>
                                                <div class="img_container--align_v productInline__section--img"><img
                                                            src="<?= $url ?>"/>
                                                </div>
                                            </a></div>
                                        <div class="col col-4-tp"><?if($old_price > 0):?><span class="productBadge productBadge--sale"
                                                                        data-qcontent="element__buttons__productBadge">Распродажа</span><br/><?endif?><a
                                                    class="productInline__link"
                                                    href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><span
                                                        class="productInline__section--sku">Код товара: <span><?= $arItem["PRODUCT_XML_ID"] ?></span></span>
                                                <h6 class="productInline__section--name"><?= $arItem["NAME"] ?></h6></a>
                                            <pre><?//var_dump($arItem)
                                                ?></pre>
                                        </div>
                                        <div class="col col-2-tp">
                                            <div class="productInline__section--price">
                                                <div class="priceAndStock priceAndStock--sale"
                                                     data-qcontent="component__priceAndStock"><span
                                                            class="productCol__price"><span
                                                                class="productCol__oldPrice"><?
                                                            if (floatval($arItem["DISCOUNT_PRICE_PERCENT"]) > 0):?><span
                                                                id="old_price_<?= $arItem["ID"] ?>"><?= number_format($arItem["FULL_PRICE"], 0, '', ' ') ?></span>
                                                                <span class="icon-ruble"></span><?
                                                            else:?><span
                                                                id="old_price_<?= $arItem["ID"] ?>"></span><span
                                                                        class="icon-ruble"
                                                                        style="display: none"></span><?endif ?></span><span
                                                                id="current_price_<?= $arItem["ID"] ?>"><?= number_format($arItem["PRICE"], 0, '', ' ') ?></span> <span
                                                                class="icon-ruble"></span></span><? if ($arItem["AVAILABLE_QUANTITY"] > 0): ?>
                                                        <span
                                                                class="productCol__stock icon-tick">В наличии</span><?
                                                    else:?><span
                                                            class="productCol__stock productCol__stock--out">Нет в наличии</span><? endif ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col col-2-tp col-8-m push-2-m">
                                            <div class="counter__ctn">
                                                <?
                                                $ratio = isset($arItem["MEASURE_RATIO"]) ? $arItem["MEASURE_RATIO"] : 0;
                                                $max = isset($arItem["AVAILABLE_QUANTITY"]) ? "max=\"" . $arItem["AVAILABLE_QUANTITY"] . "\"" : "";
                                                $useFloatQuantity = ($arParams["QUANTITY_FLOAT"] == "Y") ? true : false;
                                                $useFloatQuantityJS = ($useFloatQuantity ? "true" : "false");

                                                if (!isset($arItem["MEASURE_RATIO"])) {
                                                    $arItem["MEASURE_RATIO"] = 1;
                                                }
                                                ?>
                                                <button type="button" class="counter__btn counter__btn--minus"
                                                        id="button_minus_<?= $arItem["ID"] ?>"
                                                        onclick="setQuantity(<?=$arItem["ID"]?>, <?=$arItem["MEASURE_RATIO"]?>, 'down', <?=$useFloatQuantityJS?>);">-
                                                </button>
                                                <input class="counter " type="text"
                                                       data-qcontent="element__INPUTS__counter"
                                                       size="3"
                                                       id="QUANTITY_INPUT_<?= $arItem["ID"] ?>"
                                                       name="QUANTITY_INPUT_<?= $arItem["ID"] ?>"
                                                       size="2"
                                                       maxlength="18"
                                                       min="0"
                                                    <?= $max ?>
                                                       step="<?= $ratio ?>"
                                                       value="<?= $arItem["QUANTITY"] ?>"
                                                       onchange="updateQuantity('QUANTITY_INPUT_<?= $arItem["ID"] ?>', '<?= $arItem["ID"] ?>', <?= $ratio ?>, <?= $useFloatQuantityJS ?>)"
                                                />
                                                <button type="button" class="counter__btn counter__btn--plus"
                                                        id="button_plus_<?= $arItem["ID"] ?>"
                                                onclick="setQuantity(<?=$arItem["ID"]?>, <?=$arItem["MEASURE_RATIO"]?>, 'up', <?=$useFloatQuantityJS?>);">+
                                                </button>
                                            </div>
                                            <input type="hidden" id="QUANTITY_<?= $arItem['ID'] ?>"
                                                   name="QUANTITY_<?= $arItem['ID'] ?>"
                                                   value="<?= $arItem["QUANTITY"] ?>"/>
                                        </div>
                                        <div class="col col-2-tp dltCtn">
                                            <a href="<?= str_replace("#ID#", $arItem["ID"], $arUrls["delete"]) ?>">
                                                <button type="button" class="delete" data-qcontent="element__buttons__delete">
                                                    <svg class="icon icon--delete"
                                                         data-qcontent="element__ICONS__MAIN-SVG-use">
                                                        <use xlink:href="#delete"></use>
                                                    </svg>
                                                </button>
                                            </a>
                                        </div>
                                        <div class="productInline__section productInline__section--del"></div>
                                    </div>
                                </div>
                            </div>
                            <?
                        endif;
                    endforeach;
                    ?>
                </div>

                <input type="hidden" id="column_headers"
                       value="<?= CUtil::JSEscape(implode($arParams["COLUMNS_LIST"], ",")) ?>"/>
                <input type="hidden" id="offers_props"
                       value="<?= CUtil::JSEscape(implode($arParams["OFFERS_PROPS"], ",")) ?>"/>
                <input type="hidden" id="action_var" value="<?= CUtil::JSEscape($arParams["ACTION_VARIABLE"]) ?>"/>
                <input type="hidden" id="quantity_float" value="<?= $arParams["QUANTITY_FLOAT"] ?>"/>
                <input type="hidden" id="count_discount_4_all_quantity"
                       value="<?= ($arParams["COUNT_DISCOUNT_4_ALL_QUANTITY"] == "Y") ? "Y" : "N" ?>"/>
                <input type="hidden" id="price_vat_show_value"
                       value="<?= ($arParams["PRICE_VAT_SHOW_VALUE"] == "Y") ? "Y" : "N" ?>"/>
                <input type="hidden" id="hide_coupon" value="<?= ($arParams["HIDE_COUPON"] == "Y") ? "Y" : "N" ?>"/>
                <input type="hidden" id="use_prepayment"
                       value="<?= ($arParams["USE_PREPAYMENT"] == "Y") ? "Y" : "N" ?>"/>

                <div class="col col-3-tl" id="jsjs">
                    <div class="cartPage__cartCheck">
                        <div class="cuponInput"
                             id="coupons_block"<?= (isPartnerClient() ? ' style="display:none"' : '') ?>>
                            <label for="coupon" class="cuponInput__label--message <?
                            if($arResult['COUPON_LIST'][0]['STATUS'] == DiscountCouponsManager::STATUS_APPLYED):
                                ?>success<?else:?>error<?endif;?>"<?if (empty($arResult['COUPON_LIST'])):?> style="display: none"<?endif;?>>
                                Купон <span><?if(empty($arResult['COUPON_LIST'])):?>не найден<?else: echo $arResult['COUPON_LIST'][0]["CHECK_CODE_TEXT"][0]; endif;?></span>:
                            </label>
                            <label for="coupon" class="cuponInput__label"<?if (!empty($arResult['COUPON_LIST'])):?> style="display: none"<?endif;?>>Введите код купона для скидки:
                                <input <?//id="cuponInput"
                                ?> name="COUPON" id="coupon" type="text" maxlength="8"
                                   onchange="enterCoupon();"
                                   onkeydown="return enterCouponKeyDown(event);"
                                   autocomplete="off"
                                   data-qcontent="element__INPUTS__cuponInput"/>
                                <button class="cuponInput__button" type="button">OK</button>
                            </label><?
                            if (!empty($arResult['COUPON_LIST'])) {
                                foreach ($arResult['COUPON_LIST'] as $oneCoupon) {
                                    $couponClass = 'disabled';
                                    switch ($oneCoupon['STATUS']) {
                                        case DiscountCouponsManager::STATUS_NOT_FOUND:
                                        case DiscountCouponsManager::STATUS_FREEZE:
                                            $couponClass = 'bad';
                                            break;
                                        case DiscountCouponsManager::STATUS_APPLYED:
                                            $couponClass = 'good';
                                            break;
                                    }
                                    ?>
                                    <div class="bx_ordercart_coupon"><input disabled readonly type="text"
                                                                            name="OLD_COUPON[]"
                                                                            value="<?= htmlspecialcharsbx($oneCoupon['COUPON']); ?>"
                                                                            class="<? echo $couponClass; ?>"><span
                                            class="<? echo $couponClass; ?>"
                                            data-coupon="<? echo htmlspecialcharsbx($oneCoupon['COUPON']); ?>"></span>
                                    </div><?
                                }
                                unset($couponClass, $oneCoupon);
                            }
                            ?>
                        </div>
                        <div class="cartPage__summtitle--extra"<?if(!$arResult["DISCOUNT_PRICE_ALL"]):?> style="display: none"<?endif;?>>
                            <h6 class="cartPage__summtitle">Цена без скидки:</h6><span
                                    id="PRICE_WITHOUT_DISCOUNT"><?= $arResult["PRICE_WITHOUT_DISCOUNT"] ?></span>
                            <h6 class="cartPage__summtitle">Экономия:</h6><span
                                    id="DISCOUNT_PRICE_ALL_FORMATED"><?= $arResult["DISCOUNT_PRICE_ALL_FORMATED"] ?></span>
                        </div>
                        <h5 class="cartPage__summtitle">Итого:</h5><span class="cartPage__summ"
                                                                         id="allSum_FORMATED"><?= $arResult["allSum_FORMATED"] ?></span>
                        <button class="toOrder active notEdit makeOrder" onclick="checkOut(<?= (isPartnerClient() ? "'Y'" : '') ?>); return false;"
                                data-qcontent="element__buttons__toOrder">Оформить заказ
                        </button>
                        <a class="actionLink returnToBuy icon-to-left " href="/"
                           data-qcontent="element__LINKS__actionLink">Вернуться к покупкам</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?
else:
    ?>
    <div id="basket_items_list">
        <table>
            <tbody>
            <tr>
                <td colspan="<?= $numCells ?>" style="text-align:center">
                    <div class=""><?= GetMessage("SALE_NO_ITEMS"); ?></div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <?
endif;
?>