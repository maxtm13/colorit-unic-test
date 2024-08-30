<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
<h2 class="section__title"><?= $arParams["PAGER_TITLE"] ?></h2>
<ul class="advantages-list">
    <?
    //pre($arResult['ITEMS'][0]);
    ?>
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <li class="advantages-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
            <div class="advantages-item-header">
                <img
                        class="preview_picture"
                        border="0"
                        src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                        width="<?= $arItem["PREVIEW_PICTURE"]["WIDTH"] ?>"
                        height="<?= $arItem["PREVIEW_PICTURE"]["HEIGHT"] ?>"
                        alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                        title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"

                />

                <? if ($arParams["DISPLAY_NAME"] != "N" && $arItem["NAME"]): ?>

                    <div class="advantages-item-title"><? echo $arItem["NAME"] ?></div>

                <? endif; ?>
            </div>
            <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
                <div class="advantages-item-text">
                    <? echo $arItem["PREVIEW_TEXT"]; ?>
                </div>
            <? endif; ?>
        </li>
    <? endforeach; ?>

</ul>
