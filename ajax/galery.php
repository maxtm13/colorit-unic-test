<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/bitrix/modules/main/include/prolog_before.php');
if(!CModule::IncludeModule("iblock")) die();
//header('Content-Type: application/json');
//print_r($_POST);
//die();
$iblockId = 6; //Код инфоблока Готовых проектов
$id = $_POST['id'];
//$id = 91;

$arFilePath = array();
$res = CIBlockElement::GetProperty($iblockId, $id);
while ($ob = $res->GetNext())
{
    $arFilePath[] = CFile::GetPath($ob['VALUE']);
}


echo json_encode($arFilePath);
?>


