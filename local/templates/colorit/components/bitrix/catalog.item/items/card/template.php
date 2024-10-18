<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var bool $itemHasDetailUrl
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var string $discountPositionClass
 * @var string $labelPositionClass
 * @var CatalogSectionComponent $component
 */
?>

<div class="product-item sssggg">
    <?
    //	echo '<pre>';
    //	print_r($item['PROPERTIES']['GROUP_CHAR'] );
    //	var_dump($item['PROPERTIES']['GROUP_CHAR']['VALUE']);
    //	echo '</pre>';

    ?>
    <a class="product-item-image-wrapper" href="<?= $item['DETAIL_PAGE_URL'] ?>" title="<?= $imgTitle ?>"
       data-entity="image-wrapper">
        <div class="product-item-image-original jjj" id="<?= $itemIds['PICT'] ?>">
            <img src="<?= $item['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $imgTitle ?>">
            <? if (is_array($item['PROPERTIES']['GROUP_CHAR']['VALUE'])) { ?>
                <div class="product-item-chacteristics">
                    <div class="product-item-chacteristics-wrapper">
                        <div class="product-item-chacteristics-title">Характеристики</div>
                        <div class="product-item-chacteristics-list">
                            <? $description = $item['PROPERTIES']['GROUP_CHAR']['DESCRIPTION'];
                            foreach ($item['PROPERTIES']['GROUP_CHAR']['VALUE'] as $key => $PROPERTY) { ?>
                                <div class="chacteristic-item">
                                    <div class="chacteristic-item-name"><?= $PROPERTY ?></div>
                                    <div class="chacteristic-item-description"><?= $description[$key] ?></div>
                                </div>


                            <? } ?>
                        </div>
                    </div>
                </div>
            <? } ?>
        </div>
        <? if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y') {
            ?>
            <div class="product-item-label-ring <?= $discountPositionClass ?>" id="<?= $itemIds['DSC_PERC'] ?>"
                <?= ($price['PERCENT'] > 0 ? '' : 'style="display: none;"') ?>>
                <span><?= -$price['PERCENT'] ?>%</span>
            </div>
            <?
        }
        if ($item['LABEL']) {


            ?>
            <div class="product-item-label-text <?= $labelPositionClass ?>" id="<?= $itemIds['STICKER_ID'] ?>">
                <?
                if (!empty($item['LABEL_ARRAY_VALUE'])) {
                    foreach ($item['LABEL_ARRAY_VALUE'] as $code => $value) {
                        ?>
                        <div
                            class="label label-<?= (!isset($item['LABEL_PROP_MOBILE'][$code]) ? $code . ' hidden-xs"' : $code) ?>">
                            <span title="<?= $value ?>"><?= $value ?></span>
                        </div>
                        <?
                    }
                }
                ?>
            </div>
            <?
        }
        ?>

    </a>
    <div class="product-item-title-wrapper">
        <div class="product-item-title"> <?= $item['NAME'] ?></div>
        <a class="btn btn-primary" href="<?= $item['DETAIL_PAGE_URL'] ?>">Подробнее</a>
    </div>


</div>

    <script>
        $(document).ready(function (){
            $('input[type="checkbox"]').on('change', function (e) {
                // console.log('change')
                setTimeout(()=>{
                link = $('.bx-filter-popup-result>a').attr('href')
                // console.log(link)
                location.href=link
                }, 800)
            })
        })
    </script>
<?
