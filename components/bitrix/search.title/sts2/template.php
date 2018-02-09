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

$INPUT_ID = trim($arParams["~INPUT_ID"]);
if(strlen($INPUT_ID) <= 0)
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if(strlen($CONTAINER_ID) <= 0)
	$CONTAINER_ID = "mainSearch__result";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

if($arParams["SHOW_INPUT"] !== "N"):?>

<div class="mainSearch__content" data-qcontent="module__mainSearch"  id="<?echo $CONTAINER_ID?>">
	<form class="mainSearch__form" action="<?echo $arResult["FORM_ACTION"]?>">
		<input class="mainSearch__input bx_input_text" name='q' type="text" placeholder="Поиск среди 20 000 товаров" id="<?echo $INPUT_ID?>" value=""/>
        <label for="searchSubmit" class="mainSearch__icon">
            <svg class="icon icon--mainSearch" data-qcontent="element__ICONS__MAIN-SVG-use">
                <use xlink:href="#search"></use>
            </svg>
            <input id="searchSubmit" class="mainSearch__submit bx_input_submit" name="s" type="submit" value="Искать"/>
        </label>
	</form>
</div>
<script>
	BX.ready(function(){
		new JCTitleSearch({
			'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
			'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
			'INPUT_ID': '<?echo $INPUT_ID?>',
			'MIN_QUERY_LEN': 2
		});
	});
</script>
<?endif?>
