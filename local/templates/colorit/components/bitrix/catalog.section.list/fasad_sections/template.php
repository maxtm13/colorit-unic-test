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

echo '<pre>';
//print_r($arParams["IBLOCK_ID"]);
echo '</pre>';


$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
?>


    <ul class="row anonce__categories_items-top">
<? foreach ($arResult['SECTIONS'] as $key => &$arSection) :

    ?>
    <? if ($key < 3) { ?>
    <? //
    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
    ?>
    <li class="col-4">
        <div class="category__item">
            <a href="<?= $arSection['SECTION_PAGE_URL'] ?>" class="category__item_link">
                <div class="category__item_title "><?= $arSection['NAME'] ?></div>
                <img src="<?= $arSection['PICTURE']['SRC'] ?>" alt="name" class="category__item_pict">
            </a>
        </div>
    </li>
    <? if ($key === 2) : ?> </ul> <?php endif ?>

<?php } ?>

    <?php // Центральна часть
    ?>
    <?php if ($key === 3) { ?>
    <div class="row anonce__item_main-center">
        <div class="col-12 central_icon">
            <? // Вставка включаемой области - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/include_areas/main_include.php
            $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                ".default",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "COMPONENT_TEMPLATE" => ".default",
                    "PATH" => "/includes/logo_big.php"
                ),
                false
            ); ?>
        </div>
    </div>

<?php } ?>
    <?php // Центральна часть закончилась
    ?>
    <?php if (!($key < 3)) { ?>
    <? //
    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
    ?>
    <?php if ($key === 3) : ?> <ul class="row anonce__categories_items-bottom "> <? endif ?>
    <li class="col-4">
        <div class="category__item">

            <a href="<?= $arSection['SECTION_PAGE_URL'] ?>" class="category__item_link">
                <div class="category__item_title "><?= $arSection['NAME'] ?></div>
                <img src="<?= $arSection['PICTURE']['SRC'] ?>" alt="name" class="category__item_pict">
            </a>
        </div>
    </li>
    <?php if ($key === 5) : ?> </ul> <?php endif ?>


<?php } ?>

<? endforeach ?>

<?php echo '<pre>';
//print_r($arResult['SECTIONS']);
echo '</pre>';
    