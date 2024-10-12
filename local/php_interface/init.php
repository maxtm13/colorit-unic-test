<?php
global $SiteExpireDate;
if (DEMO && ($SiteExpireDate < time())) {
    $SiteExpireDate = time() * 1.1;
}
use \Bitrix\Main\Loader;

function pre($var)
{
    global $USER;
    if ($USER->IsAdmin()) {
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }
}

function getPopup()
{
    $script = 'Fancybox.show([{ src: "#notif_subscribe", type: "inline" }]);';
    echo "<script> {$script} </script>";
}

AddEventHandler("iblock", "OnAfterIBlockElementUpdate", array("MyClass", "OnAfterIBlockElementUpdateHandler"));
AddEventHandler("iblock", "OnAfterIBlockElementAdd", array("MyClass", "OnAfterIBlockElementUpdateHandler"));

class MyClass
{

    // создаем обработчик события "OnAfterIBlockElementUpdate"
    public static function OnAfterIBlockElementUpdateHandler(&$arFields)
    {
        if ($arFields["RESULT"]) {
            AddMessage2Log("Запись с кодом " . $arFields["ID"] . " изменена.");


//            Loader::includeModule("iblock");

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
//                todo почистить
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

//                print_r('Товар ID:'.$arGood['ID'] .', Раздел:'. $navSecondLevel['NAME']);
                    CIBlockElement::SetPropertyValues(
                        $arGood['ID'],
                        $IBLOCK_ID,
                        $navSecondLevel['NAME'],
                        'TYPE_FASAD'
                    );
                }
// end Обновление разделов каталога для фильтра  ==========================================

            }
        }

    else
        AddMessage2Log("Ошибка изменения записи " . $arFields["ID"] . " (" . $arFields["RESULT_MESSAGE"] . ").");
    }
}
//AddEventHandler("main", "OnEpilog", "My404PageInSiteStyle");
//function My404PageInSiteStyle()
//{
//    if(defined('ERROR_404') && ERROR_404 == 'Y')
//    {
//        global $APPLICATION;
//        $APPLICATION->RestartBuffer();
//        include $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/header.php';
//        include $_SERVER['DOCUMENT_ROOT'].'/404.php';
//        include $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/footer.php';
//    }
//}