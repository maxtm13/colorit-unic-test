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
    <h1><?= $arResult["NAME"] ?></h1>



    <div class="news-detail">
    <div class="first-section row">
        <div class="col-md-5">
            <? if ($arParams["DISPLAY_PICTURE"] != "N" && is_array($arResult["DETAIL_PICTURE"])): ?>
                <img
                    class="detail_picture"
                    border="0"
                    src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>"
                    width="100%"
                    alt="<?= $arResult["DETAIL_PICTURE"]["ALT"] ?>"
                    title="<?= $arResult["DETAIL_PICTURE"]["TITLE"] ?>"
                />
            <? endif ?>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <? if (!empty($arResult["PREVIEW_TEXT"])) { ?>
                <div class="news-detail-preview-text"><?= $arResult["PREVIEW_TEXT"]; ?></div>
            <? } ?>
        </div>

    </div>
    <div class="second-section row">
        <div class="col-md-10">
            <div class="news-detail-detail-text">
                <? if (!empty($arResult["DETAIL_TEXT"])) { ?>
                    <div class="news-detail-preview-text"><?= $arResult["DETAIL_TEXT"]; ?></div>
                <? } ?>
            </div>
        </div>
    </div>

    <?
    if (!str_contains($APPLICATION->GetCurDir(), 'technical')) {
    ?>
    <div class="third-section d-flex justify-content-between">

        <div class="arrows arrow-next">
            <? if (!empty($arResult["TORIGHT"])) { ?>
                <a href="<?= $arResult["TORIGHT"]['URL'] ?>"
                   class="prev-link"
                   title="<?= $arResult["TORIGHT"]['NAME'] ?>">
                    <span class="arrow next"></span>
                    <span class="arrow-name">Следущая новость</span>

                </a>
            <? } ?>
        </div>


        <div class="arrows arrow-prev">
            <? if (!empty($arResult["TOLEFT"])) { ?>
                <a href="<?= $arResult["TOLEFT"]['URL'] ?>"
                   class="prev-link"
                   title="<?= $arResult["TOLEFT"]['NAME'] ?>">

                    <span class="arrow-name">Предыдущая новость</span>
                    <span class="arrow prev"></span>
                </a>
            <? } ?>

        </div>


    </div>
    <? } ?>
