<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");
CUtil::InitJSCore();
CJSCore::Init(array("fx"));
CJSCore::Init(array("jquery"));

$curPage = $APPLICATION->G;
?>
<!DOCTYPE html>
<html lang="<?=LANGUAGE_ID?>">
<head>
	<meta charset="utf-8">
	<title><?$APPLICATION->ShowTitle()?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0 user-scalable=no,  minimum-scale=1.0, maximum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="Content-Type" content="text/html; charset=<?=LANG_CHARSET?>"/>
	<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_DIR?>favicon.ico" />
	<link href="https://fonts.googleapis.com/css?family=Fira+Sans:300i,400,700&subset=cyrillic" rel="stylesheet" type="text/css">

	<?
            $APPLICATION->ShowHead();

            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/styles/jquery.mmenu.all.css");
            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/styles/ion.rangeSlider.css");
            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/styles/ion.rangeSlider.skinFlat.css");
            $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/styles/owl.carousel.min.css");

            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/scripts/ow.js");
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/scripts/ion.rangeSlider.min.js");
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/scripts/jquery.mmenu.all.js");
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/scripts/quant-lib.js");
            $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/scripts/init.js");
	?>
</head>
<body class="project" data-qcontent="layout__layout">
<?$APPLICATION->IncludeComponent("bitrix:pull.request", "composite");?>

<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<div class="projectWrapper" id="js-wrapper">
    <div class="catalogList__outer" id="js_catShadow"></div><!-- HEADER --> <!-- split header.html -->
    <header class="mainHeader" data-qcontent="layout__header">
        <div class="outer">
            <div class="outer__content outer__contentundefined" data-qcontent="level__outer">
                <div class="level__inner">
                    <div class="container">
                        <!--+LEVEL-topdashBoard(topdashBoard)-->
                    </div>
                </div>
                <div class="topMenu__wrapper">
                    <div class="level__inner">
                        <div class="container"><!-- split modules/topMenu -->
                            <div class="group group--md">
                                <div class="col col-16-tl showFrom-tl">
                                    <div class="topMenu__content" data-qcontent="module__topMenu">
                                        <nav class="topMenu">
                                            <ul class="topMenu__list">
                                                <li class="topMenu__element popup__trigger"><a class="material " href="/sdsd" data-qcontent="element__LINKS__material">Розничным Клиентам</a>
                                                    <div class="popup__angle">
                                                        <svg class="icon icon--popup" data-qcontent="element__ICONS__MAIN-SVG-use">
                                                            <use xlink:href="#to-right">              </use>
                                                        </svg>
                                                    </div>
                                                    <div class="popup">
                                                        <div class="popup__content popup__contentundefined" data-qcontent="level__popup">
                                                            <div class="popup__body">
                                                                <ul class="popup__menu">
                                                                    <li class="popup__menuItem"><a class="material " href="/sdsd" data-qcontent="element__LINKS__material">Оплата и доставка</a>
                                                                    </li>
                                                                    <li class="popup__menuItem"><a class="material " href="/sdsd" data-qcontent="element__LINKS__material">Возврат и обмен</a>
                                                                    </li>
                                                                    <li class="popup__menuItem"><a class="material " href="/sdsd" data-qcontent="element__LINKS__material">Оплата и доставка</a>
                                                                    </li>
                                                                    <li class="popup__menuItem"><a class="material " href="/sdsd" data-qcontent="element__LINKS__material">Возврат и обмен</a>
                                                                    </li>
                                                                    <li class="popup__menuItem"><a class="material " href="/sdsd" data-qcontent="element__LINKS__material">Оплата и доставка</a>
                                                                    </li>
                                                                    <li class="popup__menuItem"><a class="material " href="/sdsd" data-qcontent="element__LINKS__material">Возврат и обмен</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="topMenu__element popup__trigger"><a class="material " href="/sdsd" data-qcontent="element__LINKS__material">Оптовым Клиентам</a>
                                                    <div class="popup__angle">
                                                        <svg class="icon icon--popup" data-qcontent="element__ICONS__MAIN-SVG-use">
                                                            <use xlink:href="#to-right">              </use>
                                                        </svg>
                                                    </div>
                                                    <div class="popup">
                                                        <div class="popup__content popup__contentundefined" data-qcontent="level__popup">
                                                            <div class="popup__body">
                                                                <ul>
                                                                    <li>3</li>
                                                                    <li>4</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="topMenu__element"><a class="material " href="/sdsd" data-qcontent="element__LINKS__material">Контакты</a>
                                                </li>
                                                <li class="topMenu__element topMenu__element--login">
                                                    <?$APPLICATION->IncludeComponent(
                                                        "bitrix:system.auth.form",
                                                        "eshop_adapt",
                                                        array(
                                                            "REGISTER_URL" => SITE_DIR."login/",
                                                            "PROFILE_URL" => SITE_DIR."personal/",
                                                            "SHOW_ERRORS" => "N",
                                                            "COMPONENT_TEMPLATE" => "eshop_adapt",
                                                            "FORGOT_PASSWORD_URL" => ""
                                                        ),
                                                        false
                                                    );?>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mainInfo__wrapper">
                    <div class="level__inner">
                        <div class="container"><!-- split modules/mainInfo -->
                            <div class="mainInfo__content" data-qcontent="module__mainInfo">
                                <div class="group group--md group--va-middle">
                                    <div class="col col-3-tl showFrom-tl">
                                        <div class="mainInfo__logo">
                                            <h1 class="logo"><span class="subLogo">S  </span>Santehsmart</h1>
                                        </div>
                                        <!--	+logo-img('logo1.svg') -->
                                    </div>
                                    <div class="col col-2-tl showFrom-tl">
                                        <div class="mainInfo__block mainInfo__geotarget"><!-- split modules/geoTarget -->
                                            <div class="geoTarget__content" data-qcontent="module__geoTarget">
                                                <?$APPLICATION->IncludeComponent(
                                                    "twofingers:location",
                                                    "sts2",
                                                    array(
                                                        "CACHE_TYPE" => "A",
                                                        "CACHE_TIME" => "3600",
                                                        "SET_TITLE" => "Y",
                                                        "COMPONENT_TEMPLATE" => "sts2"
                                                    ),
                                                    false
                                                );?>
                                                <?$APPLICATION->IncludeComponent(
                                                    "orangerocket:delivery_points_mark",
                                                    "sts2",
                                                    array(
                                                        "IBLOC_ID" => "18",
                                                        "COMPONENT_TEMPLATE" => "sts2",
                                                        "IS_ORDER_PAGE" => ""
                                                    ),
                                                    false
                                                );?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-12-tp hideFrom-tl">
                                        <div class="mainInfo__cartLogin--mobile group group-el clearfix"><a id="js-user-city">
                                                <svg class="icon icon--mobile placeholderm" data-qcontent="element__ICONS__MAIN-SVG-use">
                                                    <use xlink:href="#placeholderm">              </use>
                                                </svg></a><a id="js-user-login">
                                                <svg class="icon icon--mobile user" data-qcontent="element__ICONS__MAIN-SVG-use">
                                                    <use xlink:href="#user">              </use>
                                                </svg></a><span class="callMobile" id="js-user-call">
                            <svg class="icon icon--mobile call" data-qcontent="element__ICONS__MAIN-SVG-use">
                              <use xlink:href="#call">              </use>
                            </svg></span>
                                            <div class="f-right"><span class="searchMobile" id="js_modal_trigger__searchm">
                              <svg class="icon icon--mobile mobileSearch" data-qcontent="element__ICONS__MAIN-SVG-use">
                                <use xlink:href="#searchm">              </use>
                              </svg></span><a>
                                                    <svg class="icon icon--mobile" data-qcontent="element__ICONS__MAIN-SVG-use">
                                                        <use xlink:href="#cart">              </use>
                                                    </svg></a></div>
                                        </div>
                                    </div>
                                    <div class="col col-8-tl hideFrom-tl">
                                        <div class="mainInfo__logo--mobile">
                                            <h1 class="logo"><span class="subLogo">S  </span>Santehsmart</h1>
                                        </div>
                                    </div>
                                    <div class="col col-5-tl showFrom-tl"><!-- split modules/topFeatures -->
                                        <div class="topFeatures__content" data-qcontent="module__topFeatures"><span class="topFeatures__element">
                            <svg class="icon " data-qcontent="element__ICONS__MAIN-SVG-use">
                              <use xlink:href="#housePin">              </use>
                            </svg><span class="topFeatures__title">Пункты выдачи в 170 городах.</span></span><span class="topFeatures__element">
                            <svg class="icon icon--boxTop" data-qcontent="element__ICONS__MAIN-SVG-use">
                              <use xlink:href="#box">              </use>
                            </svg><span class="topFeatures__title">Оплачивайте заказы после проверки.</span></span></div>
                                    </div>
                                    <div class="col col-2-tl showFrom-tl">
                                        <div class="mainInfo__phone"><span class="mainInfo__phone-number">8 800 500 13 84</span><span class="mainInfo__phone-time icon-clock1">Ежедневно  с 9 до 19ч
                                                <!--| ПН-ПТ 9 - 19ч--></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="outer">
            <div class="outer__content outer__contentundefined" data-qcontent="level__outer">
                <div class="topBar__wrapper">
                    <div class="level__inner">
                        <div class="container"><!-- split modules/topBar -->
                            <div class="topBar__content" data-qcontent="module__topBar">
                                <div class="group group--md group--v-md group--va-middle topBar">
                                    <div class="col col-3-tl col-12-m">
                                        <div class="topBar__catalog"> <!-- split modules/catalog -->
                                            <ul class="catalog__content" data-qcontent="module__catalog">
                                                <li class="catalog__by catalog__by--category clearfix col showFrom-tl  catalog__by--hovered" id="js-CatChoiser">
                                                    <svg class="icon icon--categories" data-qcontent="element__ICONS__MAIN-SVG-use">
                                                        <use xlink:href="#menu">              </use>
                                                    </svg><span class="catalog__elemTitle">Кaталог  </span>
                                                    <svg class="icon icon--to-right f-right" data-qcontent="element__ICONS__MAIN-SVG-use">
                                                        <use xlink:href="#to-right">              </use>
                                                    </svg>
                                                </li>
                                                <li class="catalog__mobile col hideFrom-tl" id="mm-button">
                                                    <svg class="icon icon--categories" data-qcontent="element__ICONS__MAIN-SVG-use">
                                                        <use xlink:href="#menu">              </use>
                                                    </svg><span class="catalog__elemTitle">Кaталог        </span>
                                                </li>
                                                <li class="catalog__by catalog__by--brand col showFrom-tl clearfix" id="js-BrandChoiser">
                                                    <svg class="icon icon--categories " data-qcontent="element__ICONS__MAIN-SVG-use">
                                                        <use xlink:href="#star1">              </use>
                                                    </svg><span class="catalog__elemTitle">Бренды    </span>
                                                    <svg class="icon icon--to-right f-right" data-qcontent="element__ICONS__MAIN-SVG-use">
                                                        <use xlink:href="#to-right">              </use>
                                                    </svg>
                                                </li>
                                                <li class="catalog__by-m clearfix col hideFrom-tl" id="js-BrandChoiser-m">
                                                    <svg class="icon icon--categories " data-qcontent="element__ICONS__MAIN-SVG-use">
                                                        <use xlink:href="#star1">              </use>
                                                    </svg><span class="catalog__elemTitle">Бренды</span>
                                                    <svg class="icon icon--to-right f-right" data-qcontent="element__ICONS__MAIN-SVG-use">
                                                        <use xlink:href="#to-right">              </use>
                                                    </svg>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col col-6-tl showFrom-tl">
                                        <div class="topBar__search" id="topBar__search">
                                        <!-- split modules/mainSearch -->
                                            <?$APPLICATION->IncludeComponent(
                                                "bitrix:search.title",
                                                "sts2",
                                                array(
                                                    "NUM_CATEGORIES" => "1",
                                                    "TOP_COUNT" => "5",
                                                    "CHECK_DATES" => "N",
                                                    "SHOW_OTHERS" => "N",
                                                    "PAGE" => SITE_DIR."catalog/",
                                                    "CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS"),
                                                    "CATEGORY_0" => array(
                                                        0 => "iblock_catalog",
                                                    ),
                                                    "CATEGORY_0_iblock_catalog" => array(
                                                        0 => "10",
                                                    ),
                                                    "CATEGORY_OTHERS_TITLE" => GetMessage("SEARCH_OTHER"),
                                                    "SHOW_INPUT" => "Y",
                                                    "INPUT_ID" => "title-search-input",
                                                    "CONTAINER_ID" => "topBar__search",
                                                    "PRICE_CODE" => array(
                                                        0 => "BASE",
                                                    ),
                                                    "SHOW_PREVIEW" => "Y",
                                                    "PREVIEW_WIDTH" => "50",
                                                    "PREVIEW_HEIGHT" => "50",
                                                    "CONVERT_CURRENCY" => "Y",
                                                    "ORDER" => "rank",
                                                    "USE_LANGUAGE_GUESS" => "Y",
                                                    "PRICE_VAT_INCLUDE" => "Y",
                                                    "PREVIEW_TRUNCATE_LEN" => "",
                                                    "CURRENCY_ID" => "RUB",
                                                    "COMPONENT_TEMPLATE" => "sts2"
                                                ),
                                                false );?>

                                        </div>
                                    </div>
                                    <div class="col col-3-tl showFrom-tl">
                                        <? $APPLICATION->IncludeComponent(
                                            "bitrix:sale.basket.basket.line",
                                            "sts2",
                                            array(
                                                "PATH_TO_BASKET" => SITE_DIR."personal/cart/",
                                                "PATH_TO_PERSONAL" => SITE_DIR."personal/",
                                                "SHOW_PERSONAL_LINK" => "N",
                                                "SHOW_NUM_PRODUCTS" => "Y",
                                                "SHOW_TOTAL_PRICE" => "Y",
                                                "SHOW_PRODUCTS" => "N",
                                                "POSITION_FIXED" => "Y",
                                                "SHOW_EMPTY_VALUES" => "N",
                                                "PATH_TO_ORDER" => SITE_DIR."personal/order/make/",
                                                "SHOW_DELAY" => "Y",
                                                "SHOW_NOTAVAIL" => "N",
                                                "SHOW_SUBSCRIBE" => "Y",
                                                "SHOW_IMAGE" => "Y",
                                                "SHOW_PRICE" => "Y",
                                                "SHOW_SUMMARY" => "N",
                                                "BUY_URL_SIGN" => "action=ADD2BASKET",
                                                "POSITION_HORIZONTAL" => "right",
                                                "CACHE_TYPE" => "N",
                                                "POSITION_VERTICAL" => "top",
                                                "COMPONENT_TEMPLATE" => "sts2",
                                                "SHOW_AUTHOR" => "N",
                                                "PATH_TO_REGISTER" => SITE_DIR."login/",
                                                "PATH_TO_PROFILE" => SITE_DIR."personal/",
                                                "HIDE_ON_BASKET_PAGES" => "N",
                                                "COMPOSITE_FRAME_MODE" => "A",
                                                "COMPOSITE_FRAME_TYPE" => "AUTO"
                                            ),
                                            false
                                        ); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- split modules/catalogList -->
                    <div class="catalogList__outerWrapper">
                        <div class="level__inner">
                            <div class="container">
                                <div class="catalogList__content" data-qcontent="module__catalogList">
                                    <?$APPLICATION->IncludeComponent(
                                        "bitrix:menu",
                                        "smart_catalog",
                                        array(
                                            "ROOT_MENU_TYPE" => "left",
                                            "MENU_CACHE_TYPE" => "A",
                                            "MENU_CACHE_TIME" => "36000000",
                                            "MENU_CACHE_USE_GROUPS" => "Y",
                                            "MENU_THEME" => "site",
                                            "CACHE_SELECTED_ITEMS" => "N",
                                            "MENU_CACHE_GET_VARS" => array(
                                            ),
                                            "MAX_LEVEL" => "3",
                                            "CHILD_MENU_TYPE" => "left",
                                            "USE_EXT" => "Y",
                                            "DELAY" => "N",
                                            "ALLOW_MULTI_SELECT" => "N",
                                            "COMPONENT_TEMPLATE" => "smart_catalog"
                                        ),
                                        false
                                    );?>
                                    <div class="catalogList__wrapper catalogList__brands" id="js_brands">
                                        <nav class="catalogList__brandNavigation" role="brands">
                                            <ul class="catalogList__brandList group group--md">
                                                <li class="catalogList__brandLitera col col-3-tl"> <span>A</span>
                                                    <ul class="catalogList__barandList">
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">ALPEN</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Armodillo</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Ananas</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Aquatika</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="catalogList__brandLitera col col-3-tl"> <span>B</span>
                                                    <ul class="catalogList__barandList">
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">ALPEN</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Armodillo</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Ananas</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Aquatika</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="catalogList__brandLitera col col-3-tl"> <span>B</span>
                                                    <ul class="catalogList__barandList">
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">ALPEN</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Armodillo</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Ananas</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Aquatika</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="catalogList__brandLitera col col-3-tl"> <span>A</span>
                                                    <ul class="catalogList__barandList">
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">ALPEN</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Armodillo</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Ananas</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Aquatika</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="catalogList__brandLitera col col-3-tl"> <span>B</span>
                                                    <ul class="catalogList__barandList">
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">ALPEN</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Armodillo</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Ananas</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Aquatika</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="catalogList__brandLitera col col-3-tl"> <span>B</span>
                                                    <ul class="catalogList__barandList">
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">ALPEN</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Armodillo</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Ananas</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Aquatika</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="catalogList__brandLitera col col-3-tl"> <span>A</span>
                                                    <ul class="catalogList__barandList">
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">ALPEN</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Armodillo</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Ananas</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Aquatika</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="catalogList__brandLitera col col-3-tl"> <span>B</span>
                                                    <ul class="catalogList__barandList">
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">ALPEN</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Armodillo</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Ananas</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Aquatika</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="catalogList__brandLitera col col-3-tl"> <span>B</span>
                                                    <ul class="catalogList__barandList">
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">ALPEN</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Armodillo</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Ananas</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Aquatika</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="catalogList__brandLitera col col-3-tl"> <span>A</span>
                                                    <ul class="catalogList__barandList">
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">ALPEN</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Armodillo</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Ananas</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Aquatika</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="catalogList__brandLitera col col-3-tl"> <span>B</span>
                                                    <ul class="catalogList__barandList">
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">ALPEN</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Armodillo</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Ananas</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Aquatika</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="catalogList__brandLitera col col-3-tl"> <span>B</span>
                                                    <ul class="catalogList__barandList">
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">ALPEN</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Armodillo</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Ananas</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Aquatika</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="catalogList__brandLitera col col-3-tl"> <span>A</span>
                                                    <ul class="catalogList__barandList">
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">ALPEN</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Armodillo</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Ananas</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Aquatika</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="catalogList__brandLitera col col-3-tl"> <span>B</span>
                                                    <ul class="catalogList__barandList">
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">ALPEN</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Armodillo</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Ananas</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Aquatika</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li class="catalogList__brandLitera col col-3-tl"> <span>B</span>
                                                    <ul class="catalogList__barandList">
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">ALPEN</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Armodillo</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Ananas</a>
                                                        </li>
                                                        <li class="catalogList__barandItem"><a class="catalogLink sub" href="" data-qcontent="element__LINKS__catalogLink">Aquatika</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- MAIN -->
    <div class="level__inner">
        <div class="container">
            <div class="group group-md">
                <div class="col col-12-tp">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:breadcrumb",
                        "sts2",
                        array(
                            "START_FROM" => "0",
                            "PATH" => "",
                            "SITE_ID" => "-"
                        ),
                        false,
                        array(
                            "HIDE_ICONS" => "N"
                        )
                    );?>
                </div>
            </div>