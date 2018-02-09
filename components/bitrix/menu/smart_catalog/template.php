<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);


if (empty($arResult))
	return;
?>


<nav class="catalogList__categoryNavigation" role="catalog">
    <ul class="catalogList__categoryList" id="js_categories">
        <? $i = 1?>
        <?foreach($arResult["ALL_ITEMS_ID"] as $itemIdLevel_1=>$arItemsLevel_2):?> <!-- first level-->
            <li class="catalogList__categoryItem" id="js_showSub__<?=$i?>">
                <span><a href="<?=$arResult["ALL_ITEMS"][$itemIdLevel_1]["LINK"]?>"><?=$arResult["ALL_ITEMS"][$itemIdLevel_1]["TEXT"]?></a></span>
                <svg class="icon icon--catalog" data-qcontent="element__ICONS__MAIN-SVG-use">
                    <use xlink:href="#to-right">              </use>
                </svg>
            </li>
            <ul class="catalogList__categorySublist">
                <?if (is_array($arItemsLevel_2) && !empty($arItemsLevel_2)):?>

                    <li class="catalogList__SublistItem" id="js_sub__<?=$i; $i++;?>">
                        <ul class="sub__list">
                            <div class="group group-md">
                                <?foreach($arItemsLevel_2 as $itemIdLevel_2=>$arItemsLevel_3):?>
                                    <div class="col col-4-tl">
                                        <li class="sub__item">
                                            <a class="catalogLink " data-qcontent="element__LINKS__catalogLink" href="<?=$arResult["ALL_ITEMS"][$itemIdLevel_2]["LINK"]?>">
                                                <?=$arResult["ALL_ITEMS"][$itemIdLevel_2]["TEXT"]?>
                                            </a>


                                            <?if ($itemIdLevel_1!=332150900&&$arParams["MAX_LEVEL"]>=3&&is_array($arItemsLevel_3) && !empty($arItemsLevel_3)):?>

                                                <ul class="sub__subList">
                                                    <?foreach($arItemsLevel_3 as $itemIdLevel_3):?> <!-- third level-->
                                                    <li><a href="<?=$arResult["ALL_ITEMS"][$itemIdLevel_3]["LINK"]?>" class="catalogLink sub" data-qcontent="element__LINKS__catalogLink"><?=$arResult["ALL_ITEMS"][$itemIdLevel_3]["TEXT"]?></a>
                                                    </li>
                                                    <?endforeach?>
                                                </ul>

                                            <?endif?>
                                        </li>
                                    </div>
                                <?endforeach?>
                            </div>
                        </ul>
                    </li>
                <?endif?>

            </ul>
        <?endforeach?>

    </ul>

</nav>
<!--MOBILE MENU-->
<div class="mobileMenu">
    <div class="mobileMenu__content" data-qcontent="module__mobileMenu">
        <div class="mobileMenu__wrapper mobileMenu__category l_ib__c  undefined" id="js_categories">
            <nav class="mobileMenu___categoryNavigation l_ib__e" role="catalog" id="mobileMenu">
                <ul>
                    <?foreach($arResult["ALL_ITEMS_ID"] as $itemIdLevel_1=>$arItemsLevel_2):?>
                        <li><span><?=$arResult["ALL_ITEMS"][$itemIdLevel_1]["TEXT"]?></span>
                            <?if (is_array($arItemsLevel_2) && !empty($arItemsLevel_2)):?>
                                <ul>
                                    <?foreach($arItemsLevel_2 as $itemIdLevel_2=>$arItemsLevel_3):?>
                                        <li><a href="<?=$arResult["ALL_ITEMS"][$itemIdLevel_2]["LINK"]?>"><?=$arResult["ALL_ITEMS"][$itemIdLevel_2]["TEXT"]?></a>
                                            <?if ($itemIdLevel_1!=332150900&&$arParams["MAX_LEVEL"]>=3&&is_array($arItemsLevel_3) && !empty($arItemsLevel_3)):?>
                                                <ul>
                                                    <?foreach($arItemsLevel_3 as $itemIdLevel_3):?>
                                                        <li><a href="<?=$arResult["ALL_ITEMS"][$itemIdLevel_3]["LINK"]?>" ><?=$arResult["ALL_ITEMS"][$itemIdLevel_3]["TEXT"]?></a></li>
                                                    <?endforeach?>
                                                </ul>
                                            <?endif?>
                                        </li>
                                    <?endforeach?>
                                </ul>
                            <?endif?>
                        </li>
                    <?endforeach?>
                </ul>
            </nav>
        </div>
    </div>
</div>

