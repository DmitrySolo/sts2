<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
use Bitrix\Sale;

if (!empty($arResult["ORDER"]))
{
    ?>


    <? if (isPartnerClient()){ ?>

    <?
    include_once $_SERVER["DOCUMENT_ROOT"].'/testzone/util/platform.php';
    include_once getPlatformPath();
    /*$db_order = CSaleOrderPropsValue::GetList(
        array("SORT" => "ASC"),
        array(
            "ORDER_ID" => $arResult["ORDER_ID"],
            "ORDER_PROPS_ID" => 73
        )
    );*/

    $pl = new Platform();
    $arManager = $pl->getManagerByPartnerId(isPartnerClient());
    $order_num = $arResult["ORDER"]["ACCOUNT_NUMBER"];
    /*if ($arOrderProp = $db_order->Fetch())
        $order_num = $arOrderProp['VALUE'];*/
    ?>
    <div class="col col-12-tp">
        <section class="order__form clearfix order__form--confirmed">
            <div class="order__checkPoint--gone">
                <div class="order__checkPointNum"></div>
                <h3 class="order__fsuccesTitle">Заявка оформлена.</h3>
                <p class="order__fsuccesTitle text">Ваша заявка <a href='<?=$arParams["PATH_TO_PERSONAL"]?>detail/<?=$arResult["ORDER"]["ACCOUNT_NUMBER"]?>/' class="order__number" target="_blank"><?=$order_num?></a>
                    принята на обработку.</p>

                <ul class="orderPage__subMess">
                    <?if($arManager){?>
                        <li>В настоящий момент заявка ожидает подтверждения менеджером.</li>
                        <li>Ваш ответственный менеджер <a href='/partner-manager'><?=$arManager['UF_FIO']?></a> автоматически оповещен.</li>
                    <?}?>
                    <li>Отслеживать статус заявки вы можете в <a href='<?=$arParams["PATH_TO_PERSONAL"]?>'>личном кабинете</a>.</li>
                    <li>Электронная копия заявки отправлена на указанный вами email.</li>
                </ul>

                <?
                if (!empty($arResult["PAY_SYSTEM"])) {
                    ?>
                    <p class="text">
                        <?= GetMessage("SOA_TEMPL_PAY") ?><br>
                        <?= CFile::ShowImage($arResult["PAY_SYSTEM"]["LOGOTIP"], 100, 100, "border=0", "", false); ?><br>
                        <?= $arResult["PAY_SYSTEM"]["NAME"] ?>
                    </p>
                    <?
                    if (strlen($arResult["PAY_SYSTEM"]["ACTION_FILE"]) > 0) {
                        ?>
                        <p class="text">
                        <?
                        if ($arResult["PAY_SYSTEM"]["NEW_WINDOW"] == "Y") {
                            ?>
                            <script language="JavaScript">
                                window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))?>');
                            </script>
                            <h4><?= GetMessage("SOA_TEMPL_PAY_LINK", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"] . "?ORDER_ID=" . urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"])))) ?></h4>
                            <?
                            if (CSalePdf::isPdfAvailable() && CSalePaySystemsHelper::isPSActionAffordPdf($arResult['PAY_SYSTEM']['ACTION_FILE'])) {
                                ?><br/>
                                <?= GetMessage("SOA_TEMPL_PAY_PDF", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"] . "?ORDER_ID=" . urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"])) . "&pdf=1&DOWNLOAD=Y")) ?>
                                <?
                            }
                        } else {
                            if (strlen($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"]) > 0) {
                                include($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"]);
                            }
                        }
                        ?>
                        </p>
                        <?
                    }
                }
                ?>

                <div class="orderPage__actions"><a href="/personal/">&larr; В личный Кабинет</a><br/><a href="/">&larr; На главную</a></div>
            </div>
        </section>
    </div>

<? }else {

    $order_num = $arResult["ORDER"]["ACCOUNT_NUMBER"];

    $order = Sale\Order::load($arResult["ORDER_ID"]);
    $personType = $order->getPersonTypeId();
    $propertyCollection = $order->getPropertyCollection();
    $somePropValue = $propertyCollection->getItemByOrderPropertyId($personType == 1 ? 70 : 73); //$bill1CPropValue
    $bill1C = $somePropValue->getValue();
    if($order_num != $bill1C) {
        $order_num = $bill1C;

        $order->setField('ACCOUNT_NUMBER', $order_num);
        $order->save();

        LocalRedirect($APPLICATION->GetCurPageParam("ORDER_ID=".urlencode($order_num),array("ORDER_ID"), false));
    }

        ?>

    <div class="col col-12-tp">
        <section class="order__form clearfix order__form--confirmed">
            <div class="order__checkPoint--gone">
                <div class="order__checkPointNum"></div>
                <h3 class="order__fsuccesTitle">Заказ оформлен    </h3>
                <p class="order__fsuccesTitle text">Ваш заказ <a href='<?=$arParams["PATH_TO_PERSONAL"]?>detail/<?=$arResult["ORDER"]["ACCOUNT_NUMBER"]?>/' class="order__number" target="_blank"><span class="order__number"><?=$order_num?></span></a> от <?=date('d.m.Y H:i:s')?> успешно создан.</p>
                <p class="text">Вы можете следить за выполнением своего заказа в Персональном разделе сайта. Обратите внимание, что для входа в этот раздел вам необходимо будет ввести логин и пароль пользователя сайта.</p>

                <?
                if (!empty($arResult["PAY_SYSTEM"])) {
                    ?>
                    <p class="text">
                        <?= GetMessage("SOA_TEMPL_PAY") ?><br>
                        <?= CFile::ShowImage($arResult["PAY_SYSTEM"]["LOGOTIP"], 100, 100, "border=0", "", false); ?><br>
                        <?= $arResult["PAY_SYSTEM"]["NAME"] ?>
                    </p>
                    <?
                    if (strlen($arResult["PAY_SYSTEM"]["ACTION_FILE"]) > 0) {
                        ?>
                        <p class="text">
                            <?
                            if ($arResult["PAY_SYSTEM"]["NEW_WINDOW"] == "Y") {
                                ?>
                                <script language="JavaScript">
                                    window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))?>');
                                </script>
                                <h4><?= GetMessage("SOA_TEMPL_PAY_LINK", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"] . "?ORDER_ID=" . urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"])))) ?></h4>
                                <?
                                if (CSalePdf::isPdfAvailable() && CSalePaySystemsHelper::isPSActionAffordPdf($arResult['PAY_SYSTEM']['ACTION_FILE'])) {
                                    ?><br/>
                                    <?= GetMessage("SOA_TEMPL_PAY_PDF", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"] . "?ORDER_ID=" . urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"])) . "&pdf=1&DOWNLOAD=Y")) ?>
                                    <?
                                }
                            } else {
                                if (strlen($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"]) > 0) {
                                    include($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"]);
                                }
                            }
                            ?>
                        </p>
                        <?
                    }
                }
                ?>
                <div class="orderPage__actions"><a href="/personal/">&larr; В личный Кабинет</a><br/><a href="/">&larr; На главную</a></div>
            </div>
        </section>
    </div>
    <?
}
}
else
{
    ?>
    <b><?=GetMessage("SOA_TEMPL_ERROR_ORDER")?></b><br /><br />

    <table class="sale_order_full_table">
        <tr>
            <td>
                <?=GetMessage("SOA_TEMPL_ERROR_ORDER_LOST", Array("#ORDER_ID#" => $arResult["ACCOUNT_NUMBER"]))?>
                <?=GetMessage("SOA_TEMPL_ERROR_ORDER_LOST1")?>
            </td>
        </tr>
    </table>
    <?
}
?>
