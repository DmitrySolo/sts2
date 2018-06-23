<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

	$Logistic =	Logistic::getInstance($_SESSION['TF_LOCATION_SELECTED_CITY_NAME']);
	$exceptionPoint = 0;
	$partnersPVZArr = $Logistic->partnersPVZArr;
   // pre($arResult["DELIVERY"]);
	if(!$partnersPVZArr){
		$exceptionPoint = '67';
	}else{
    $exceptionPoint = '59';
    }


?>

	<script type="text/javascript">
		function fShowStore(id, showImages, formWidth, siteId) {
			var strUrl = '<?=$templateFolder?>' + '/map.php';
			var strUrlPost = 'delivery=' + id + '&showImages=' + showImages + '&siteId=' + siteId;

			var storeForm = new BX.CDialog({
				'title': '<?=GetMessage('SOA_ORDER_GIVE')?>',
				head: '',
				'content_url': strUrl,
				'content_post': strUrlPost,
				'width': formWidth,
				'height': 450,
				'resizable': false,
				'draggable': false
			});

			var button = [
				{
					title: '<?=GetMessage('SOA_POPUP_SAVE')?>',
					id: 'crmOk',
					'action': function () {
						GetBuyerStore();
						BX.WindowManager.Get().Close();
					}
				},
				BX.CDialog.btnCancel
			];
			storeForm.ClearButtons();
			storeForm.SetButtons(button);
			storeForm.Show();
		}

		function GetBuyerStore() {
			BX('BUYER_STORE').value = BX('POPUP_STORE_ID').value;
			//BX('ORDER_DESCRIPTION').value = '<?=GetMessage("SOA_ORDER_GIVE_TITLE")?>: '+BX('POPUP_STORE_NAME').value;
			BX('store_desc').innerHTML = BX('POPUP_STORE_NAME').value;
			BX.show(BX('select_store'));
		}

		function showExtraParamsDialog(deliveryId) {
			var strUrl = '<?=$templateFolder?>' + '/delivery_extra_params.php';
			var formName = 'extra_params_form';
			var strUrlPost = 'deliveryId=' + deliveryId + '&formName=' + formName;

			if (window.BX.SaleDeliveryExtraParams) {
				for (var i in window.BX.SaleDeliveryExtraParams) {
					strUrlPost += '&' + encodeURI(i) + '=' + encodeURI(window.BX.SaleDeliveryExtraParams[i]);
				}
			}

			var paramsDialog = new BX.CDialog({
				'title': '<?=GetMessage('SOA_ORDER_DELIVERY_EXTRA_PARAMS')?>',
				head: '',
				'content_url': strUrl,
				'content_post': strUrlPost,
				'width': 500,
				'height': 200,
				'resizable': true,
				'draggable': false
			});

			var button = [
				{
					title: '<?=GetMessage('SOA_POPUP_SAVE')?>',
					id: 'saleDeliveryExtraParamsOk',
					'action': function () {
						insertParamsToForm(deliveryId, formName);
						BX.WindowManager.Get().Close();
					}
				},
				BX.CDialog.btnCancel
			];

			paramsDialog.ClearButtons();
			paramsDialog.SetButtons(button);
			//paramsDialog.adjustSizeEx();
			paramsDialog.Show();
		}

		function insertParamsToForm(deliveryId, paramsFormName) {
			var orderForm = BX("ORDER_FORM"),
				paramsForm = BX(paramsFormName);
			wrapDivId = deliveryId + "_extra_params";

			var wrapDiv = BX(wrapDivId);
			window.BX.SaleDeliveryExtraParams = {};

			if (wrapDiv)
				wrapDiv.parentNode.removeChild(wrapDiv);

			wrapDiv = BX.create('div', {props: {id: wrapDivId}});

			for (var i = paramsForm.elements.length - 1; i >= 0; i--) {
				var input = BX.create('input', {
						props: {
							type: 'hidden',
							name: 'DELIVERY_EXTRA[' + deliveryId + '][' + paramsForm.elements[i].name + ']',
							value: paramsForm.elements[i].value
						}
					}
				);

				window.BX.SaleDeliveryExtraParams[paramsForm.elements[i].name] = paramsForm.elements[i].value;

				wrapDiv.appendChild(input);
			}

			orderForm.appendChild(wrapDiv);

			BX.onCustomEvent('onSaleDeliveryGetExtraParams', [window.BX.SaleDeliveryExtraParams]);
		}
		function showCur(id) {
			window.alert(id);
		}
	</script>

	<input type="hidden" name="BUYER_STORE" id="BUYER_STORE" value="<?= $arResult["BUYER_STORE"] ?>"/>

<? // echo $result->getPrice();
if (!empty($arResult["DELIVERY"])) {

	// print_r();
 //   pre($arResult);
	?>

	<div class="group group--el ">
		<?

		foreach ($arResult["DELIVERY"] as $delivery_id => $arDelivery) {
			if (intval($delivery_id) != 62) {
				if ($delivery_id !== 0 && intval($delivery_id) <= 0){

					foreach ($arDelivery["PROFILES"] as $profile_id => $arProfile){

						?>

							  <div class="col col-4-tl">
							<div class="radio<? if ($arDelivery["CHECKED"] == "Y") echo " radio--selected"; ?> trig_del_cont"
								 data-qcontent="element__buttons__radio">
								<input class="radio__input" type="radio"
									   id="ID_DELIVERY_<?=$delivery_id?>_<?=$profile_id?>"
									   value="<?=$delivery_id.":".$profile_id;?>"
									   name="<?=htmlspecialcharsbx($arProfile["FIELD_NAME"])?>"<?=$arProfile["CHECKED"] == "Y" ? "checked=\"checked\"" : ""; ?>
									   onclick="submitForm();"/>
								<label class="radio__label"
									   for="ID_DELIVERY_<?=$delivery_id?>_<?=$profile_id?>"><?= htmlspecialcharsbx($arProfile["TITLE"]) ?><br>
									<?
									if (strlen($arDelivery["PERIOD_TEXT"])>0)
									{
										echo $arDelivery["PERIOD_TEXT"];
										?><br /><?
									}
									?>
									<?
									/*if (strlen($arDelivery["DESCRIPTION"])>0)
										echo $arDelivery["DESCRIPTION"]."<br />";*/

									?>
									<?if($arDelivery["PRICE"]):?>
										<span class="deliveryCost"><?=GetMessage("SALE_DELIV_PRICE");?>: <b>

												<?=$arDelivery["PRICE_FORMATED"]?></b></span>
                                        <span><?=$_SESSION['DELIVERY_TIME']?> </span>
									<?else:?>
										<span class="deliveryCost deliveryCost--free">Cтоимость: Бесплатно</span>
									<?endif?>
								</label>
							</div>
						</div>


						<?
					}
				}else{
					?>
					<?php ; if($arDelivery["ID"] != $exceptionPoint):?>
					<div class="col col-4-tl">
                        <?
                        ;?>
						<div class="radio <? if ($arDelivery["CHECKED"]=='Y') echo 'radio--selected'; ?>

						 trig_del_cont"
							 data-qcontent="element__buttons__radio">
						<? if($arDelivery["ID"] == 67):?>
                            <div id="partnerPVZ" >
                                <? $Logistic->setPartnerPvzHtml(true);?>
                            </div>
						<?endif?>
							<input class="radio__input" type="radio"

								   id="ID_DELIVERY_ID_<?= $arDelivery["ID"] ?>"
								   value="<?= $arDelivery["ID"] ?>"
								   name="<?= htmlspecialcharsbx($arDelivery["FIELD_NAME"]) ?>"

									<? if ( $arDelivery["CHECKED"]=='Y' ) echo " checked=checked"; ?>


								   onclick="submitForm();"/>
							<label class="radio__label"
								   for="ID_DELIVERY_ID_<?= $arDelivery["ID"] ?>"><?= htmlspecialcharsbx($arDelivery["OWN_NAME"]) ?><br>
								<?
								if (strlen($arDelivery["PERIOD_TEXT"])>0)
								{
									echo $arDelivery["PERIOD_TEXT"];
									?><br /><?
								}
								?>
								<?
								/*if (strlen($arDelivery["DESCRIPTION"])>0)
									echo $arDelivery["DESCRIPTION"]."<br />";*/
								?>
								<?if($arDelivery["PRICE"]):?>
									<span class="deliveryCost"><?=GetMessage("SALE_DELIV_PRICE");?>:
										<?php if($arDelivery["ID"] == 67):?>

										<?endif?>
                                        <?php if($arDelivery["ID"] == 59 && $arDelivery["CHECKED"]){
                                           $hintButton = '';
                                        }else $hintButton ="<p class='deliveryMapHint'> Выберите подходящий пункт Выдачи на карте</p>";?>
										<b><?=$arDelivery["PRICE_FORMATED"]?></b></span>
								<?else:?>
									<span class="deliveryCost deliveryCost--free">Cтоимость: Бесплатно</span>
								<?endif?>
								<?if($arDelivery["ID"] == 67 && $partnersPVZArr  ):?>

                                    <span><?=$_SESSION['DELIVERY_TIME_PVZ']?> </span>
								<?else:?>
									<span><?=$_SESSION['DELIVERY_TIME']?> </span>
								<?endif?>
							</label>
						</div>
					</div>
					<?endif;?>
					<?
				}
			}
		}
		?>
	</div>
    <?=$hintButton?>
    <div id="pvzWidjet" style="width:100%; height:600px; display: block"></div>
	<div class="order__points">
		<?
		foreach ($arResult["DELIVERY"] as $delivery_id => $arDelivery) {
			if (intval($delivery_id) != 62) {
				?>
				<div class="group<? if ($arDelivery["CHECKED"] == "Y") echo " group--el"; ?>">
					<?

					if ($delivery_id == 59):?>

						<div class="col col-8-tl">
							<div id='curier'><label class="deliveryLabel"> Адрес для доставки курьером:<br><textarea cols='200' rows="12" class="deliveryTextarea"
											name="<?= $arDelivery["CHECKED"] == 'Y' ? 'ORDER_PROP_7' : '' ?>"
										<?= $arDelivery["CHECKED"] == 'Y' ? '' : 'readonly' ?>
											cols="60"></textarea></label>
                                <button type="button" id="deliveryNext" class="toOrder active icon-to-right"
                                        style=""
                                        data-qcontent="element__buttons__toOrder">Далее
                                </button>
							</div>

						</div>
					<? endif; ?>

				</div>
				<?
			}
		} ?>
	</div>
	<?
}
?>