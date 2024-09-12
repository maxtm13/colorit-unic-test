<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
// todo Убрать функцию....
$arResult['funcGetInputHtml'] = function ($question, $arrVALUES) {
    $id = $question['STRUCTURE'][0]['ID'];
    $type = $question['STRUCTURE'][0]['FIELD_TYPE'];
    $name = "form_{$type}_{$id}";
    $value = isset($arrVALUES[$name]) ? htmlentities($arrVALUES[$name]) : '';
    $required = $question['REQUIRED'] === 'Y' ? 'required' : '';
    $class = ' ' . $question['STRUCTURE'][0]['FIELD_PARAM'];
    $placeholder = $question['CAPTION'];

    switch ($type) {
        case 'checkbox':
            $input = "{$placeholder} <input class=\"form-message {$class}\" type=\"checkbox\" name=\"{$name}\" {$required}>{$value} </input>";
            break;

        // case 'text':
        default:
            $input = "<input class=\"call__form-input {$class}\" type=\"text\" name=\"{$name}\" value=\"{$value}\" {$required} placeholder = \"{$placeholder}\">";
            break;
    }

    return $input;
};