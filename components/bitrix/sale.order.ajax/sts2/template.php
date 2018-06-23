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

$APPLICATION->SetAdditionalCSS($templateFolder . "/style.css");
$this->addExternalJs($templateFolder . "/script.js");

CJSCore::Init(array('fx', 'popup', 'window', 'ajax'));
?>

<div class="page page--order">
    <div class="page__content page__contentundefined" data-qcontent="level__page">
        <!--        <div class="group">-->
        <!--            <div class="col col-12-tl">-->
        <!--                <h1 class="page__title">Оформление заказа</h1>-->
        <!--            </div>-->
        <!--        </div>-->
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
                <div class="bx_order_make">
                    <?
                    //  pre($arResult);
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
                                    $('#pvzWidjet').css('height','1px');

                                    if ($('.order__form--delivery .radio--selected .radio__input').attr('id') != 'ID_DELIVERY_ID_59') {
                                        var cityFromCoockie = '<?=$_SESSION['TF_LOCATION_SELECTED_CITY_NAME']?>';
                                      //  alert(cityFromCoockie);
                                        var sdekWdjetParams = {
                                            defaultCity: cityFromCoockie || 'Воронеж', //какой город отображается по умолчанию
                                            cityFrom: 'Воронеж', // из какого города будет идти доставка
                                            country: 'Россия', // можно выбрать страну, для которой отображать список ПВЗ
                                            link: 'pvzWidjet',
                                            servicepath: '/punkty-vydachi/pvzwidget/scripts/service.php',
                                            // onChoose: choose,
                                            choose: true,
                                        }
                                        $('#pvzWidjet').css('height','601px');
                                        Widjet = new ISDEKWidjet(sdekWdjetParams);
                                           setTimeout(function () {
                                                  // alert('hello')

                                            $('#deliveryPageCover').fadeOut('slow');
                                                },500)
                                        $('.CDEK-widget__choose.widget__loading').on('click','body',function () {
                                           // alert('OK');
                                        });

                                    }else{
                                        setTimeout(function () {
                                            $('#deliveryPageCover').fadeOut('slow');
                                        },500)
                                    }

                                    <?MOD::RUN('JsDOMElementChecker',['object' => 'ymaps-2-1-56-map','command' => 'submitForm();']);?>

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
                                <div class="group group--md" id="order_form_content">
                                    <?
                                    }
                                    else {
                                        $APPLICATION->RestartBuffer();
                                    }
                                    ?>
                                    <div class="col col-12-tl">
                                        <?
                                        if (!empty($arResult["ERROR"]) && $arResult["USER_VALS"]["FINAL_STEP"] == "Y") {
                                            foreach ($arResult["ERROR"] as $v)
                                                echo ShowError($v);
                                            ?>
                                            <script type="text/javascript">
                                                top.BX.scrollToNode(top.BX('ORDER_FORM'));
                                            </script>
                                            <?
                                        }
                                        $arResult['AJAX_PATH'] = $templateFolder;;
                                        $rsUser = $USER->GetByID($USER->GetID());
                                        $arUser = $rsUser->Fetch();
                                        $entity = $arUser['UF_PARTNER_XML_ID'];
                                        $arResult['PARTNER_ID'] = 0;
                                        $arResult['PARTNER_XML_ID'] = 0;
                                        if ($entity) $arResult['PARTNER_XML_ID'] = $entity;
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
                                        <section class="order__form order__form--active order__form--personal clearfix" >

                                            <? include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/person_type.php"); ?>
                                            <button type="button" class="toOrder active icon-to-right" onclick="submitForm();"
                                                data-qcontent="element__buttons__toOrder">Далее
                                            </button>
                                        </section>
                                        <section>
                                        <div class="order__form clearfix order__form--delivery" id="deliveryPage" >
                                            <div id="deliveryPageCover">
                                            <div class="cssload-thecube">
                                                <style>
                                                    .cssload-thecube {
                                                        width: 39px;
                                                        height: 39px;
                                                        margin: 0 auto;
                                                        margin-top: 10%;
                                                        position: relative;
                                                        transform: rotateZ(45deg);
                                                        -o-transform: rotateZ(45deg);
                                                        -ms-transform: rotateZ(45deg);
                                                        -webkit-transform: rotateZ(45deg);
                                                        -moz-transform: rotateZ(45deg);
                                                    }
                                                    .cssload-thecube .cssload-cube {
                                                        position: relative;
                                                        transform: rotateZ(45deg);
                                                        -o-transform: rotateZ(45deg);
                                                        -ms-transform: rotateZ(45deg);
                                                        -webkit-transform: rotateZ(45deg);
                                                        -moz-transform: rotateZ(45deg);
                                                    }
                                                    .cssload-thecube .cssload-cube {
                                                        float: left;
                                                        width: 50%;
                                                        height: 50%;
                                                        position: relative;
                                                        transform: scale(1.1);
                                                        -o-transform: scale(1.1);
                                                        -ms-transform: scale(1.1);
                                                        -webkit-transform: scale(1.1);
                                                        -moz-transform: scale(1.1);
                                                    }
                                                    .cssload-thecube .cssload-cube:before {
                                                        content: "";
                                                        position: absolute;
                                                        top: 0;
                                                        left: 0;
                                                        width: 100%;
                                                        height: 100%;
                                                        background-color: rgb(61,37,91);
                                                        animation: cssload-fold-thecube 3.48s infinite linear both;
                                                        -o-animation: cssload-fold-thecube 3.48s infinite linear both;
                                                        -ms-animation: cssload-fold-thecube 3.48s infinite linear both;
                                                        -webkit-animation: cssload-fold-thecube 3.48s infinite linear both;
                                                        -moz-animation: cssload-fold-thecube 3.48s infinite linear both;
                                                        transform-origin: 100% 100%;
                                                        -o-transform-origin: 100% 100%;
                                                        -ms-transform-origin: 100% 100%;
                                                        -webkit-transform-origin: 100% 100%;
                                                        -moz-transform-origin: 100% 100%;
                                                    }
                                                    .cssload-thecube .cssload-c2 {
                                                        transform: scale(1.1) rotateZ(90deg);
                                                        -o-transform: scale(1.1) rotateZ(90deg);
                                                        -ms-transform: scale(1.1) rotateZ(90deg);
                                                        -webkit-transform: scale(1.1) rotateZ(90deg);
                                                        -moz-transform: scale(1.1) rotateZ(90deg);
                                                    }
                                                    .cssload-thecube .cssload-c3 {
                                                        transform: scale(1.1) rotateZ(180deg);
                                                        -o-transform: scale(1.1) rotateZ(180deg);
                                                        -ms-transform: scale(1.1) rotateZ(180deg);
                                                        -webkit-transform: scale(1.1) rotateZ(180deg);
                                                        -moz-transform: scale(1.1) rotateZ(180deg);
                                                    }
                                                    .cssload-thecube .cssload-c4 {
                                                        transform: scale(1.1) rotateZ(270deg);
                                                        -o-transform: scale(1.1) rotateZ(270deg);
                                                        -ms-transform: scale(1.1) rotateZ(270deg);
                                                        -webkit-transform: scale(1.1) rotateZ(270deg);
                                                        -moz-transform: scale(1.1) rotateZ(270deg);
                                                    }
                                                    .cssload-thecube .cssload-c2:before {
                                                        animation-delay: 0.44s;
                                                        -o-animation-delay: 0.44s;
                                                        -ms-animation-delay: 0.44s;
                                                        -webkit-animation-delay: 0.44s;
                                                        -moz-animation-delay: 0.44s;
                                                    }
                                                    .cssload-thecube .cssload-c3:before {
                                                        animation-delay: 0.87s;
                                                        -o-animation-delay: 0.87s;
                                                        -ms-animation-delay: 0.87s;
                                                        -webkit-animation-delay: 0.87s;
                                                        -moz-animation-delay: 0.87s;
                                                    }
                                                    .cssload-thecube .cssload-c4:before {
                                                        animation-delay: 1.31s;
                                                        -o-animation-delay: 1.31s;
                                                        -ms-animation-delay: 1.31s;
                                                        -webkit-animation-delay: 1.31s;
                                                        -moz-animation-delay: 1.31s;
                                                    }
                                                    #deliveryPageCover{
                                                        background: #fff;
                                                                            position: absolute;
                                                                            /* width: 100%; */
                                                                            z-index: 10000;
                                                                            height: 1000px;
                                                                            margin: 0 auto;
                                                                            left: 12px;
                                                                            right: 12px;
                                                                            top: 135px;
                                                    }
                                                    .CDEK-widget__search{
                                                        display: none;
                                                        }
                                                   button.onePointButton{
                                                        display: none !important;
                                                    }
                                                   .mod1 button.onePointButton{
                                                       display: inline-block  !important;
                                                   }
                                                        #pvzWidjet{
                                                            border: solid 3px #3d255b;
                                                            border-top-width:4px;

                                                        }
                                                        .errortext{
                                                            padding: 25px;
                                                            color: #f00;
                                                        }
                                                    .radio.radio--selected {
                                                     
                                                    }
                                                    .deliveryPageCover .radio.radio--selected{
                                                        border-bottom: none;
                                                    }
                                                         .order__form--delivery .radio__label{
                                                            font-size: 1.1rem;
                                                         }
                                                    @keyframes cssload-fold-thecube {
                                                        0%, 10% {
                                                            transform: perspective(73px) rotateX(-180deg);
                                                            opacity: 0;
                                                        }
                                                        25%,
                                                        75% {
                                                            transform: perspective(73px) rotateX(0deg);
                                                            opacity: 1;
                                                        }
                                                        90%,
                                                        100% {
                                                            transform: perspective(73px) rotateY(180deg);
                                                            opacity: 0;
                                                        }
                                                    }

                                                    @-o-keyframes cssload-fold-thecube {
                                                        0%, 10% {
                                                            -o-transform: perspective(73px) rotateX(-180deg);
                                                            opacity: 0;
                                                        }
                                                        25%,
                                                        75% {
                                                            -o-transform: perspective(73px) rotateX(0deg);
                                                            opacity: 1;
                                                        }
                                                        90%,
                                                        100% {
                                                            -o-transform: perspective(73px) rotateY(180deg);
                                                            opacity: 0;
                                                        }
                                                    }

                                                    @-ms-keyframes cssload-fold-thecube {
                                                        0%, 10% {
                                                            -ms-transform: perspective(73px) rotateX(-180deg);
                                                            opacity: 0;
                                                        }
                                                        25%,
                                                        75% {
                                                            -ms-transform: perspective(73px) rotateX(0deg);
                                                            opacity: 1;
                                                        }
                                                        90%,
                                                        100% {
                                                            -ms-transform: perspective(73px) rotateY(180deg);
                                                            opacity: 0;
                                                        }
                                                    }

                                                    @-webkit-keyframes cssload-fold-thecube {
                                                        0%, 10% {
                                                            -webkit-transform: perspective(73px) rotateX(-180deg);
                                                            opacity: 0;
                                                        }
                                                        25%,
                                                        75% {
                                                            -webkit-transform: perspective(73px) rotateX(0deg);
                                                            opacity: 1;
                                                        }
                                                        90%,
                                                        100% {
                                                            -webkit-transform: perspective(73px) rotateY(180deg);
                                                            opacity: 0;
                                                        }
                                                    }

                                                    @-moz-keyframes cssload-fold-thecube {
                                                        0%, 10% {
                                                            -moz-transform: perspective(73px) rotateX(-180deg);
                                                            opacity: 0;
                                                        }
                                                        25%,
                                                        75% {
                                                            -moz-transform: perspective(73px) rotateX(0deg);
                                                            opacity: 1;
                                                        }
                                                        90%,
                                                        100% {
                                                            -moz-transform: perspective(73px) rotateY(180deg);
                                                            opacity: 0;
                                                        }
                                                    }

                                                </style>
                                                <div class="cssload-cube cssload-c1"></div>
                                                <div class="cssload-cube cssload-c2"></div>
                                                <div class="cssload-cube cssload-c4"></div>
                                                <div class="cssload-cube cssload-c3"></div>
                                            </div>
                                        </div>
                                            <? include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/delivery.php"); ?>
                                            <button type="button" id="deliveryNext" class="toOrder active icon-to-right"
                                                    style="display:none"
                                                    data-qcontent="element__buttons__toOrder">Далее
                                            </button>
                                        </section>
                                        <section class="order__form clearfix order__form--paysystem" >
                                            <? include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/paysystem.php"); ?>
                                            <button type="button" class="toOrder active icon-to-right"
                                                    data-qcontent="element__buttons__toOrder">Далее
                                            </button>


                                        </section>
                                        <section class="order__form order__form--client clearfix">
                                            <?
                                            include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/props.php");
                                            include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/related_props.php");
                                            if (strlen($arResult["PREPAY_ADIT_FIELDS"]) > 0)
                                               // echo $arResult["PREPAY_ADIT_FIELDS"];
                                            include($_SERVER["DOCUMENT_ROOT"] . $templateFolder . "/summary.php");
                                            ?>
                                            <label style="display:block;text-align:center;font-size:18px;"
                                                   class="conf-label"><input
                                                        type="checkbox" name="confidential" id="confidential" checked
                                                        style="margin-right:10px;">Я согласен с <a
                                                        href="/info/confedential-politic/" target="_blank">Политикой
                                                    конфиденциальности</a></input></label>
                                            <script>var preSubmitForm = function () {
                                                    var conf = $('#confidential').is(':checked');
                                                    if (conf) {
                                                        submitForm('Y');
                                                    } else {
                                                        $('.conf-label').css('color', 'red').css('font-weight', 'bold');
                                                    }
                                                }</script>
                                            <button type="button"
                                                    class="toOrder active makeOrder checkout"
                                                    data-qcontent="element__buttons__toOrder"
                                                    id="ORDER_CONFIRM_BUTTON"
                                                    onclick="preSubmitForm(); return false;"><?= GetMessage("SOA_TEMPL_BUTTON") ?></button>
                                        </section>
                                        <section class="order__form clearfix order__form--summary">
                                        </section>

                                        <?
                                        $STS_ADC = $APPLICATION->get_cookie("STS_ADC");
                                        $STS_ARN = $APPLICATION->get_cookie("STS_ARN");
                                        ?>
                                    </div>
                                    <div class="col col-12-tp hidden">
                                        <section class="order__form clearfix order__form--confirmed">
                                            <div class="order__checkPoint--gone">
                                                <div class="order__checkPointNum"></div>
                                                <h3 class="order__fsuccesTitle">Заказ оформлен</h3>
                                                <p class="order__fsuccesTitle text">Ваш заказ <span
                                                            class="order__number">№1111519  </span>от 17.01.2018
                                                    15:48:54 успешно создан.</p>
                                                <p class="text">Вы можете следить за выполнением своего заказа в
                                                    Персональном разделе сайта. Обратите внимание, что для входа в этот
                                                    раздел вам необходимо будет ввести логин и пароль пользователя
                                                    сайта.</p>
                                            </div>
                                        </section>
                                    </div>
                                    <input id='pvzTITLE' type="hidden" name="ORDER_PROP_68" value="">
                                    <input type="hidden" name="ORDER_PROP_69" value="<?= $STS_ADC ?>">
                                    <input type="hidden" name="ORDER_PROP_71" value="<?= $STS_ARN ?>">
                                    <input type="hidden" name="ORDER_PROP_72" value="<?= $arResult['PARTNER_ID'] ?>">
                                    <input type="hidden" name="ORDER_PROP_73">
                                    <input type="hidden" name="ORDER_PROP_74">
                                    <input type="hidden" name="ORDER_PROP_75">
                                    <input type="hidden" name="confirmorder" id="confirmorder" value="Y">
                                    <input type="hidden" name="profile_change" id="profile_change" value="N">
                                    <input type="hidden" name="is_ajax_post" id="is_ajax_post" value="Y">
                                    <input type="hidden" name="json" value="Y">
                                    <div class="col col-3-tl">
                                        <?
                                        $basket_count = count($arResult["BASKET_ITEMS"]);
                                        $price_without_discount = number_format($arResult["JS_DATA"]["TOTAL"]["PRICE_WITHOUT_DISCOUNT_VALUE"], 0, '', ' ');
                                        $discount_price = number_format($arResult["JS_DATA"]["TOTAL"]["DISCOUNT_PRICE"], 0, '', ' ');
                                        $order_price = number_format($arResult["JS_DATA"]["TOTAL"]["ORDER_PRICE"], 0, '', ' ');
                                        $delivery_price = number_format($arResult["JS_DATA"]["TOTAL"]["DELIVERY_PRICE"], 0, '', ' ');
                                        $total_price = number_format($arResult["JS_DATA"]["TOTAL"]["ORDER_TOTAL_PRICE"], 0, '', ' ');
                                        ?>

                                        <section class="order__info">
                                            <h5 class="order__infoTitle">Состав заказа:</h5><span
                                                    class="order__infoItem">Товаров: <?= $basket_count ?> шт</span><span
                                                    class="order__infoItem">На сумму: <?= $order_price ?> р </span><span
                                                    class="order__infoItem">Доставка: <?= $delivery_price ?> р</span>
                                            <h6 class="order__infoSumm">Итого: <?= $total_price ?> р</h6>
                                            <button type="button" onclick="window.location.pathname='/personal/cart';"
                                                    class="button button--fastBuy"
                                                    data-qcontent="element__buttons__button">Изменить cостав заказа
                                            </button>
                                        </section>
                                    </div>
                                    <?
                                    if ($_POST["is_ajax_post"] != "Y")
                                    {
                                    ?>
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

                        $('body').on('click','.CDEK-widget__choose',function () {

                            if( $(this).text()=='Далее' ){
                                $('#deliveryNext').trigger('click');
                            }else   $(this).text('Далее');

                         //   CDEK-widget__panel-list__item-adress
                         //  $('#pvzTITLE').val($('#pvzChosenAddr').text());

                            var pvztxt = $('.CDEK-widget__panel-details__block-text').text()
                            if(pvztxt){
                                $('#partnerPvzTitle').val('');
                            }
                            $('#pvzTITLE').val(pvztxt);

                        });
                        $('.order__form--personal,label[for="ID_DELIVERY_ID_59"]').on('click',function () {
                            setTimeout(function () {
                                $('#deliveryPageCover').fadeOut('slow');
                            },4000)
                        })

                        $('body').on('click','.order__form--personal button',function () {

                            var cityFromCoockie = '<?=$_SESSION['TF_LOCATION_SELECTED_CITY_NAME']?>';
                            var sdekWdjetParams = {
                                defaultCity: cityFromCoockie || 'Воронеж', //какой город отображается по умолчанию
                                cityFrom: 'Воронеж', // из какого города будет идти доставка
                                country: 'Россия', // можно выбрать страну, для которой отображать список ПВЗ
                                link: 'pvzWidjet',
                                servicepath: '/punkty-vydachi/pvzwidget/scripts/service.php',
//                                onChoose : function(info){
//
//                                 alert(info);
//                                 console.log(info);
//                                  return false;
//                                },

                                choose: true,
                            }

                            if($('.CDEK-widget__panel-list__item').length == 1){

                                var msgPvz = $('.CDEK-widget__panel-list__item .CDEK-widget__panel-list__item-name').text()+', '+$('.CDEK-widget__panel-list__item .CDEK-widget__panel-list__item-adress').text().trim();

                                $('#pvzTITLE').val(msgPvz);

                            }
                            Widjet = new ISDEKWidjet(sdekWdjetParams);

                        });
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
