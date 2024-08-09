<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>



<?php

global $APPLICATION;

//$aMenuLinksEx = $APPLICATION->IncludeComponent(
//    "bitrix:catalog.section.list",
//    ".default",
//    array(
//        "ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
//        "ADD_SECTIONS_CHAIN" => "Y",
//        "CACHE_FILTER" => "N",
//        "CACHE_GROUPS" => "Y",
//        "CACHE_TIME" => "36000000",
//        "CACHE_TYPE" => "A",
//        "COUNT_ELEMENTS" => "Y",
//        "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
//        "FILTER_NAME" => "sectionsFilter",
//        "HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
//        "IBLOCK_ID" => "1",
//        "IBLOCK_TYPE" => "catalog",
//        "SECTION_CODE" => "",
//        "SECTION_FIELDS" => array(
//            0 => "",
//            1 => "",
//        ),
//        "SECTION_ID" => $_REQUEST["SECTION_ID"],
//        "SECTION_URL" => "",
//        "SECTION_USER_FIELDS" => array(
//            0 => "",
//            1 => "",
//        ),
//        "SHOW_PARENT_NAME" => "Y",
//        "TOP_DEPTH" => "2",
//        "VIEW_MODE" => "LINE",
//        "COMPONENT_TEMPLATE" => ".default"
//    ),
//    false
//);


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
        "CACHE_TYPE"       => "A",
        "CACHE_TIME"       => "3600",
    ],
    false
);



//====================


//if(CModule::IncludeModule("iblock"))
//{
//
//$IBLOCK_ID = 1;        //здесь необходимо указать ID Вашего инфоблока
//
//$arOrder = Array("SORT"=>"ASC");
//$arSelect = Array("ID", "NAME", "IBLOCK_ID", "DETAIL_PAGE_URL");
//$arFilter = Array("IBLOCK_ID"=>$IBLOCK_ID, "ACTIVE"=>"Y");
//$res = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
//
//    while($ob = $res->GetNextElement())
//    {
//    $arFields = $ob->GetFields();
//    $aMenuLinksExt[] = Array(
//                $arFields['NAME'],
//                $arFields['DETAIL_PAGE_URL'],
//                Array(),
//                Array(),
//                ""
//                );
//
//    }
//
//}

$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
//pre($aMenuLinks);
?>