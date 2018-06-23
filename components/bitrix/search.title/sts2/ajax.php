<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (empty($arResult["CATEGORIES"]))
	return;
?>
<div class="mainSearch__result clearfix">
<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
<?foreach($arCategory["ITEMS"] as $i => $arItem):?>
<?if($category_id === "all"):?>
<?elseif(isset($arResult["ELEMENTS"][$arItem["ITEM_ID"]])): $arElement = $arResult["ELEMENTS"][$arItem["ITEM_ID"]];?>



        <div class="productInline__content" data-qcontent="component__productInline">
            <div class="group group--md group--va-middle">
                <div class="col col-3-tp">
                    <a class="productInline__link" href=" <?echo $arItem["URL"]?>">
                        <?if (is_array($arElement["PICTURE"])):?>
                          <div class="img_container--align_v productInline__section--img" style="background-image: url('<?echo $arElement["PICTURE"]["src"]?>')"></div>
                        <?endif;?>
                    </a>
                </div>
                <div class="col col-9-tp">
                    <a class="productInline__link" href="<?echo $arItem["URL"]?>"><span class="productInline__section--sku"></span>

                        <h6 class="productInline__section--name"><?echo $arItem["NAME"]?></h6>
                    </a></div>
                <div class="col col-3-tp">
                    <div class="productInline__section--price">
                        <?
                        foreach($arElement["PRICES"] as $code=>$arPrice)
                        {
                            if ($arPrice["MIN_PRICE"] != "Y")
                                continue;

                            if($arPrice["CAN_ACCESS"])
                            {
                                if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
                                    <div class="priceAndStock priceAndStock--sale">
                                        <span class="productCol__price">
                                            <span class="productCol__oldPrice"><?=$arPrice["PRINT_VALUE"]?> <span class="icon-ruble"></span>

                                            </span><?=$arPrice["PRINT_VALUE"]?> 
                                        </span>

                                        <span class="old"><?=$arPrice["PRINT_VALUE"]?></span>
                                    </div>
                                <?else:?>
                                    <div class="priceAndStock">
                                        <span class="productCol__price">
                                            <?=$arPrice["PRINT_VALUE"]?> <span class="icon-ruble"></span>
                                        </span>
                                    </div>
                                <?endif;
                            }
                            if ($arPrice["MIN_PRICE"] == "Y")
                                break;
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    <?else:?>
        <div class="bx_item_block others_result">
            <div class="bx_img_element"></div>
            <div class="bx_item_element">
                <a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a>
            </div>
            <div style="clear:both;"></div>
        </div>
    <?endif;?>
    <?endforeach;?>
    <?endforeach;?>
</div>