<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (empty($arResult["CATEGORIES"]))
	return;
?>
<div class="mobileSearchRes__ctn">
<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
<?foreach($arCategory["ITEMS"] as $i => $arItem):?>
<?if($category_id === "all"):?>
<?elseif(isset($arResult["ELEMENTS"][$arItem["ITEM_ID"]])): $arElement = $arResult["ELEMENTS"][$arItem["ITEM_ID"]];?>



        <div class="productInline__content" data-qcontent="component__productInline">
            <div class="group group--md group--va-middle">
                <div class="col col-12-tp">
                    <a class="productInline__link" href="<?echo $arItem["URL"]?>"><span class="productInline__section--sku"></span>

                        <h6 class="productInline__section--name"><?echo $arItem["NAME"]?></h6>
                    </a></div>
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