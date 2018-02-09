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
<div class="modalWindow__content " data-qcontent="level__modalWindow" id="<?echo $CONTAINER_ID?>">
    <a class="modalWindow__close">
        <svg class="icon icon--close" data-qcontent="element__ICONS__MAIN-SVG-use">
            <use xlink:href="#close">              </use>
        </svg>
    </a>
<!--    <h3 class="modalWindow__title">Поиск товаров:</h3>-->
    <form class="mainSearch__form"  action="<?echo $arResult["FORM_ACTION"]?>" >
        <div class="modalWindow__body">
            <div class="input__ctn" >
                <label for="<?echo $INPUT_ID?>" class="textInput__label"></label>
                <input id="<?echo $INPUT_ID?>" class="textInput textInput--searchm" name="searchm" placeholder="Например ванна Атланта" type="text" data-qcontent="element__INPUTS__textInput" autocomplete="off"/>
            </div>
        </div>
    </form>
    <div id="<?echo $CONTAINER_ID?>"  class="mobile-search-result"></div>
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