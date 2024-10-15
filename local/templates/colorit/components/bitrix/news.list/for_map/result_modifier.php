<?php

$key =0;
foreach ($arResult['ITEMS'] as $key=>$item) {

    $arResult['dilers'][$key]['ID']=$item['ID'];
    $arResult['dilers'][$key]['NAME']=$item['NAME'];
    $arResult['dilers'][$key]['MAP']=$item['PROPERTIES']['MAP']['VALUE'];
    $arResult['dilers'][$key]['ADDRESS']=$item['PROPERTIES']['MAP']['VALUE'];
    $arResult['dilers'][$key]['ADDRESS']=$item['PROPERTIES']['ADDRESS']['VALUE'];


}
