<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(count($arResult["PERSON_TYPE"]) > 1)
{
    ?>
    <div class="section group group--el">
        <?foreach($arResult["PERSON_TYPE"] as $v):?>
            <div class="col col-6-tl">
                <div class="radio<?if ($v["CHECKED"]=="Y") echo " radio--selected";?>" data-qcontent="element__buttons__radio">
                    <input class="radio__input" value="<?=$v["ID"]?>" type="radio" id="PERSON_TYPE_<?=$v["ID"]?>" name="PERSON_TYPE"<?if ($v["CHECKED"]=="Y") echo " checked=\"checked\"";?> onClick="submitForm()"/>
                    <label class="radio__label" for="PERSON_TYPE_<?=$v["ID"]?>"><?=$v["NAME"]?></label>
                </div>
            </div>
        <?endforeach;?>
        <input type="hidden" name="PERSON_TYPE_OLD" value="<?=$arResult["USER_VALS"]["PERSON_TYPE_ID"]?>" />
    </div>
    <?
}
else
{
    if(IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"]) > 0)
    {
        //for IE 8, problems with input hidden after ajax
        ?>
        <span style="display:none;">
		<input type="text" name="PERSON_TYPE" value="<?=IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"])?>" />
		<input type="text" name="PERSON_TYPE_OLD" value="<?=IntVal($arResult["USER_VALS"]["PERSON_TYPE_ID"])?>" />
		</span>
        <?
    }
    else
    {
        foreach($arResult["PERSON_TYPE"] as $v)
        {
            ?>
            <input type="hidden" id="PERSON_TYPE" name="PERSON_TYPE" value="<?=$v["ID"]?>" />
            <input type="hidden" name="PERSON_TYPE_OLD" value="<?=$v["ID"]?>" />
            <?
        }
    }
}
?>
