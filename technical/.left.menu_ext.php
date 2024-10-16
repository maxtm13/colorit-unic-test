<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;
if(CModule::IncludeModule("iblock")) {
    $res = CIBlockElement::GetList(
        false,
        array(
            "IBLOCK_ID"=> 7, // ID нужного инфоблока
            "ACTIVE"=>"Y"
        ),
        false,
        false,
        array( // Нужны только название и ссылка
            "NAME",
            "DETAIL_PAGE_URL",
            "CODE",
             ),
   );
   while($arFields = $res->GetNext()){
       $aMenuLinksExt[] = Array(
           $arFields['NAME'],
           $arFields['DETAIL_PAGE_URL'],
           Array(),
           Array(),
           ""
       );
   }
}
$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks);


?>