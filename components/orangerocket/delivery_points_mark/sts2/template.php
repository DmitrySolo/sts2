
<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
	$this->setFrameMode(true);?>

	<?$frame  =  new  \Bitrix\Main\Page\FrameHelper( 'top-panel-del-points-cnt' );
	$frame->begin()?>
		<?require(realpath(dirname(__FILE__)).'/template_ajax.php');?>
	<?$frame->beginStub()?>
		<img style="fill:red;" src='/bitrix/templates/STS2/source/images/compozit.svg'>

	<?$frame->end()?>









