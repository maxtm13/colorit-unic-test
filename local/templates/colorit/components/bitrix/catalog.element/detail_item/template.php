<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Catalog\ProductTable;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);
//$this->addExternalCss('/bitrix/css/main/bootstrap.css');
//$this->addExternalJs(SITE_TEMPLATE_PATH . '/js/slick-slider/slick.min.js');
//$this->addExternalCss(SITE_TEMPLATE_PATH . '/js/slick-slider/slick.min.css');
$this->addExternalJs('https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/panzoom/panzoom.umd.js');
$this->addExternalCss( 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/panzoom/panzoom.css');



$templateLibrary = array('popup', 'fx', 'ui.fonts.opensans');
$currencyList = '';

if (!empty($arResult['CURRENCIES'])) {
    $templateLibrary[] = 'currency';
    $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$haveOffers = !empty($arResult['OFFERS']);

$templateData = [
    'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
    'TEMPLATE_LIBRARY' => $templateLibrary,
    'CURRENCIES' => $currencyList,
    'ITEM' => [
        'ID' => $arResult['ID'],
        'IBLOCK_ID' => $arResult['IBLOCK_ID'],
    ],
];
if ($haveOffers) {
    $templateData['ITEM']['OFFERS_SELECTED'] = $arResult['OFFERS_SELECTED'];
    $templateData['ITEM']['JS_OFFERS'] = $arResult['JS_OFFERS'];
}
unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
    'ID' => $mainId,
    'DISCOUNT_PERCENT_ID' => $mainId . '_dsc_pict',
    'STICKER_ID' => $mainId . '_sticker',
    'BIG_SLIDER_ID' => $mainId . '_big_slider',
    'BIG_IMG_CONT_ID' => $mainId . '_bigimg_cont',
    'SLIDER_CONT_ID' => $mainId . '_slider_cont',
    'OLD_PRICE_ID' => $mainId . '_old_price',
    'PRICE_ID' => $mainId . '_price',
    'DESCRIPTION_ID' => $mainId . '_description',
    'DISCOUNT_PRICE_ID' => $mainId . '_price_discount',
    'PRICE_TOTAL' => $mainId . '_price_total',
    'SLIDER_CONT_OF_ID' => $mainId . '_slider_cont_',
    'QUANTITY_ID' => $mainId . '_quantity',
    'QUANTITY_DOWN_ID' => $mainId . '_quant_down',
    'QUANTITY_UP_ID' => $mainId . '_quant_up',
    'QUANTITY_MEASURE' => $mainId . '_quant_measure',
    'QUANTITY_LIMIT' => $mainId . '_quant_limit',
    'BUY_LINK' => $mainId . '_buy_link',
    'ADD_BASKET_LINK' => $mainId . '_add_basket_link',
    'BASKET_ACTIONS_ID' => $mainId . '_basket_actions',
    'NOT_AVAILABLE_MESS' => $mainId . '_not_avail',
    'COMPARE_LINK' => $mainId . '_compare_link',
    'TREE_ID' => $mainId . '_skudiv',
    'DISPLAY_PROP_DIV' => $mainId . '_sku_prop',
    'DISPLAY_MAIN_PROP_DIV' => $mainId . '_main_sku_prop',
    'OFFER_GROUP' => $mainId . '_set_group_',
    'BASKET_PROP_DIV' => $mainId . '_basket_prop',
    'SUBSCRIBE_LINK' => $mainId . '_subscribe',
    'TABS_ID' => $mainId . '_tabs',
    'TAB_CONTAINERS_ID' => $mainId . '_tab_containers',
    'SMALL_CARD_PANEL_ID' => $mainId . '_small_card_panel',
    'TABS_PANEL_ID' => $mainId . '_tabs_panel'
);
$obName = $templateData['JS_OBJ'] = 'ob' . preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
    : $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
    : $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
    ? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
    : $arResult['NAME'];

if ($haveOffers) {
    $actualItem = $arResult['OFFERS'][$arResult['OFFERS_SELECTED']] ?? reset($arResult['OFFERS']);
    $showSliderControls = false;

    foreach ($arResult['OFFERS'] as $offer) {
        if ($offer['MORE_PHOTO_COUNT'] > 1) {
            $showSliderControls = true;
            break;
        }
    }
} else {
    $actualItem = $arResult;
    $showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;
}

$skuProps = array();
$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;

if ($arParams['SHOW_SKU_DESCRIPTION'] === 'Y') {
    $skuDescription = false;
    foreach ($arResult['OFFERS'] as $offer) {
        if ($offer['DETAIL_TEXT'] != '' || $offer['PREVIEW_TEXT'] != '') {
            $skuDescription = true;
            break;
        }
    }
    $showDescription = $skuDescription || !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
} else {
    $showDescription = !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
}

$showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['PRODUCT']['SUBSCRIBE'] === 'Y' || $haveOffers);
$productType = $arResult['PRODUCT']['TYPE'];

$arParams['MESS_BTN_BUY'] = $arParams['MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCE_CATALOG_BUY');
$arParams['MESS_BTN_ADD_TO_BASKET'] = $arParams['MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCE_CATALOG_ADD');

if ($arResult['MODULES']['catalog'] && $arResult['PRODUCT']['TYPE'] === ProductTable::TYPE_SERVICE) {
    $arParams['~MESS_NOT_AVAILABLE'] = $arParams['~MESS_NOT_AVAILABLE_SERVICE']
        ?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE_SERVICE');
    $arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE_SERVICE']
        ?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE_SERVICE');
} else {
    $arParams['~MESS_NOT_AVAILABLE'] = $arParams['~MESS_NOT_AVAILABLE']
        ?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE');
    $arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE']
        ?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE');
}

$arParams['MESS_BTN_COMPARE'] = $arParams['MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCE_CATALOG_COMPARE');
$arParams['MESS_PRICE_RANGES_TITLE'] = $arParams['MESS_PRICE_RANGES_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_PRICE_RANGES_TITLE');
$arParams['MESS_DESCRIPTION_TAB'] = $arParams['MESS_DESCRIPTION_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TAB');
$arParams['MESS_PROPERTIES_TAB'] = $arParams['MESS_PROPERTIES_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_PROPERTIES_TAB');
$arParams['MESS_COMMENTS_TAB'] = $arParams['MESS_COMMENTS_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_COMMENTS_TAB');
$arParams['MESS_SHOW_MAX_QUANTITY'] = $arParams['MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCE_CATALOG_SHOW_MAX_QUANTITY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = $arParams['MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = $arParams['MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_FEW');

$positionClassMap = array(
    'left' => 'product-item-label-left',
    'center' => 'product-item-label-center',
    'right' => 'product-item-label-right',
    'bottom' => 'product-item-label-bottom',
    'middle' => 'product-item-label-middle',
    'top' => 'product-item-label-top'
);

$discountPositionClass = 'product-item-label-big';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION'])) {
    foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos) {
        $discountPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
    }
}

$labelPositionClass = 'product-item-label-big';
if (!empty($arParams['LABEL_PROP_POSITION'])) {
    foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos) {
        $labelPositionClass .= isset($positionClassMap[$pos]) ? ' ' . $positionClassMap[$pos] : '';
    }
}
?>
    <div class="bx-catalog-element bx-<?= $arParams['TEMPLATE_THEME'] ?>" id="<?= $itemIds['ID'] ?>"
         itemscope itemtype="http://schema.org/Product">
        <div class="container-fluid">
            <?php
            if ($arParams['DISPLAY_NAME'] === 'Y') {
                ?>
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="bx-title"><?= $name ?></h1>
                    </div>
                </div>
                <?php
            }
            ?>
            <section class="product-item-detail-main-info">
                <div class="row">
                    <div class="col-md-5 col-sm-12">
                        <div class="product-item-detail-slider-container" id="<?= $itemIds['BIG_SLIDER_ID'] ?>">
                            <span class="product-item-detail-slider-close" data-entity="close-popup"></span>
                            <div class="product-item-detail-slider-block
						<?= ($arParams['IMAGE_RESOLUTION'] === '1by1' ? 'product-item-detail-slider-block-square' : '') ?>"
                                 data-entity="images-slider-block">
                            <span class="product-item-detail-slider-left" data-entity="slider-control-left"
                                  style="display: none;"></span>
                                <span class="product-item-detail-slider-right" data-entity="slider-control-right"
                                      style="display: none;"></span>
                                <div class="product-item-label-text sss <?= $labelPositionClass ?>"
                                     id="<?= $itemIds['STICKER_ID'] ?>"
                                    <?= (!$arResult['LABEL'] ? 'style="display: none;"' : '') ?>>
                                    <?php
                                    if ($arResult['LABEL'] && !empty($arResult['LABEL_ARRAY_VALUE'])) {
                                        foreach ($arResult['LABEL_ARRAY_VALUE'] as $code => $value) {
                                            ?>
                                            <div<?= (!isset($arParams['LABEL_PROP_MOBILE'][$code]) ? ' class="hidden-xs"' : ' class="' . $code . '"') ?>>
                                                <span title="<?= $value ?>"><?= $value ?></span>
                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <?php
                                if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y') {
                                    if ($haveOffers) {
                                        ?>
                                        <div class="product-item-label-ring <?= $discountPositionClass ?>"
                                             id="<?= $itemIds['DISCOUNT_PERCENT_ID'] ?>"
                                             style="display: none;">
                                        </div>
                                        <?php
                                    } else {
                                        if ($price['DISCOUNT'] > 0) {
                                            ?>
                                            <div class="product-item-label-ring <?= $discountPositionClass ?>"
                                                 id="<?= $itemIds['DISCOUNT_PERCENT_ID'] ?>"
                                                 title="<?= -$price['PERCENT'] ?>%">
                                                <span><?= -$price['PERCENT'] ?>%</span>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                                <div class="product-item-detail-slider-images-container" data-entity="images-container">
                                    <?php
                                    if (!empty($actualItem['MORE_PHOTO'])) {
                                        foreach ($actualItem['MORE_PHOTO'] as $key => $photo) {
                                            ?>
                                            <div
                                                class="product-item-detail-slider-image<?= ($key == 0 ? ' active' : '') ?>"
                                                data-entity="image" data-id="<?= $photo['ID'] ?>">
                                                <a class="product-item-detail-slider-image-link" data-fancybox
                                                   src="<?= $photo['SRC'] ?>"
                                                    id="zoom"
                                                >
                                                    <img src="<?= $photo['SRC'] ?>" alt="<?= $alt ?>"
                                                         title="<?= $title ?>"<?= ($key == 0 ? ' itemprop="image"' : '') ?>>
                                                </a>
                                            </div>
                                            <?php
                                        }
                                    }

                                    if ($arParams['SLIDER_PROGRESS'] === 'Y') {
                                        ?>
                                        <div class="product-item-detail-slider-progress-bar"
                                             data-entity="slider-progress-bar" style="width: 0;"></div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                            if ($showSliderControls) {
                                if ($haveOffers) {
                                    foreach ($arResult['OFFERS'] as $keyOffer => $offer) {
                                        if (!isset($offer['MORE_PHOTO_COUNT']) || $offer['MORE_PHOTO_COUNT'] <= 0)
                                            continue;

                                        $strVisible = $arResult['OFFERS_SELECTED'] == $keyOffer ? '' : 'none';
                                        ?>
                                        <div class="product-item-detail-slider-controls-block"
                                             id="<?= $itemIds['SLIDER_CONT_OF_ID'] . $offer['ID'] ?>"
                                             style="display: <?= $strVisible ?>;">
                                            <?php
                                            foreach ($offer['MORE_PHOTO'] as $keyPhoto => $photo) {
                                                ?>
                                                <div
                                                    class="product-item-detail-slider-controls-image<?= ($keyPhoto == 0 ? ' active' : '') ?>"
                                                    data-entity="slider-control"
                                                    data-value="<?= $offer['ID'] . '_' . $photo['ID'] ?>">
                                                    <img src="<?= $photo['SRC'] ?>">
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <div class="product-item-detail-slider-controls-block"
                                         id="<?= $itemIds['SLIDER_CONT_ID'] ?>">
                                        <?php
                                        if (!empty($actualItem['MORE_PHOTO'])) {
                                            foreach ($actualItem['MORE_PHOTO'] as $key => $photo) {
                                                ?>
                                                <div
                                                    class="product-item-detail-slider-controls-image<?= ($key == 0 ? ' active' : '') ?>"
                                                    data-entity="slider-control" data-value="<?= $photo['ID'] ?>">
                                                    <img src="<?= $photo['SRC'] ?>">
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-12">
                        <div class="row">


                            <div class="product-item-detail-info-section">
                                <div class="product-item-detail-detail-text">
                                    <?= $arResult['DETAIL_TEXT'] ?>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <button class="calculate-button" data-fancybox data-src="#cost">Рассчитать стоимость</button>
                                <div class="product-item-detail-properties">
                                    <div class="properties-wrapper">
                                        <?
                                        if (!empty($arResult['DISPLAY_PROPERTIES']) || $arResult['SHOW_OFFERS_PROPS']) {
                                            ?>
                                            <div class="product-item-detail-info-container">
                                                <?php
                                                if (!empty($arResult['DISPLAY_PROPERTIES'])) {
                                                    ?>
                                                    <div class="product-item-detail-info-container-title">Характеристики
                                                    </div>
                                                    <dl class="product-item-detail-properties ">
                                                        <ul class="char-list">
                                                            <?php


                                                            foreach ($arResult['DISPLAY_PROPERTIES'] as $property) {
                                                                if (isset($arParams['MAIN_BLOCK_PROPERTY_CODE'][$property['CODE']])) {
                                                                    foreach ($property['DISPLAY_VALUE'] as $key => $value) {


                                                                        ?>
                                                                        <li class="char-item">
                                                                            <dt><?= $value ?></dt>
                                                                            <dd><?= $property['DESCRIPTION'][$key] ?> </dd>
                                                                        </li>
                                                                        <?php
                                                                    }
                                                                }
                                                                break;
                                                            }
                                                            unset($property);
                                                            ?>
                                                        </ul>
                                                    </dl>
                                                    <?php
                                                }

                                                if ($arResult['SHOW_OFFERS_PROPS']) {
                                                    ?>
                                                    <dl class="product-item-detail-properties"
                                                        id="<?= $itemIds['DISPLAY_MAIN_PROP_DIV'] ?>"></dl>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <?php
                                        }

                                        ?>
                                    </div>
                                    <div class="properties-link">
                                        <a href="#charakteristics" class="link">Все характеристики</a>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="row">
                <div class="col-xs-12">
                    <?php
                    if ($haveOffers) {
                        if ($arResult['OFFER_GROUP']) {
                            foreach ($arResult['OFFER_GROUP_VALUES'] as $offerId) {
                                ?>
                                <span id="<?= $itemIds['OFFER_GROUP'] . $offerId ?>" style="display: none;">
								<?php
                                $APPLICATION->IncludeComponent(
                                    'bitrix:catalog.set.constructor',
                                    '.default',
                                    array(
                                        'CUSTOM_SITE_ID' => $arParams['CUSTOM_SITE_ID'] ?? null,
                                        'IBLOCK_ID' => $arResult['OFFERS_IBLOCK'],
                                        'ELEMENT_ID' => $offerId,
                                        'PRICE_CODE' => $arParams['PRICE_CODE'],
                                        'BASKET_URL' => $arParams['BASKET_URL'],
                                        'OFFERS_CART_PROPERTIES' => $arParams['OFFERS_CART_PROPERTIES'],
                                        'CACHE_TYPE' => $arParams['CACHE_TYPE'],
                                        'CACHE_TIME' => $arParams['CACHE_TIME'],
                                        'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
                                        'TEMPLATE_THEME' => $arParams['~TEMPLATE_THEME'],
                                        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                                        'CURRENCY_ID' => $arParams['CURRENCY_ID']
                                    ),
                                    $component,
                                    array('HIDE_ICONS' => 'Y')
                                );
                                ?>
							</span>
                                <?php
                            }
                        }
                    } else {
                        if ($arResult['MODULES']['catalog'] && $arResult['OFFER_GROUP']) {
                            $APPLICATION->IncludeComponent(
                                'bitrix:catalog.set.constructor',
                                '.default',
                                array(
                                    'CUSTOM_SITE_ID' => $arParams['CUSTOM_SITE_ID'] ?? null,
                                    'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                                    'ELEMENT_ID' => $arResult['ID'],
                                    'PRICE_CODE' => $arParams['PRICE_CODE'],
                                    'BASKET_URL' => $arParams['BASKET_URL'],
                                    'CACHE_TYPE' => $arParams['CACHE_TYPE'],
                                    'CACHE_TIME' => $arParams['CACHE_TIME'],
                                    'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
                                    'TEMPLATE_THEME' => $arParams['~TEMPLATE_THEME'],
                                    'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                                    'CURRENCY_ID' => $arParams['CURRENCY_ID']
                                ),
                                $component,
                                array('HIDE_ICONS' => 'Y')
                            );
                        }
                    }
                    ?>
                </div>
            </div>
            <section class="slider">
                <div class="row">
                    <div class="unvisible-pict" style="display:none">
                        <ul>

                        <? foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $key => $pict) { ?>
                            <li class="pict-item">
                                <img src="<?= CFile::GetPath($pict) ?>"
                                     alt="interer <?= $arResult['PROPERTIES']['MORE_PHOTO']['DESCRIPTION'][$key] ?>"
                                     class="unvisible-pict-item"
                                     data-fancybox="gallery-a"
                                >
                            </li>
                        <? } ?>
                        </ul>
                    </div>

                    <div class="product-item-detail-slider-section">
                        <div class="slider-section-title">В интерьере</div>
                        <div class="slider-section-slider">
                            <? foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $key => $pict) { ?>
                                <div class="slider-item" data-fancybox-trigger="gallery-a" data-fancybox-index="<?=$key?>">
                                    <img src="<?= CFile::GetPath($pict) ?>"
                                         alt="interer <?= $arResult['PROPERTIES']['MORE_PHOTO']['DESCRIPTION'][$key] ?>"
                                         class="slider-item-pict"

                                    >
                                </div>
                            <? } ?>
                        </div>
                    </div>

                </div>
            </section>
            <section class="charakteristics" id="charakteristics">
                <div class="row">
                    <div class="product-item-charakteristics-title">
                        Характеристики
                    </div>
                    <div class="col-md-6">
                        <div class="product-item-charakteristics">
                            <?
                            if (!empty($arResult['DISPLAY_PROPERTIES'])) {
                                ?>
                                <div class="product-item-detail-props">
                                    <?php
                                    //                                echo '<pre>';
                                    //                                print_r($arResult['PROPERTIES']['SCHEMA_PHOTO']['VALUE']);
                                    //                                echo '</pre>';

                                    foreach ($arResult['DISPLAY_PROPERTIES'] as $property) {
                                        if (isset($arParams['MAIN_BLOCK_PROPERTY_CODE'][$property['CODE']])) {
                                            ?>
                                            <div class="product-item-group-wrapper">
                                                <div class="product-item-group-char"><?= $property['NAME'] ?></div>
                                                <?
                                                if (is_array($property['DISPLAY_VALUE'])) { ?>
                                                    <ul class="char-list">
                                                        <?
                                                        foreach ($property['DISPLAY_VALUE'] as $key => $item_char) { ?>
                                                            <li class="char-item">
                                                                <dt><?= $item_char ?></dt>
                                                                <dd> <?= $property['DESCRIPTION'][$key] ?></dd>

                                                            </li>

                                                            <?
                                                        }
                                                        ?>
                                                    </ul>
                                                <? } else { ?>
                                                    <div class="char-item"><?= $property['DISPLAY_VALUE'] ?></div>
                                                <? } ?>
                                            </div>
                                            <?php
                                        }
                                    }
                                    unset($property, $item_char, $key);
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product-item-schema">
                            <a data-fancyboxschema class="pict-link" id="btn"
                               data-src="<?= CFile::GetPath($arResult['PROPERTIES']['SCHEMA_PHOTO']['VALUE']) ?>">
                                <img src="<?= CFile::GetPath($arResult['PROPERTIES']['SCHEMA_PHOTO']['VALUE']) ?>"
                                     alt="schema" class="schema-pict">
                            </a>
                        </div>
                    </div>
                </div>
            </section>
            <section class="add-items">
                <div class="row">
                    <div class="col-12">
                        <?
                        if (!empty($arResult['PROPERTIES']['ADDITIONAL']['VALUE'])) {?>
                        <div class="product-item-add-items-title">Рекомендуем в сочетании:</div>
                        <div class="product-item-add-items">
                            <?
                            $GLOBALS['arrFilterLinked'] = array('=ID' => $arResult['PROPERTIES']['ADDITIONAL']['VALUE']);
                            // Элементы раздела

                            $APPLICATION->IncludeComponent(
                                "bitrix:catalog.section",
                                "catalog_list",
                                array(
                                    "IBLOCK_TYPE" => "catalog",
                                    "IBLOCK_ID" => "1",
                                    "SECTION_ID" => "",
                                    "SECTION_CODE" => "",
                                    "SECTION_USER_FIELDS" => array(
                                        0 => "",
                                        1 => "",
                                    ),
                                    "ELEMENT_SORT_FIELD" => "sort",
                                    "ELEMENT_SORT_ORDER" => "asc",
                                    "ELEMENT_SORT_FIELD2" => "id",
                                    "ELEMENT_SORT_ORDER2" => "desc",
                                    "FILTER_NAME" => "arrFilterLinked",
                                    "INCLUDE_SUBSECTIONS" => "Y",
                                    "SHOW_ALL_WO_SECTION" => "N",
                                    "HIDE_NOT_AVAILABLE" => "N",
                                    "PAGE_ELEMENT_COUNT" => "30",
                                    "LINE_ELEMENT_COUNT" => "3",
                                    "PROPERTY_CODE" => "",
                                    "OFFERS_LIMIT" => "5",
                                    "SECTION_URL" => "",
                                    "DETAIL_URL" => "",
                                    "SECTION_ID_VARIABLE" => "SECTION_ID",
                                    "AJAX_MODE" => "N",
                                    "AJAX_OPTION_JUMP" => "N",
                                    "AJAX_OPTION_STYLE" => "Y",
                                    "AJAX_OPTION_HISTORY" => "N",
                                    "AJAX_OPTION_ADDITIONAL" => "",
                                    "CACHE_TYPE" => "A",
                                    "CACHE_TIME" => "36000000",
                                    "CACHE_NOTES" => "",
                                    "CACHE_GROUPS" => "Y",
                                    "SET_TITLE" => "N",
                                    "SET_BROWSER_TITLE" => "N",
                                    "BROWSER_TITLE" => "-",
                                    "SET_META_KEYWORDS" => "N",
                                    "META_KEYWORDS" => "-",
                                    "SET_META_DESCRIPTION" => "N",
                                    "META_DESCRIPTION" => "-",
                                    "ADD_SECTIONS_CHAIN" => "N",
                                    "SET_STATUS_404" => "N",
                                    "CACHE_FILTER" => "N",
                                    "ACTION_VARIABLE" => "action",
                                    "PRODUCT_ID_VARIABLE" => "id",
                                    "PRICE_CODE" => array(),
                                    "USE_PRICE_COUNT" => "N",
                                    "SHOW_PRICE_COUNT" => "1",
                                    "PRICE_VAT_INCLUDE" => "N",
                                    "CONVERT_CURRENCY" => "N",
                                    "BASKET_URL" => "",
                                    "USE_PRODUCT_QUANTITY" => "N",
                                    "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                                    "ADD_PROPERTIES_TO_BASKET" => "N",
                                    "PRODUCT_PROPS_VARIABLE" => "prop",
                                    "PARTIAL_PRODUCT_PROPERTIES" => "N",
                                    "PRODUCT_PROPERTIES" => "",
                                    "DISPLAY_COMPARE" => "N",
                                    "PAGER_TEMPLATE" => ".default",
                                    "DISPLAY_TOP_PAGER" => "N",
                                    "DISPLAY_BOTTOM_PAGER" => "N",
                                    "PAGER_TITLE" => "Товары",
                                    "PAGER_SHOW_ALWAYS" => "N",
                                    "PAGER_DESC_NUMBERING" => "N",
                                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                    "PAGER_SHOW_ALL" => "N",
                                    "COMPONENT_TEMPLATE" => "catalog_list",
                                    "PROPERTY_CODE_MOBILE" => array(),
                                    "BACKGROUND_IMAGE" => "-",
                                    "TEMPLATE_THEME" => "blue",
                                    "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'3','BIG_DATA':false}]",
                                    "ENLARGE_PRODUCT" => "STRICT",
                                    "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
                                    "SHOW_SLIDER" => "Y",
                                    "SLIDER_INTERVAL" => "3000",
                                    "SLIDER_PROGRESS" => "N",
                                    "ADD_PICT_PROP" => "-",
                                    "LABEL_PROP" => array(
                                        0 => "IS_HIT",
                                        1 => "IS_NEW",
                                    ),
                                    "LABEL_PROP_MOBILE" => array(),
                                    "LABEL_PROP_POSITION" => "top-right",
                                    "MESS_BTN_BUY" => "Купить",
                                    "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                                    "MESS_BTN_SUBSCRIBE" => "Подписаться",
                                    "MESS_BTN_DETAIL" => "Подробнее",
                                    "MESS_NOT_AVAILABLE" => "Нет в наличии",
                                    "MESS_NOT_AVAILABLE_SERVICE" => "Недоступно",
                                    "SEF_MODE" => "Y",
                                    "SEF_RULE" => "",
                                    "SECTION_CODE_PATH" => "",
                                    "SET_LAST_MODIFIED" => "N",
                                    "USE_MAIN_ELEMENT_SECTION" => "N",
                                    "USE_ENHANCED_ECOMMERCE" => "N",
                                    "PAGER_BASE_LINK_ENABLE" => "N",
                                    "LAZY_LOAD" => "N",
                                    "MESS_BTN_LAZY_LOAD" => "Показать ещё",
                                    "LOAD_ON_SCROLL" => "N",
                                    "SHOW_404" => "N",
                                    "MESSAGE_404" => "",
                                    "COMPATIBLE_MODE" => "N",
                                    "DISABLE_INIT_JS_IN_COMPONENT" => "N"
                                ),
                                false
                            );
                            ?>

                        </div>
                        <? }?>
                    </div>
                </div>
            </section>

        </div>
        <!--Small Card-->
        <!--Top tabs-->

        <meta itemprop="name" content="<?= $name ?>"/>
        <meta itemprop="category" content="<?= $arResult['CATEGORY_PATH'] ?>"/>

    </div>
<?php


$jsParams["IS_FACEBOOK_CONVERSION_CUSTOMIZE_PRODUCT_EVENT_ENABLED"] =
    $arResult["IS_FACEBOOK_CONVERSION_CUSTOMIZE_PRODUCT_EVENT_ENABLED"];

?>
    <script>
        //BX.message({
        //    ECONOMY_INFO_MESSAGE: '<?php //=GetMessageJS('CT_BCE_CATALOG_ECONOMY_INFO2')?>//',
        //    TITLE_ERROR: '<?php //=GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR')?>//',
        //    TITLE_BASKET_PROPS: '<?php //=GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS')?>//',
        //    BASKET_UNKNOWN_ERROR: '<?php //=GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR')?>//',
        //    BTN_SEND_PROPS: '<?php //=GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS')?>//',
        //    BTN_MESSAGE_DETAIL_BASKET_REDIRECT: '<?php //=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_BASKET_REDIRECT')?>//',
        //    BTN_MESSAGE_CLOSE: '<?php //=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE')?>//',
        //    BTN_MESSAGE_DETAIL_CLOSE_POPUP: '<?php //=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE_POPUP')?>//',
        //    TITLE_SUCCESSFUL: '<?php //=GetMessageJS('CT_BCE_CATALOG_ADD_TO_BASKET_OK')?>//',
        //    COMPARE_MESSAGE_OK: '<?php //=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_OK')?>//',
        //    COMPARE_UNKNOWN_ERROR: '<?php //=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_UNKNOWN_ERROR')?>//',
        //    COMPARE_TITLE: '<?php //=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_TITLE')?>//',
        //    BTN_MESSAGE_COMPARE_REDIRECT: '<?php //=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT')?>//',
        //    PRODUCT_GIFT_LABEL: '<?php //=GetMessageJS('CT_BCE_CATALOG_PRODUCT_GIFT_LABEL')?>//',
        //    PRICE_TOTAL_PREFIX: '<?php //=GetMessageJS('CT_BCE_CATALOG_MESS_PRICE_TOTAL_PREFIX')?>//',
        //    RELATIVE_QUANTITY_MANY: '<?php //=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY'])?>//',
        //    RELATIVE_QUANTITY_FEW: '<?php //=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW'])?>//',
        //    SITE_ID: '<?php //=CUtil::JSEscape($component->getSiteId())?>//'
        //});
        //
        //var <?php //=$obName?>// = new JCCatalogElement(<?php //=CUtil::PhpToJSObject($jsParams, false, true)?>//);
    </script>
<?php
//echo '<pre>';
////print_r($arResult['PROPERTIES']['ADDITIONAL']['VALUE']);
//echo '</pre>';

unset($actualItem, $itemIds, $jsParams);
?>
 <div style="display: none; width: 500px;" id="cost">
        <? $GLOBALS['product'] = ['NAME'=> 'someID'];

        $APPLICATION->IncludeComponent(
            "maxtm1:form.result.new",
            "cost",
            array(
                "AJAX_MODE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_SHADOW" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "CACHE_TIME" => "3600",
                "CACHE_TYPE" => "A",
                "CHAIN_ITEM_LINK" => "",
                "CHAIN_ITEM_TEXT" => "",
                "EDIT_URL" => "",
                "IGNORE_CUSTOM_TEMPLATE" => "Y",
                "LIST_URL" => "",
                "SEF_MODE" => "N",
                "SUCCESS_URL" => "",
                "USE_EXTENDED_ERRORS" => "N",
                "WEB_FORM_ID" => "5",
                "COMPONENT_TEMPLATE" => "cost",
                "VARIABLE_ALIASES" => array(
                    "WEB_FORM_ID" => "WEB_FORM_ID",
                    "RESULT_ID" => "RESULT_ID",
                ),
            ),
            false
        );?>
    </div>

    <script>
        // $('.calculate-button').click(function (){
        //     Fancybox.show({ src: "#cost", type: "inline" })
        // })
        // Fancybox.bind('[data-fancybox]', {
        //     // Your custom options
        // });
    </script>