<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); // Проверка на подключение ядра
$arResult['TITLE'] = $arParams['TITLE'];
$arResult['SUBTITLE'] = $arParams['SUBTITLE'];
$arResult['BUTTON'] = $arParams['BUTTON'];
$arResult['POLICY'] = $arParams['POLICY'];
$this->includeComponentTemplate();
?>