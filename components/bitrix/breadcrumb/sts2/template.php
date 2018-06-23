<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//delayed function must return a string
if(empty($arResult))
	return "";?>


<? $strReturn = '<div class="pageBreadcrumbs__content" data-qcontent="module__pageBreadcrumbs"><nav class="pageBreadcrumbs"> <ul class="pageBreadcrumbs__list">';

$num_items = count($arResult);
for($index = 0, $itemSize = $num_items; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	
	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
		$strReturn .= '<li class="pageBreadcrumbs__item icon-to-right"><a class= "actionLink" href="'.$arResult[$index]["LINK"].'" title="'.$title.'">'.$title.'</a></li>';
	else
		$strReturn .= '<li class="pageBreadcrumbs__item icon-to-right"><span>'.$title.'</span></li>';
}

$strReturn .= '</ul></nav></div>';

return $strReturn;
?>

