<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
?><?$APPLICATION->IncludeComponent(
	"bitrix:menu.sections",
	"",
	Array(
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"DEPTH_LEVEL" => "2",
		"DETAIL_PAGE_URL" => "#SECTION_ID#/#ELEMENT_ID#",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "catalog",
		"ID" => $_REQUEST["ID"],
		"IS_SEF" => "N",
		"SECTION_PAGE_URL" => "#SECTION_ID#/",
		"SECTION_URL" => "",
		"SEF_BASE_URL" => "/catalog/phone/"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>