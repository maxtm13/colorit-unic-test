<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>



<?php

global $APPLICATION;

$aMenuLinksExt = $APPLICATION->IncludeComponent(
    "maxtm1:menu.sections",
    "",
    [
        "IS_SEF"           => "Y",
        "SEF_BASE_URL"     => "/catalog/",
        "SECTION_PAGE_URL" => "#SECTION_CODE_PATH#/",
        "DETAIL_PAGE_URL"  => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
        "IBLOCK_TYPE"      => "catalog",
        "IBLOCK_ID"        => "1",
        "DEPTH_LEVEL"      => "3",
        "CACHE_TYPE"       => "N",
        "CACHE_TIME"       => "3600",
    ],
    false
);

//====================

$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
//pre($aMenuLinks);
?>