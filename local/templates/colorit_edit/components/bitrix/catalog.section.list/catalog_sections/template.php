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
//todo pre
//echo '<pre>';
//print_r($arParams);
//echo '</pre>';

?>
    <h1 class="title"><? $APPLICATION->ShowTitle()?></h1> <?php
$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
?>


    <ul class="list__categories">
<? foreach ($arResult['SECTIONS'] as $key => &$arSection) :

    ?>
    <? //
    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
    ?>
    <li class="category__item item-<?=$key?>">
        <div class="category__inner" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
            <a href="<?= $arSection['SECTION_PAGE_URL'] ?>" class="category__item_link">
                <div class="category__item_title "><?= $arSection['NAME'] ?></div>
                <img src="<?= $arSection['PICTURE']['SRC'] ?>" alt="name" class="category__item_pict">
            </a>
        </div>
    </li>




<? endforeach ?>
    </ul>
<?php
