<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$this->setFrameMode(true);

$cartStyle = 'bx_cart_block';
$cartId = $cartStyle.$component->getNextNumber();
$arParams['cartId'] = $cartId;

if ($arParams['SHOW_PRODUCTS'] == 'Y')
	$cartStyle .= ' bx_cart_sidebar';

if ($arParams['POSITION_FIXED'] == 'Y')
{
	$cartStyle .= " bx_cart_fixed {$arParams['POSITION_HORIZONTAL']} {$arParams['POSITION_VERTICAL']}";
	if ($arParams['SHOW_PRODUCTS'] == 'Y')
		$cartStyle .= ' close';
}
?>

<script>
	var <?=$cartId?> = new BitrixSmallCart;
</script>

<div id="<?=$cartId?>" class="<?=$cartStyle?>">
	<?$frame  =  new  \Bitrix\Main\Page\FrameHelper( $cartStyle );
	$frame->begin()?>
		<?require(realpath(dirname(__FILE__)).'/ajax_template.php');?>
	<?$frame->beginStub()?>
        <button class="cart__content" data-qcontent="module__cart">
            <span class="cart__icon">
                    <svg class="icon icon--topBar" data-qcontent="element__ICONS__MAIN-SVG-use">
                        <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#cart-s">    </use>
                    </svg>
            </span>
            <span>...</span>
        </button>
	<?$frame->end()?>
</div>

<script>
	<?=$cartId?>.siteId       = '<?=SITE_ID?>';
	<?=$cartId?>.cartId       = '<?=$cartId?>';
	<?=$cartId?>.ajaxPath     = '<?=$componentPath?>/ajax.php';
	<?=$cartId?>.templateName = '<?=$templateName?>';
	<?=$cartId?>.arParams     =  <?=CUtil::PhpToJSObject ($arParams)?>;
	<?=$cartId?>.closeMessage = '<?=GetMessage('TSB1_COLLAPSE')?>';
	<?=$cartId?>.openMessage  = '<?=GetMessage('TSB1_EXPAND')?>';
	<?=$cartId?>.activate();
</script>
<!-- split modules/cart -->
    
