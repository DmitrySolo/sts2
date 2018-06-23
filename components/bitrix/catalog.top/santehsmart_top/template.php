<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$all=date("jS");
if (!empty($arResult['ITEMS']))
{
	CJSCore::Init(array("popup"));
	$arSkuTemplate = array();
	if (!empty($arResult['SKU_PROPS']))
	{
		foreach ($arResult['SKU_PROPS'] as &$arProp)
		{
			ob_start();
			if ('TEXT' == $arProp['SHOW_MODE'])
			{
				if (4 < $arProp['VALUES_COUNT'])
				{
					$strClass = 'bx_item_detail_size full';
					$strWidth = ($arProp['VALUES_COUNT']*20).'%';
					$strOneWidth = (100/$arProp['VALUES_COUNT']).'%';
					$strSlideStyle = '';
				}
				else
				{
					$strClass = 'bx_item_detail_size';
					$strWidth = '100%';
					$strOneWidth = '20%';
					$strSlideStyle = 'display: none;';
				}
				?><div class="<? echo $strClass; ?>" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_cont">
				<span class="bx_item_section_name_gray"><? echo htmlspecialcharsex($arProp['NAME']); ?></span>
				<div class="bx_size_scroller_container"><div class="bx_size"><ul id="#ITEM#_prop_<? echo $arProp['ID']; ?>_list" style="width: <? echo $strWidth; ?>;"><?
							foreach ($arProp['VALUES'] as $arOneValue)
							{
								?><li
								data-treevalue="<? echo $arProp['ID'].'_'.$arOneValue['ID']; ?>"
								data-onevalue="<? echo $arOneValue['ID']; ?>"
								style="width: <? echo $strOneWidth; ?>;"
								><i></i><span class="cnt"><? echo htmlspecialcharsex($arOneValue['NAME']); ?></span></li><?
							}
							?></ul></div>
					<div class="bx_slide_left" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_left" data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
					<div class="bx_slide_right" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_right" data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
				</div>
				</div><?
			}
			elseif ('PICT' == $arProp['SHOW_MODE'])
			{
				if (5 < $arProp['VALUES_COUNT'])
				{
					$strClass = 'bx_item_detail_scu full';
					$strWidth = ($arProp['VALUES_COUNT']*20).'%';
					$strOneWidth = (100/$arProp['VALUES_COUNT']).'%';
					$strSlideStyle = '';
				}
				else
				{
					$strClass = 'bx_item_detail_scu';
					$strWidth = '100%';
					$strOneWidth = '20%';
					$strSlideStyle = 'display: none;';
				}
				?><div class="<? echo $strClass; ?>" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_cont">
				<span class="bx_item_section_name_gray"><? echo htmlspecialcharsex($arProp['NAME']); ?></span>
				<div class="bx_scu_scroller_container"><div class="bx_scu"><ul id="#ITEM#_prop_<? echo $arProp['ID']; ?>_list" style="width: <? echo $strWidth; ?>;"><?
							foreach ($arProp['VALUES'] as $arOneValue)
							{
								?><li
								data-treevalue="<? echo $arProp['ID'].'_'.$arOneValue['ID'] ?>"
								data-onevalue="<? echo $arOneValue['ID']; ?>"
								style="width: <? echo $strOneWidth; ?>; padding-top: <? echo $strOneWidth; ?>;"
								><i title="<? echo htmlspecialcharsbx($arOneValue['NAME']); ?>"></i>
								<span class="cnt"><span class="cnt_item"
									style="background-image:url('<? echo $arOneValue['PICT']['SRC']; ?>');"
									title="<? echo htmlspecialcharsbx($arOneValue['NAME']); ?>"
								></span></span></li><?
							}
							?></ul></div>
					<div class="bx_slide_left" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_left" data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
					<div class="bx_slide_right" id="#ITEM#_prop_<? echo $arProp['ID']; ?>_right" data-treevalue="<? echo $arProp['ID']; ?>" style="<? echo $strSlideStyle; ?>"></div>
				</div>
				</div><?
			}
			$arSkuTemplate[$arProp['CODE']] = ob_get_contents();
			ob_end_clean();
		}
		unset($arProp);
	}

	$strElementEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT");
	$strElementDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE");
	$arElementDeleteParams = array("CONFIRM" => GetMessage('CT_BCT_ELEMENT_DELETE_CONFIRM'));

	$strFullPath = $_SERVER['DOCUMENT_ROOT'].$this->GetFolder();
	$templateData = array(
		'TEMPLATE_THEME' => $this->GetFolder().'/'.ToLower($arParams['VIEW_MODE']).'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
		'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME']
	);
	switch ($arParams['VIEW_MODE'])
	{
		case 'BANNER':
			include($strFullPath.'/banner/template.php');
			break;
		case 'SLIDER':
			include($strFullPath.'/slider/template.php');
			break;
		case 'SECTION':
			include($strFullPath.'/section/template.php');
			break;
	}
?>
<script type="text/javascript">
BX.message({
	MESS_BTN_BUY: '<? echo ('' != $arParams['MESS_BTN_BUY'] ? CUtil::JSEscape($arParams['MESS_BTN_BUY']) : GetMessageJS('CT_BCT_TPL_MESS_BTN_BUY')); ?>',
	MESS_BTN_ADD_TO_BASKET: '<? echo ('' != $arParams['MESS_BTN_ADD_TO_BASKET'] ? CUtil::JSEscape($arParams['MESS_BTN_ADD_TO_BASKET']) : GetMessageJS('CT_BCT_TPL_MESS_BTN_ADD_TO_BASKET')); ?>',
	MESS_NOT_AVAILABLE: '<? echo ('' != $arParams['MESS_NOT_AVAILABLE'] ? CUtil::JSEscape($arParams['MESS_NOT_AVAILABLE']) : GetMessageJS('CT_BCT_TPL_MESS_PRODUCT_NOT_AVAILABLE')); ?>',
	BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CT_BCT_CATALOG_BTN_MESSAGE_BASKET_REDIRECT'); ?>',
	BASKET_URL: '<? echo $arParams["BASKET_URL"]; ?>',
	ADD_TO_BASKET_OK: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
	TITLE_ERROR: '<? echo GetMessageJS('CT_BCT_CATALOG_TITLE_ERROR') ?>',
	TITLE_BASKET_PROPS: '<? echo GetMessageJS('CT_BCT_CATALOG_TITLE_BASKET_PROPS') ?>',
	TITLE_SUCCESSFUL: '<? echo GetMessageJS('ADD_TO_BASKET_OK'); ?>',
	BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCT_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
	BTN_MESSAGE_SEND_PROPS: '<? echo GetMessageJS('CT_BCT_CATALOG_BTN_MESSAGE_SEND_PROPS'); ?>',
	BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CT_BCT_CATALOG_BTN_MESSAGE_CLOSE') ?>'
});
</script>
<?
}
?>


<section class="mainPageSection">
    <div class="mainPageSection__content mainPageSection__contentundefined" data-qcontent="level__mainPageSection">
        <h2 class="mainPageSection__title">Новинки</h2>
        <ul class="productCol__list">
            <div class="group group--el group--v-el">


            </div>
        </ul>
    </div>
</section>


<div class="col col-6-tl col-4-d">  <!-- split modules/productCol -->
    <li class="productCol__content" data-qcontent="module__productCol">
        <div class="productCol__card"> <span class="productSection__subTitle">Код: </span><span class="productCol__sku">123456</span><span class="productBadge productBadge--sale" data-qcontent="element__buttons__productBadge">Распродажа</span><a class="productCol__link" href="#">
                <div class="productCol__img"></div>
                <h6 class="productCol__name">Полка угловая ОНИКА ТРИО 20У 302001qq-2</h6>
                <div class="priceAndStock priceAndStock--part" data-qcontent="component__priceAndStock"><span class="productCol__price"><span class="productCol__mrcPrice">17 300   <span class="icon-ruble">       </span></span>14 300     <span class="icon-ruble"> </span></span><span class="partStock"><span class="productCol productCol__stock icon-tick">Доступно: 299шт   </span><span class="productCol productCol__lock icon-padlock">Резерв: 389шт</span></span>
                </div></a>
            <!--label.productInline__quantityLabel.showFrom-d
            input.productInline__quantitySelector(type=text value='1'  size='2' )
            .productInline__quantityButton.productInline__quantityButton--minus
            .productInline__quantityButton.productInline__quantityButton--plus
            -->
            <button class="toOrder active notEdit" data-qcontent="element__buttons__toOrder">В корзину</button>
        </div>
    </li>
</div>