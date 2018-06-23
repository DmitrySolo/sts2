<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
?>



<button class="filter__mobileSwitcher icon-down" id="mobFilSwitcher">
    <svg class="icon icon--filterSwitcher" data-qcontent="element__ICONS__MAIN-SVG-use">
        <use xlink:href="#funnel">              </use>
    </svg><span>Подобрать по фильтру</span>
</button>
<div class="accordion__content" id="filter" data-qcontent="module__accordion">
    <form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
        <?foreach($arResult["HIDDEN"] as $arItem):?>
            <input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
        <?endforeach;?>
        <?
        foreach($arResult["ITEMS"] as $key=>$arItem)//prices
        {
            $key = $arItem["ENCODED_ID"];
            if(isset($arItem["PRICE"])):
                if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
                    continue;
                ?>
                <button type="button" class="accordion icon-down active"><?=$arItem["NAME"]?><span class="accordion__checkMarker"></span></button>
                <div class="accordion__panel bx-filter-parameters-box">
                    <div class="accordion__slider">
                        <input type="text" class="js-range-slider" id="drag_track_<?=$key?>"
                               value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>;<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                               data-qcontent="element__buttons__slider"/>
                    </div>
                    <div class="accordion__extra-controls">
                        <input
                                class="min-price"
                                type="text"
                                name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                                id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
                                value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
                                size="5"
                                onkeyup="smartFilter.keyup(this)"
                        />
                        <input
                                class="max-price"
                                type="text"
                                name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                                id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
                                value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                                size="5"
                                onkeyup="smartFilter.keyup(this)"
                        />
                    </div>
                    <script>
                        $(window).ready(function () {
                            var $range = $("#drag_track_<?=$key?>"),
                                $inputFrom = $("#<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"),
                                $inputTo = $("#<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"),
                                instance,
                                from = <?echo isset($arItem["VALUES"]["MIN"]["HTML_VALUE"])?$arItem["VALUES"]["MIN"]["HTML_VALUE"]:$arItem["VALUES"]["MIN"]["VALUE"]?>,
                                to = <?echo isset($arItem["VALUES"]["MAX"]["HTML_VALUE"])?$arItem["VALUES"]["MAX"]["HTML_VALUE"]:$arItem["VALUES"]["MAX"]["VALUE"]?>,
                                min = <?echo $arItem["VALUES"]["MIN"]["VALUE"]?>,
                                max = <?echo $arItem["VALUES"]["MAX"]["VALUE"]?>;

                            $range.ionRangeSlider({
                                type: "double",
                                grid: true,
                                min: min,
                                max: max,
                                from: from,
                                to: to,
                                onStart: startInputs,
                                onChange: updateInputs
                            });
                            instance = $range.data("ionRangeSlider");

                            function startInputs(data) {
                                from = data.from;
                                to = data.to;
                            }

                            function updateInputs(data) {
                                startInputs(data);

                                $inputFrom.prop("value", from);
                                $inputTo.prop("value", to);

                                smartFilter.keyup($inputTo.get(0));
                            }

                            $inputFrom.on("input", function () {
                                var val = $(this).prop("value");

                                // validate
                                if (val < min) {
                                    val = min;
                                } else if (val > to) {
                                    val = to;
                                }

                                instance.update({
                                    from: val
                                });
                            });

                            $inputTo.on("input", function () {
                                var val = $(this).prop("value");

                                // validate
                                if (val < from) {
                                    val = from;
                                } else if (val > max) {
                                    val = max;
                                }

                                instance.update({
                                    to: val
                                });
                            });
                        });
                    </script>
                    <?
                    $arJsParams = array(
                        "trackerWrap" => "drag_track_".$key,
                        "minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
                        "maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
                        "minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
                        "maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
                        "curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                        "curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                        "fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"],
                        "fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
                    );
                    ?>
                    <script type="text/javascript">
                        BX.ready(function(){
                            window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
                        });
                    </script>
                    <div class="productFilterRes__ctn bx-filter-container-modef"></div>
                </div>
            <?endif;
        }
        ?>

        <?
        //not prices
        foreach($arResult["ITEMS"] as $key=>$arItem)
        {
        if(
            empty($arItem["VALUES"])
            || isset($arItem["PRICE"])
        )
            continue;

        if (
            $arItem["DISPLAY_TYPE"] == "A"
            && (
                $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
            )
        )
            continue;
        ?>

        <button type="button" class="accordion icon-down <?if ($arItem["DISPLAY_EXPANDED"]== "Y"):?>active<?endif?>"><?=$arItem["NAME"]?><span class="accordion__checkMarker"></span></button>
        <div class="accordion__panel bx-filter-parameters-box">
            <?
            $arCur = current($arItem["VALUES"]);
            switch ($arItem["DISPLAY_TYPE"])
            {
            case "A"://NUMBERS_WITH_SLIDER
            ?>
            <div class="accordion__slider">
                <input type="text" class="js-range-slider" id="drag_track_<?=$key?>"
                       value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>;<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                       data-qcontent="element__buttons__slider"/>
            </div>
            <div class="accordion__extra-controls">
                <input
                        class="min-price"
                        type="text"
                        name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                        id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
                        value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
                        size="5"
                        onkeyup="smartFilter.keyup(this)"
                />
                <input
                        class="max-price"
                        type="text"
                        name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                        id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
                        value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                        size="5"
                        onkeyup="smartFilter.keyup(this)"
                />
            </div>
            <script>
                $(window).ready(function () {
                    var $range = $("#drag_track_<?=$key?>"),
                        $inputFrom = $("#<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"),
                        $inputTo = $("#<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"),
                        instance,
                        from = <?echo isset($arItem["VALUES"]["MIN"]["HTML_VALUE"])?$arItem["VALUES"]["MIN"]["HTML_VALUE"]:$arItem["VALUES"]["MIN"]["VALUE"]?>,
                        to = <?echo isset($arItem["VALUES"]["MAX"]["HTML_VALUE"])?$arItem["VALUES"]["MAX"]["HTML_VALUE"]:$arItem["VALUES"]["MAX"]["VALUE"]?>,
                        min = <?echo $arItem["VALUES"]["MIN"]["VALUE"]?>,
                        max = <?echo $arItem["VALUES"]["MAX"]["VALUE"]?>;

                    $range.ionRangeSlider({
                        type: "double",
                        grid: true,
                        min: min,
                        max: max,
                        from: from,
                        to: to,
                        onStart: startInputs,
                        onChange: updateInputs
                    });
                    instance = $range.data("ionRangeSlider");

                    function startInputs(data) {
                        from = data.from;
                        to = data.to;
                    }

                    function updateInputs(data) {
                        startInputs(data);

                        $inputFrom.prop("value", from);
                        $inputTo.prop("value", to);

                        smartFilter.keyup($inputTo.get(0));
                    }

                    $inputFrom.on("input", function () {
                        var val = $(this).prop("value");

                        // validate
                        if (val < min) {
                            val = min;
                        } else if (val > to) {
                            val = to;
                        }

                        instance.update({
                            from: val
                        });
                    });

                    $inputTo.on("input", function () {
                        var val = $(this).prop("value");

                        // validate
                        if (val < from) {
                            val = from;
                        } else if (val > max) {
                            val = max;
                        }

                        instance.update({
                            to: val
                        });
                    });
                });
            </script>
        <?
        $arJsParams = array(
            "trackerWrap" => "drag_track_".$key,
            "minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
            "maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
            "minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
            "maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
            "curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
            "curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
            "fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"],
            "fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
        );
        ?>
            <script type="text/javascript">
                BX.ready(function(){
                    window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
                });
            </script>
        <?
        break;
        case "B"://NUMBERS
        ?>
            <div class="col-xs-6 bx-filter-parameters-box-container-block bx-left">
                <i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_FROM")?></i>
                <div class="bx-filter-input-container">
                    <input
                            class="min-price"
                            type="text"
                            name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
                            id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
                            value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
                            size="5"
                            onkeyup="smartFilter.keyup(this)"
                    />
                </div>
            </div>
            <div class="col-xs-6 bx-filter-parameters-box-container-block bx-right">
                <i class="bx-ft-sub"><?=GetMessage("CT_BCSF_FILTER_TO")?></i>
                <div class="bx-filter-input-container">
                    <input
                            class="max-price"
                            type="text"
                            name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
                            id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
                            value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
                            size="5"
                            onkeyup="smartFilter.keyup(this)"
                    />
                </div>
            </div>
        <?
        break;
        case "G"://CHECKBOXES_WITH_PICTURES
        ?>
            <div class="col-xs-12">
                <div class="bx-filter-param-btn-inline">
                    <?foreach ($arItem["VALUES"] as $val => $ar):?>
                        <input
                                style="display: none"
                                type="checkbox"
                                name="<?=$ar["CONTROL_NAME"]?>"
                                id="<?=$ar["CONTROL_ID"]?>"
                                value="<?=$ar["HTML_VALUE"]?>"
                            <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                        />
                        <?
                        $class = "";
                        if ($ar["CHECKED"])
                            $class.= " bx-active";
                        if ($ar["DISABLED"])
                            $class.= " disabled";
                        ?>
                        <label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label <?=$class?>" onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'bx-active');">
                                        <span class="bx-filter-param-btn bx-color-sl">
                                            <?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                                <span class="bx-filter-btn-color-icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
                                            <?endif?>
                                        </span>
                        </label>
                    <?endforeach?>
                </div>
            </div>
        <?
        break;
        case "H"://CHECKBOXES_WITH_PICTURES_AND_LABELS
        ?>
            <div class="accordion__checkBox">
                <div class="group group-el">
                    <?foreach($arItem["VALUES"] as $val => $ar):?>
                        <div class="checkBox col col-12-tl col-6-tp col-6-m" data-qcontent="element__buttons__checkBox">
                            <input class="checkBox__input productFilter__checkbox" type="checkbox"
                                   value="<? echo $ar["HTML_VALUE"] ?>"
                                   name="<? echo $ar["CONTROL_NAME"] ?>"
                                   id="<? echo $ar["CONTROL_ID"] ?>"
                                <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                   onclick="smartFilter.click(this)"
                            />
                            <label class="checkBox__label"
                                   title="<?=$ar["VALUE"];?>"
                                   for="<? echo $ar["CONTROL_ID"] ?>"
                                   data-role="label_<?=$ar["CONTROL_ID"]?>"><?=$ar["VALUE"];?><?
                                if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                    ?>&nbsp;(<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                endif;?></label>
                        </div>
                    <?endforeach;?>
                </div>
            </div>

        <?
        break;
        case "P"://DROPDOWN
        $checkedItemExist = false;
        ?>

                <div class="accordion__checkBox">
                    <div class="group group-el">
                        <?foreach($arItem["VALUES"] as $val => $ar):?>
                            <div class="checkBox col col-12-tl col-6-tp col-6-m" data-qcontent="element__buttons__checkBox">
                                <input class="checkBox__input productFilter__checkbox" type="checkbox"
                                       value="<? echo $ar["HTML_VALUE"] ?>"
                                       name="<? echo $ar["CONTROL_NAME"] ?>"
                                       id="<? echo $ar["CONTROL_ID"] ?>"
                                    <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                       onclick="smartFilter.click(this)"
                                />
                                <label class="checkBox__label"
                                       title="<?=$ar["VALUE"];?>"
                                       for="<? echo $ar["CONTROL_ID"] ?>"
                                       data-role="label_<?=$ar["CONTROL_ID"]?>"><?=$ar["VALUE"];?><?
                                    if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                        ?>&nbsp;(<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                    endif;?></label>
                            </div>
                        <?endforeach;?>
                    </div>
                </div>
        <?
        break;
        case "R"://DROPDOWN_WITH_PICTURES_AND_LABELS
        ?>
            <div class="col-xs-12">
                <div class="bx-filter-select-container">
                    <div class="bx-filter-select-block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
                        <div class="bx-filter-select-text fix" data-role="currentOption">
                            <?
                            $checkedItemExist = false;
                            foreach ($arItem["VALUES"] as $val => $ar):
                                if ($ar["CHECKED"])
                                {
                                    ?>
                                    <?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                    <span class="bx-filter-btn-color-icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
                                <?endif?>
                                    <span class="bx-filter-param-text">
                                                        <?=$ar["VALUE"]?>
                                                    </span>
                                    <?
                                    $checkedItemExist = true;
                                }
                            endforeach;
                            if (!$checkedItemExist)
                            {
                                ?><span class="bx-filter-btn-color-icon all"></span> <?
                                echo GetMessage("CT_BCSF_FILTER_ALL");
                            }
                            ?>
                        </div>
                        <div class="bx-filter-select-arrow"></div>
                        <input
                                style="display: none"
                                type="radio"
                                name="<?=$arCur["CONTROL_NAME_ALT"]?>"
                                id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
                                value=""
                        />
                        <?foreach ($arItem["VALUES"] as $val => $ar):?>
                            <input
                                    style="display: none"
                                    type="radio"
                                    name="<?=$ar["CONTROL_NAME_ALT"]?>"
                                    id="<?=$ar["CONTROL_ID"]?>"
                                    value="<?=$ar["HTML_VALUE_ALT"]?>"
                                <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                            />
                        <?endforeach?>
                        <div class="bx-filter-select-popup" data-role="dropdownContent" style="display: none">
                            <ul>
                                <li style="border-bottom: 1px solid #e5e5e5;padding-bottom: 5px;margin-bottom: 5px;">
                                    <label for="<?="all_".$arCur["CONTROL_ID"]?>" class="bx-filter-param-label" data-role="label_<?="all_".$arCur["CONTROL_ID"]?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
                                        <span class="bx-filter-btn-color-icon all"></span>
                                        <? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
                                    </label>
                                </li>
                                <?
                                foreach ($arItem["VALUES"] as $val => $ar):
                                    $class = "";
                                    if ($ar["CHECKED"])
                                        $class.= " selected";
                                    if ($ar["DISABLED"])
                                        $class.= " disabled";
                                    ?>
                                    <li>
                                        <label for="<?=$ar["CONTROL_ID"]?>" data-role="label_<?=$ar["CONTROL_ID"]?>" class="bx-filter-param-label<?=$class?>" onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')">
                                            <?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                                <span class="bx-filter-btn-color-icon" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
                                            <?endif?>
                                            <span class="bx-filter-param-text">
                                                            <?=$ar["VALUE"]?>
                                                        </span>
                                        </label>
                                    </li>
                                <?endforeach?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?
        break;
        case "K"://RADIO_BUTTONS
        ?>
            <div class="accordion__checkBox">
                <div class="group group-el">
                    <div class="checkBox col col-12-tl col-6-tp col-6-m" data-qcontent="element__buttons__checkBox">
                        <input class="checkBox__input productFilter__checkbox" type="radio"
                               value=""
                               name="<? echo $arCur["CONTROL_NAME_ALT"] ?>"
                               id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
                               onclick="smartFilter.click(this)"
                        />
                        <label class="checkBox__label"
                               for="<? echo "all_".$arCur["CONTROL_ID"] ?>"><? echo GetMessage("CT_BCSF_FILTER_ALL"); ?></label>
                        <?foreach($arItem["VALUES"] as $val => $ar):?>
                            <div class="checkBox col col-12-tl col-6-tp col-6-m" data-qcontent="element__buttons__checkBox">
                                <input class="checkBox__input productFilter__checkbox"
                                       type="radio"
                                       value="<? echo $ar["HTML_VALUE_ALT"] ?>"
                                       name="<? echo $ar["CONTROL_NAME_ALT"] ?>"
                                       id="<? echo $ar["CONTROL_ID"] ?>"
                                    <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                       onclick="smartFilter.click(this)"
                                />
                                <label class="checkBox__label"
                                       title="<?=$ar["VALUE"];?>"
                                       for="<? echo $ar["CONTROL_ID"] ?>"
                                       data-role="label_<?=$ar["CONTROL_ID"]?>"><?=$ar["VALUE"];?><?
                                    if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                        ?>&nbsp;(<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                    endif;?></label>
                            </div>
                        <?endforeach;?>
                    </div>
                </div>
                <?
                break;
                case "U"://CALENDAR
                    ?>
                    <div class="col-xs-12">
                        <div class="bx-filter-parameters-box-container-block"><div class="bx-filter-input-container bx-filter-calendar-container">
                                <?$APPLICATION->IncludeComponent(
                                    'bitrix:main.calendar',
                                    '',
                                    array(
                                        'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
                                        'SHOW_INPUT' => 'Y',
                                        'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MIN"]["VALUE"]).'" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
                                        'INPUT_NAME' => $arItem["VALUES"]["MIN"]["CONTROL_NAME"],
                                        'INPUT_VALUE' => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                                        'SHOW_TIME' => 'N',
                                        'HIDE_TIMEBAR' => 'Y',
                                    ),
                                    null,
                                    array('HIDE_ICONS' => 'Y')
                                );?>
                            </div></div>
                        <div class="bx-filter-parameters-box-container-block"><div class="bx-filter-input-container bx-filter-calendar-container">
                                <?$APPLICATION->IncludeComponent(
                                    'bitrix:main.calendar',
                                    '',
                                    array(
                                        'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
                                        'SHOW_INPUT' => 'Y',
                                        'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MAX"]["VALUE"]).'" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
                                        'INPUT_NAME' => $arItem["VALUES"]["MAX"]["CONTROL_NAME"],
                                        'INPUT_VALUE' => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                                        'SHOW_TIME' => 'N',
                                        'HIDE_TIMEBAR' => 'Y',
                                    ),
                                    null,
                                    array('HIDE_ICONS' => 'Y')
                                );?>
                            </div></div>
                    </div>
                    <?
                    break;
                default://CHECKBOXES
                    ?>
                    <div class="accordion__checkBox">
                        <div class="group group-el">
                            <?foreach($arItem["VALUES"] as $val => $ar):?>
                                <div class="checkBox col col-12-tl col-6-tp col-6-m" data-qcontent="element__buttons__checkBox">
                                    <input class="checkBox__input productFilter__checkbox" type="checkbox"
                                           value="<? echo $ar["HTML_VALUE"] ?>"
                                           name="<? echo $ar["CONTROL_NAME"] ?>"
                                           id="<? echo $ar["CONTROL_ID"] ?>"
                                        <? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                           onclick="smartFilter.click(this)"
                                    />
                                    <label class="checkBox__label"
                                           title="<?=$ar["VALUE"];?>"
                                           for="<? echo $ar["CONTROL_ID"] ?>"
                                           data-role="label_<?=$ar["CONTROL_ID"]?>"><?=$ar["VALUE"];?><?
                                        if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                            ?>&nbsp;(<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                        endif;?></label>
                                </div>
                            <?endforeach;?>
                        </div>
                    </div>
                    <?
                }
                ?>
                <div class="productFilterRes__ctn bx-filter-container-modef"></div>
            </div>
            <?
            }
            ?>
            <footer class="filter__buttons_ctn">
                <button class="button"
                        type="submit"
                        id="set_filter"
                        name="set_filter"
                        data-qcontent="element__buttons__button">Смотреть</button>
                <button class="button button--default"
                        type="submit"
                        id="del_filter"
                        name="del_filter"
                        data-qcontent="element__buttons__button">Сбросить</button>
                <a href="<?echo $arResult["FILTER_URL"]?>" class="productFilterRes__link icon-eye"
                   id="modef" style="display:none">Смотреть (<span id="modef_num"><?=intval($arResult["ELEMENT_COUNT"])?></span>)</a>
            </footer>
        </div>
        <script type="text/javascript">
            var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
        </script>