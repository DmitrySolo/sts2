<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

	<?if ($arResult['NUM_PRODUCTS']> 0 && $arParams['SHOW_NUM_PRODUCTS'] == 'Y' && $arParams['SHOW_TOTAL_PRICE'] == 'Y'):?>

    <?else:
        $cart_message = (isPartnerClient())? GetMessage('TSB1_EMPTY_CART_PARTNER') : GetMessage('TSB1_EMPTY_CART'); ?>
        <a href="<?=$arParams['PATH_TO_BASKET']?>">
        <button class="cart__content" data-qcontent="module__cart">
            <span class="cart__icon">
                    <svg class="icon icon--topBar" data-qcontent="element__ICONS__MAIN-SVG-use">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#cart-s">    </use>
                    </svg>
            </span>
            <span><?=$cart_message?> </span>
        </button>
        </a>


    <?endif?>
    <? if ($arParams['SHOW_NUM_PRODUCTS'] == 'Y'): ?>
        <? if ($arResult['NUM_PRODUCTS'] > 0): ?>

            <a href="<?= $arParams['PATH_TO_BASKET'] ?>">
                <button class="cart__content" data-qcontent="module__cart">
            <span class="cart__icon">
                  <svg class="icon icon--topBar" data-qcontent="element__ICONS__MAIN-SVG-use">
                    <use xlink:href="#cart-s"></use>
                  </svg></span>
                    <span class="cart__count"><?= $arResult['NUM_PRODUCTS']; ?> </span>


                    <? if ($arParams['SHOW_TOTAL_PRICE'] == 'Y'): ?>


                        <? if ($arResult['NUM_PRODUCTS'] > 0): ?>

                            <? $arResult['TOTAL_PRICE'] = str_replace('уб', '', $arResult['TOTAL_PRICE']) ?>
                            <span class="cart__summ">  <?= $arResult['TOTAL_PRICE'] ?></span>

                        <? endif ?>
                    <? endif ?>
                </button>
            </a>
        <? endif ?>
    <? endif ?>


	<?if($arParams["SHOW_PERSONAL_LINK"] == "Y"):?>

		<span class="icon_profile"></span>
		<a class="link_profile" href="<?=$arParams["PATH_TO_PERSONAL"]?>">ljlj<?=GetMessage("TSB1_PERSONAL")?></a>
	<?endif?>

	<?if ($arParams["SHOW_PRODUCTS"] == "Y" && $arResult['NUM_PRODUCTS'] > 0):?>
		<div class="bx_item_hr" style="margin-bottom:0"></div>
	<?endif?>
