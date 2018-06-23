<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
</div>
</div>
</div>
<!-- FOOTER --><!-- split footer.html -->
<footer class="mainFooter" data-qcontent="layout__footer">
    <div class="bottomFeatures" data-qcontent="module__bottomFeatures">
        <div class="level__inner">
            <div class="container">
                <div class="mainInfo__logo"><a href="/"></a>
                    <h3><img src="<?= SITE_TEMPLATE_PATH . "/source/images/sts-logo.svg"; ?>"
                             alt="santehsmart Сантехсмарт"/></h3>
                </div>
                <h2 class="text"><span>Первый </span>Сантех-Дискаунтер в <strong>Воронеже</strong>!</h2>
                <div class="group group--bl">
                    <div class="col col-4-tl t-center">
                        <svg class="icon " data-qcontent="element__ICONS__MAIN-SVG-use">
                            <use xlink:href="#smartbonus"></use>
                        </svg>
                        <h4><span class="accent">Смарт</span> <span>Бонус</span></h4>
                        <p>Экономьте впрок! За каждую покупку вы получаете СмартБонусы, 1 СмартБонус = 1р. Оплачивать
                            СмартБонусами можно до 100% стоимости товара!</p>
                    </div>
                    <div class="col col-4-tl t-center">
                        <svg class="icon " data-qcontent="element__ICONS__MAIN-SVG-use">
                            <use xlink:href="#wrecle"></use>
                        </svg>
                        <h4><span class="accent">Смарт</span> <span>Сервис</span></h4>
                        <p>Бесплатная доставка для заказов свыше 4000руб., установка, гарантийное и постгарантийное
                            обслуживание.</p>
                    </div>
                    <div class="col col-4-tl t-center">
                        <svg class="icon " data-qcontent="element__ICONS__MAIN-SVG-use">
                            <use xlink:href="#sslsh"></use>
                        </svg>
                        <h4><span class="accent">Смарт</span> <span>Покупка</span></h4>
                        <p>Ваши риски равны нулю! Данные защищены протоколами безопасности, которые на сегодняшний день
                            используются всеми ведущими инетрнет-магазинами.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottomFeatures__home">
        <div class="level__inner">
            <div class="container">
                <strong>Будьте в курсе последних акций и распродаж. Подпишитесь!</strong>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:sender.subscribe",
                    "sts2",
                    array(
                        "COMPONENT_TEMPLATE" => "sts2",
                        "USE_PERSONALIZATION" => "Y",
                        "CONFIRMATION" => "N",
                        "SHOW_HIDDEN" => "Y",
                        "AJAX_MODE" => "Y",
                        "AJAX_OPTION_JUMP" => "Y",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "Y",
                        "HIDE_MAILINGS" => "Y",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "3600",
                        "SET_TITLE" => "N",
                        "USER_CONSENT" => "N",
                        "USER_CONSENT_ID" => "0",
                        "USER_CONSENT_IS_CHECKED" => "Y",
                        "USER_CONSENT_IS_LOADED" => "N",
                        "AJAX_OPTION_ADDITIONAL" => ""
                    ),
                    false
                ); ?>
            </div>
        </div>
    </div>
    <div class="footer__content" data-qcontent="component__footer">
        <div class="footer__section">
            <div class="container">
                <div class="footer__subMenus">
                    <div class="group group--md">
                        <div class="col col-3-tl">
                            <h5 class="footer__listTitle">Клиентам</h5>
                            <ul class="footer__list">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:menu",
                                    "footer_Client",
                                    Array(
                                        "ROOT_MENU_TYPE" => "footerClient",
                                        "MAX_LEVEL" => "1",
                                        "CHILD_MENU_TYPE" => "footer_Client",
                                        "USE_EXT" => "N",
                                        "DELAY" => "N",
                                        "ALLOW_MULTI_SELECT" => "N",
                                        "MENU_CACHE_TYPE" => "A",
                                        "MENU_CACHE_TIME" => "3600",
                                        "MENU_CACHE_USE_GROUPS" => "Y",
                                        "MENU_CACHE_GET_VARS" => array()
                                    )
                                ); ?>

                            </ul>
                        </div>
                        <div class="col col-3-tl">
                            <h5 class="footer__listTitle">СантехСмарт</h5>
                            <ul class="footer__list">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:menu",
                                    "footer_Client",
                                    Array(
                                        "ROOT_MENU_TYPE" => "footerPartner",
                                        "MAX_LEVEL" => "1",
                                        "CHILD_MENU_TYPE" => "footer_Client",
                                        "USE_EXT" => "N",
                                        "DELAY" => "N",
                                        "ALLOW_MULTI_SELECT" => "N",
                                        "MENU_CACHE_TYPE" => "A",
                                        "MENU_CACHE_TIME" => "3600",
                                        "MENU_CACHE_USE_GROUPS" => "Y",
                                        "MENU_CACHE_GET_VARS" => array()
                                    )
                                ); ?>
                            </ul>
                        </div>
                        <div class="col col-3-tl">
                            <h5 class="footer__listTitle">Способы оплаты</h5>
                            <ul class="footer__list">
                                <li class="footer__listItem">
                                    <svg class="icon icon--footer" data-qcontent="element__ICONS__MAIN-SVG-use">
                                        <use xlink:href="#ruble"></use>
                                    </svg>
                                    <svg class="icon icon--footer" data-qcontent="element__ICONS__MAIN-SVG-use">
                                        <use xlink:href="#mir-logo2"></use>
                                    </svg>
                                    <svg class="icon icon--footer" data-qcontent="element__ICONS__MAIN-SVG-use">
                                        <use xlink:href="#mastercard-logo"></use>
                                    </svg>
                                    <svg class="icon icon--footer" data-qcontent="element__ICONS__MAIN-SVG-use">
                                        <use xlink:href="#maestro-logo"></use>
                                    </svg>
                                    <svg class="icon icon--footer" data-qcontent="element__ICONS__MAIN-SVG-use">
                                        <use xlink:href="#visa-logo"></use>
                                    </svg>
                                </li>
                            </ul>
                        </div>
                        <div class="col col-3-tl">
                            <h5 class="footer__listTitle">Мы в соцсетях</h5>
                            <ul class="footer__list" itemscope itemtype="http://schema.org/Organization">
                                <link itemprop="url" href="https://www.santehsmart.ru">
                                <li class="footer__listItem">
                                    <a itemprop="sameAs" class="footer__link" href="https://vk.com/santehsmart_shop"
                                       target="_blank" ">
                                    <svg class="icon icon--footer social" data-qcontent="element__ICONS__MAIN-SVG-use">
                                        <use xlink:href="#vk"></use>
                                    </svg>
                                    </a>
                                </li>
                                <li class="footer__listItem">
                                    <a itemprop="sameAs" class="footer__link"
                                       href="https://www.facebook.com/profile.php?id=100004523179100" target="_blank">
                                        <svg class="icon icon--footer social"
                                             data-qcontent="element__ICONS__MAIN-SVG-use">
                                            <use xlink:href="#facebook"></use>
                                        </svg>
                                    </a>
                                </li>
                                <li class="footer__listItem">
                                    <a itemprop="sameAs" class="footer__link" href="https://twitter.com/Santeh_Smart"
                                       target="_blank">
                                        <svg class="icon icon--footer social"
                                             data-qcontent="element__ICONS__MAIN-SVG-use">
                                            <use xlink:href="#twitter"></use>
                                        </svg>
                                    </a>
                                </li>
                                <li class="footer__listItem">
                                    <a itemprop="sameAs" lass="footer__link"
                                       href="https://ru.pinterest.com/santehsmart/" target="_blank">
                                        <svg class="icon icon--footer social"
                                             data-qcontent="element__ICONS__MAIN-SVG-use">
                                            <use xlink:href="#pinterest"></use>
                                        </svg>
                                    </a>
                                </li>

                                <li class="footer__listItem">
                                    <a class="footer__link" href="https://t.me/joinchat/AAAAAFJI5uXSOdo9MTt11w"
                                       rel="nofollow" target="_blank">
                                        <svg class="icon icon--footer social"
                                             data-qcontent="element__ICONS__MAIN-SVG-use">
                                            <use xlink:href="#telegram"></use>
                                        </svg>
                                    </a>
                                </li>

                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__signature">
            <div class="container">
                <div class="group group--md">
                    <div class="col col-12-tl">
                        <p>ООО "САНТЕХCМАРТ" 2014-2018 </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modalWindow overlay modalWindow--hide modalWindow--searchm" id="js_modall__searchm">
        <? $APPLICATION->IncludeComponent(
            "bitrix:search.title",
            "sts2-mobile",
            array(
                "NUM_CATEGORIES" => "1",
                "TOP_COUNT" => "15",
                "CHECK_DATES" => "N",
                "SHOW_OTHERS" => "N",
                "PAGE" => SITE_DIR . "catalog/",
                "CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS"),
                "CATEGORY_0" => array(
                    0 => "iblock_catalog",
                ),
                "CATEGORY_0_iblock_catalog" => array(
                    0 => "10",
                ),
                "CATEGORY_OTHERS_TITLE" => GetMessage("SEARCH_OTHER"),
                "SHOW_INPUT" => "Y",
                "INPUT_ID" => "mobile-input-search",
                "CONTAINER_ID" => "mobile-search",
                "PRICE_CODE" => array(
                    0 => "BASE",
                ),
                "SHOW_PREVIEW" => "N",
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
            false); ?>
    </div>
    <div class="modalWindow overlay modalWindow--hide modalWindow--call" id="js_modall__call">
        <div class="modalWindow__content modalWindow__content" data-qcontent="level__modalWindow"><a
                    class="modalWindow__close">
                <svg class="icon icon--close" data-qcontent="element__ICONS__MAIN-SVG-use">
                    <use xlink:href="#close"></use>
                </svg>
            </a>
            <h3 class="modalWindow__title">Связаться с нами:</h3>
            <div class="modalWindow__body">
                <a class="actionLink contactUs icon-cellphone " href="tel:88005001384"
                   data-qcontent="element__LINKS__actionLink">Позвонить (Бесплатно по России)</a>
                <a class="actionLink contactUs icon-email " href="mailto:sale@santehsmart.ru?Subject=Mobile%20message"
                   data-qcontent="element__LINKS__actionLink">Написать на наш email</a>
                <a class="actionLink contactUs icon-cu_telegram " href="" data-qcontent="element__LINKS__actionLink">Написать
                    нам в Telegram</a>
            </div>
        </div>
    </div>
    <div class="modalWindow overlay modalWindow--hide" id="js_modall__geo">
        <div class="modalWindow__content modalWindow__content" data-qcontent="level__modalWindow"><a
                    class="modalWindow__close">
                <svg class="icon icon--close" data-qcontent="element__ICONS__MAIN-SVG-use">
                    <use xlink:href="#close"></use>
                </svg>
            </a></div>
    </div>


    <div class="hidden" id="svgContainer">
        <? require_once('SVGSpriteIcons.php'); ?>
    </div>
    </div>
    </div>
    </div>
    <? //include_once 'includes/footerCoupon.php'?>
    <script type="application/ld+json">
    {
        "@context": "http://schema.org",
        "@type": "Organization",
        "url": "https://www.santehsmart.ru",
        "logo": "https://www.santehsmart.ru/logo.png"
    }
</script>
</footer>
</body>
</html>