<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");
?><?$APPLICATION->IncludeComponent(
	"bitrix:search.suggest.input",
	"search",
	Array(
		"DROPDOWN_SIZE" => "10",
		"INPUT_SIZE" => "40",
		"NAME" => "q",
		"VALUE" => ""
	)
);?><?$APPLICATION->IncludeComponent(
	"bitrix:search.form", 
	"visual", 
	array(
		"PAGE" => "#SITE_DIR#search.php",
		"USE_SUGGEST" => "N",
		"COMPONENT_TEMPLATE" => "visual",
		"SHOW_INPUT" => "Y",
		"INPUT_ID" => "title-search-input",
		"CONTAINER_ID" => "title-search",
		"PRICE_CODE" => array(
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SHOW_PREVIEW" => "Y",
		"PREVIEW_WIDTH" => "75",
		"PREVIEW_HEIGHT" => "75"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>