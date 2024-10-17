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

\Bitrix\Main\UI\Extension::load('ui.fonts.opensans');

$themeClass = isset($arParams['TEMPLATE_THEME']) ? ' bx-'.$arParams['TEMPLATE_THEME'] : '';
?>
<div class="">
    <div class="row news-list">
        <? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
            <?= $arResult["NAV_STRING"] ?><br/>
        <? endif; ?>
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="col-sm-6  col-lg-3 mb-4">
                <div class="news-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
<!--                    --><?// if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
<!--                        --><?// if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])): ?>
                            <div class="news-item-pict">
                                <a class="news-item-link" href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                                    <img
                                        class="preview_picture"
                                        border="0"
                                        src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"

                                        alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                        title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                                        style="float:left"
                                    /></a>
                            </div>

                    <? if ($arParams["DISPLAY_DATE"] != "N" && $arItem["DISPLAY_ACTIVE_FROM"]): ?>
                        <span class="news-date-time"><? echo $arItem["DISPLAY_ACTIVE_FROM"] ?></span>
                    <? endif ?>
                    <? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>
                            <a class="news-item-link" href="<? echo $arItem["DETAIL_PAGE_URL"] ?>"><h4 class="news-item-title"><? echo $arItem["NAME"] ?></h4></a>

                    <? endif; ?>
                    <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
                        <p class="news-item-text"><? echo mb_strlen($arItem["PREVIEW_TEXT"])>120 ? mb_substr($arItem["PREVIEW_TEXT"], 0 , 120).'...' : $arItem["PREVIEW_TEXT"] ; ?> </p>
                    <? endif; ?>
                    <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arItem["PREVIEW_PICTURE"])): ?>
                        <!--			<div style="clear:both"></div>-->
                    <? endif ?>
                    <? foreach ($arItem["FIELDS"] as $code => $value): ?>
                        <small>
                            <?= GetMessage("IBLOCK_FIELD_" . $code) ?>:&nbsp;<?= $value; ?>
                        </small><br/>
                    <? endforeach; ?>
                    <? foreach ($arItem["DISPLAY_PROPERTIES"] as $pid => $arProperty): ?>
                        <small>
                            <?= $arProperty["NAME"] ?>:&nbsp;
                            <? if (is_array($arProperty["DISPLAY_VALUE"])): ?>
                                <?= implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]); ?>
                            <? else: ?>
                                <?= $arProperty["DISPLAY_VALUE"]; ?>
                            <? endif ?>
                        </small>
                        <!--			<br />-->
                    <? endforeach; ?>
                </div>
            </div>
        <? endforeach; ?>
        <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
            <br/><?= $arResult["NAV_STRING"] ?>
        <? endif; ?>
    </div>
</div>
