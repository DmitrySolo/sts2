<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
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
    <section class="orderPage__content orderPage__content" data-qcontent="level__orderPage">
        <h2 class="orderPage__title">Заявка оформлена.</h2>
        <p class="orderPage__mainMessage text">Ваша заявка <a href='<?=$arParams["PATH_TO_PERSONAL"]?>detail/<?=$arResult["ORDER"]["ACCOUNT_NUMBER"]?>/' target="_blank"><?=$order_num?></a>
            принята на обработку.
        </p>
        <ul class="orderPage__subMess">
            <?if($arManager){?>
                <li>В настоящий момент заявка ожидает подтверждения менеджером.</li>
                <li>Ваш ответственный менеджер <a href='/partner-manager'><?=$arManager['UF_FIO']?></a> автоматически оповещен.</li>
            <?}?>
            <li>Отслеживать статус заявки вы можете в <a href='<?=$arParams["PATH_TO_PERSONAL"]?>'>личном кабинете</a>.</li>
            <li>Электронная копия заявки отправлена на указанный вами email.</li>
        </ul>

        <div class="orderPage__actions"><a href="/personal/">&larr; В личный Кабинет</a><br/><a href="/">&larr; На главную</a></div>
    </section>

    <?
    if ($arResult["ORDER"]["IS_ALLOW_PAY"] === 'Y')
    {
        if (!empty($arResult["PAYMENT"]))
        {
            foreach ($arResult["PAYMENT"] as $payment)
            {
                if ($payment["PAID"] != 'Y')
                {
                    if (!empty($arResult['PAY_SYSTEM_LIST'])
                        && array_key_exists($payment["PAY_SYSTEM_ID"], $arResult['PAY_SYSTEM_LIST'])
                    )
                    {
                        $arPaySystem = $arResult['PAY_SYSTEM_LIST'][$payment["PAY_SYSTEM_ID"]];

                        if (empty($arPaySystem["ERROR"]))
                        {
                            ?>
                            <br /><br />

                            <table class="sale_order_full_table">
                                <!--<tr>
									<td class="ps_logo">
										<div class="pay_name"><?=Loc::getMessage("SOA_PAY") ?></div>
										<?=CFile::ShowImage($arPaySystem["LOGOTIP"], 100, 100, "border=0\" style=\"width:100px\"", "", false) ?>
										<div class="paysystem_name"><?=$arPaySystem["NAME"] ?></div>
										<br/>
									</td>
								</tr>-->
                                <tr>
                                    <td>
                                        <? if (strlen($arPaySystem["ACTION_FILE"]) > 0 && $arPaySystem["NEW_WINDOW"] == "Y" && $arPaySystem["IS_CASH"] != "Y"): ?>
                                            <?
                                            $orderAccountNumber = urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]));
                                            $paymentAccountNumber = $payment["ACCOUNT_NUMBER"];
                                            ?>
                                            <script>
                                                window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=$orderAccountNumber?>&PAYMENT_ID=<?=$paymentAccountNumber?>');
                                            </script>
                                        <?//=Loc::getMessage("SOA_PAY_LINK", array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$orderAccountNumber."&PAYMENT_ID=".$paymentAccountNumber))?>
                                        <? if (CSalePdf::isPdfAvailable() && $arPaySystem['IS_AFFORD_PDF']): ?>
                                        <br/>
                                            <?=Loc::getMessage("SOA_PAY_PDF", array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$orderAccountNumber."&pdf=1&DOWNLOAD=Y"))?>
                                        <? endif ?>
                                        <? else: ?>
                                            <?=$arPaySystem["BUFFERED_OUTPUT"]?>
                                        <? endif ?>
                                    </td>
                                </tr>
                            </table>

                            <?
                        }
                        else
                        {
                            ?>
                            <span style="color:red;"><?=Loc::getMessage("SOA_ORDER_PS_ERROR")?></span>
                            <?
                        }
                    }
                    else
                    {
                        ?>
                        <span style="color:red;"><?=Loc::getMessage("SOA_ORDER_PS_ERROR")?></span>
                        <?
                    }
                }
            }
        }
    }
    else
    {
        ?>
        <br /><strong><?=$arParams['MESS_PAY_SYSTEM_PAYABLE_ERROR']?></strong>
        <?
    }
    ?>

<? }else { ?>


    <b><?= GetMessage("SOA_TEMPL_ORDER_COMPLETE") ?></b><br/><br/>
    <table class="sale_order_full_table">
        <tr>
            <td>
                <?= GetMessage("SOA_TEMPL_ORDER_SUC", Array("#ORDER_DATE#" => $arResult["ORDER"]["DATE_INSERT"], "#ORDER_ID#" => $arResult["ORDER"]["ACCOUNT_NUMBER"])) ?>
                <br/><br/>
                <?= GetMessage("SOA_TEMPL_ORDER_SUC1", Array("#LINK#" => $arParams["PATH_TO_PERSONAL"])) ?>
            </td>
        </tr>
    </table>
    <?
    if (!empty($arResult["PAY_SYSTEM"])) {
        ?>
        <br/><br/>

        <table class="sale_order_full_table">
            <tr>
                <td class="ps_logo">
                    <div class="pay_name"><?= GetMessage("SOA_TEMPL_PAY") ?></div>
                    <?= CFile::ShowImage($arResult["PAY_SYSTEM"]["LOGOTIP"], 100, 100, "border=0", "", false); ?>
                    <div class="paysystem_name"><?= $arResult["PAY_SYSTEM"]["NAME"] ?></div>
                    <br>
                </td>
            </tr>
            <?
            if (strlen($arResult["PAY_SYSTEM"]["ACTION_FILE"]) > 0) {
                ?>
                <tr>
                    <td>
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
                    </td>
                </tr>
                <?
            }
            ?>
        </table>
        <?
    }
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
