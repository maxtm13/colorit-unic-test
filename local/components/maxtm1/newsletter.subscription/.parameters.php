<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); // Проверка на подключение ядра
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
$arComponentParameters = [
    'GROUPS' => [
        'SETTINGS' => [ // Код группы
            'NAME' => Loc::getMessage('NLSS_DATA'),
            'SORT' => 100,
        ],
    ],
    'PARAMETERS' => [
        'TITLE' => [
            'PARENT' => 'SETTINGS', // Код группы
            'NAME' => Loc::getMessage('NLSS_TITLE'),
            'TYPE' => 'STRING',
            'DEFAULT' => Loc::getMessage('NLSS_TITLE_DEFAULT'),
        ],
        'SUBTITLE' => [
            'PARENT' => 'SETTINGS',
            'NAME' => Loc::getMessage('NLSS_SUBTITLE'),
            'TYPE' => 'STRING',
            'DEFAULT' => Loc::getMessage('NLSS_SUBTITLE_DEFAULT'),
        ],
        'BUTTON' => [
            'PARENT' => 'SETTINGS',
            'NAME' => Loc::getMessage('NLSS_BUTTON'),
            'TYPE' => 'STRING',
            'DEFAULT' => Loc::getMessage('NLSS_BUTTON_DEFAULT'),
        ],
        'POLICY' => [
            'PARENT' => 'SETTINGS',
            'NAME' => Loc::getMessage('NLSS_POLICY'),
            'TYPE' => 'STRING',
            'DEFAULT' => Loc::getMessage('NLSS_POLICY_DEFAULT'),
        ],
    ]
];
?>
