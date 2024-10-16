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
    <div class="news-list">
        <? if ($arParams["DISPLAY_TOP_PAGER"]): ?>
            <?= $arResult["NAV_STRING"] ?><br/>
        <? endif; ?>
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <?

            ?>
            <div class="news-item" data-id="<?= $arItem['ID'] ?>" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                <p class="news-item-title" href="<? echo $arItem["DETAIL_PAGE_URL"] ?>">
                    <b><? echo $arItem["NAME"] ?></b>
                </p>

                <div class="news-item-info">
                    <? foreach ($arItem["DISPLAY_PROPERTIES"] as $pid => $arProperty): ?>
                        <p class="<?= $pid ?>">
                            <? switch ($pid) {
                            case 'PHONES' :
                            if (is_array($arProperty["DISPLAY_VALUE"])) {
                            foreach ($arProperty["DISPLAY_VALUE"] as $phone) {?>
                            <a href="tel:<?= preg_replace("/[^,.0-9]/", '', $phone) ?>"
                               class="phone-link">
                                <?= $phone ?>
                            </a><br>

                            <? }?>
                            <?} else {?>
                                <a href="tel:<?= preg_replace("/[^,.0-9]/", '', $arProperty["DISPLAY_VALUE"]) ?>"
                                   class="phone-link">
                                    <?= $arProperty["DISPLAY_VALUE"] ?>
                                </a>
                                <?}?>
                            <?
                                    break;
                                case 'EMAIL' : ?>
                            <a href="mailto:<?= $arProperty["DISPLAY_VALUE"] ?>"
                               class="mail-link">
                                <?= $arProperty["DISPLAY_VALUE"] ?>
                            </a>
                            <? break;
                                case 'SITE' :?>
                            <a href="http://<?= $arProperty["DISPLAY_VALUE"] ?>"
                               class="site-link">
                                <?= $arProperty["DISPLAY_VALUE"] ?>
                            </a>
                            <? break;
                                default:?>
                            <?=$arProperty["DISPLAY_VALUE"]?>
                            <? }?>

                        </p>
                    <? endforeach; ?>
                </div>
            </div>
        <? endforeach; ?>
        <? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
            <br/><?= $arResult["NAV_STRING"] ?>
        <? endif; ?>

    </div>
<?php
