<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $APPLICATION;
$aMenuLinksExt = array();
$aMenuLinksExt = $APPLICATION->IncludeComponent(
	"bitrix:menu.sections", 
	"", 
	array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"DEPTH_LEVEL" => "1",
		"DETAIL_PAGE_URL" => "#SECTION_ID#/#ELEMENT_ID#",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "catalog",
		"ID" => $_REQUEST["ID"],
		"IS_SEF" => "N",
		"SECTION_PAGE_URL" => "#SECTION_ID#/",
		"SECTION_URL" => "",
		"SEF_BASE_URL" => "/catalog/"
	),
	false
);

//====================

$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);
