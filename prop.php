<?php

//$_SERVER['DOCUMENT_ROOT'] = realpath(dirname(__FILE__) . '/../..');



define('NO_KEEP_STATISTIC', true);
define('NOT_CHECK_PERMISSIONS', true);
define('BX_NO_ACCELERATOR_RESET', true);
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

@set_time_limit(0);
@ignore_user_abort(true);

use \Bitrix\Main\Loader;

Loader::includeModule("iblock");

$IBLOCK_ID = 1;

$dbGoods = CIBlockElement::GetList(
    false,
    array(
        'IBLOCK_ID' => $IBLOCK_ID
    ),
    false,
    false,
    array(
        'ID',
        'IBLOCK_SECTION_ID'
    )
);
while ($arGood = $dbGoods->Fetch()) {

// Обновление наличие для фильтра ==========================================
// Очищаем свойство от предыдущих значений
    CIBlockElement::SetPropertyValuesEx(
        $arGood['ID'],
        $IBLOCK_ID,
        array(
            'TYPE_FASAD' => '',
        )
    );

//    $arProduct = CCatalogProduct::GetByID($arGood['ID']);
//    $quantity = $arProduct['QUANTITY'];
//    if ($quantity > 0) {
//        CIBlockElement::SetPropertyValuesEx(
//            $arGood['ID'],
//            $IBLOCK_ID,
//            array(
//                'ATT_NAL_STORE' => $quantity,
//                'ATT_NAL_FILTER' => 'Да'
//            )
//        );
//        \Bitrix\Iblock\PropertyIndex\Manager::updateElementIndex(
//            $IBLOCK_ID,
//            $arGood['ID']
//        );
//    }
// end Обновление наличие для фильтра ==========================================


// Обновление разделов каталога для фильтра  ==========================================
// Получаем цепочку разделов для текущего товара
    $navChainResult = CIBlockSection::GetNavChain(
        $IBLOCK_ID,
        $arGood["IBLOCK_SECTION_ID"]
    );

// Пропускаем первый элемент, так как он корневой
    $navChainResult->Fetch();

// Получаем второй элемент, который и будет разделом второго уровня
    if ($navSecondLevel = $navChainResult->Fetch()) {
// Устанавливаем свойство товара на значение раздела второго уровня

        print_r('Товар ID:'.$arGood['ID'] .', Раздел:'. $navSecondLevel['NAME']);
        CIBlockElement::SetPropertyValues(
            $arGood['ID'],
            $IBLOCK_ID,
            $navSecondLevel['NAME'],
            'TYPE_FASAD'
        );
    }
// end Обновление разделов каталога для фильтра  ==========================================

}


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
