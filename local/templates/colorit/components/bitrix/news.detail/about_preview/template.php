<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="section__wrapper">
    <div class="section__pict d-none d-md-block"
         style="background-image: linear-gradient(90deg, rgba(255, 255, 255, 0%) 0%,  rgba(255, 255, 255, 0%) 50%, rgba(255, 255, 255, .69) 70.3%, #fff 100%), url(<?= $arResult['PREVIEW_PICTURE']['SRC'] ?>);"></div>
    <div class="section__pict-mobile d-md-none">
        <img
            src="<?= $arResult['PREVIEW_PICTURE']['SRC'] ?>"
            alt="about-<?$arResult['PREVIEW_PICTURE']['ALT']?>"
            class="about-pict"
            title="<?$arResult['PREVIEW_PICTURE']['TITLE']?>"
        >
    </div>
    <div class="section__content">
        <h2 class="section__title"><?= $arParams["PAGER_TITLE"] ?></h2>
        <div class="section__text"><?= $arResult['PREVIEW_TEXT'] ?></div>
        <a href="/about/" class="btn_more">
            <span class="btn_more">Подробнее</span>
        </a>
    </div>

</div>


<h2 class="section__title">Главный офис:</h2>

<div class="contacts">
<!--    <div class='contacts__map' id="map" style="width: 951px; height: 544px"></div>-->
    <div class='contacts__map' id="map"></div>
    <div class="contacts__info">
        <h3 class="contacts__info_title">Главный офис:</h3>
        <div class="contacts__info_wrapper">
            <div class="contacts__info_address"><?= $arResult['PROPERTIES']['ADDRESS']['VALUE'] ?></div>
            <div class="contacts__info_items">
                <div class="contacts__item">
                    <div class="contact__title">Тел:</div>
                    <? foreach ($arResult['PROPERTIES']['PHONES']['VALUE'] as $phone) : ?>
                        <a  class="contact__link" href="tel:<?= preg_replace("/[^0-9]/", '', $phone) ?>">
                            <?= $phone ?>
                        </a>

                    <? endforeach; ?>
                </div>
                <div class="contacts__item">
                    <div class="contact__title">Часы работы:</div>
                    <? foreach ($arResult['PROPERTIES']['WORK_HOURS']['VALUE'] as $work) { ?>
                        <span class="work__time"><?= $work ?></span>

                    <? } ?>

                </div>
                <div class="contacts__item">
                    <div class="contact__title">E-mail:</div>

                    <a  class="contact__link" href="mailto:<?= $arResult['PROPERTIES']['EMAIL']['VALUE'] ?>">
                        <?= $arResult['PROPERTIES']['EMAIL']['VALUE'] ?>
                    </a>

                </div>
                <div class="contacts__item"></div>

            </div>
        </div>
    </div>
</div>


<script>
    let centerMap = [44.390556, 46.167604],
        pinImageSize = [40, 52],
        pinIconImageOffset= [-20, -52],
        metka = [40, 40],
        metkaIconImageOffset= [-20, -20]

    if (document.documentElement.clientWidth <= 561) {
        centerMap = [45.589751, 39.970458];
        pinImageSize = [15, 19];
        pinIconImageOffset = [-pinImageSize[0]/2,-pinImageSize[1]];
        metka = [15, 15];
        metkaIconImageOffset = [-metka[0]/2,-metka[1]/2];
    }

    ymaps.ready(function () {
        var myMap = new ymaps.Map('map', {
            center: centerMap,
            zoom: 6.25,
            controls: {}
        }, {
            searchControlProvider: 'yandex#search'
        })
        myMap.behaviors.disable(["scrollZoom", "drag"])
        // Создаём макет содержимого.
        MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
            '<div style="color: #FFFFFF; font-weight: bold;">$[properties.iconContent]</div>'
        ),

            myPlacemark = new ymaps.Placemark([<?=$arResult['ON_MAP'][0]?>, <?=$arResult['ON_MAP'][1]?>], {
                hintContent: 'Краснодар',
                // balloonContent: 'Это красивая метка'
            },
            {
                // Опции.
                // Необходимо указать данный тип макета.
                iconLayout: 'default#image',
                // Своё изображение иконки метки.
                iconImageHref: 'img/city_mark.png',
                // Размеры метки.
                iconImageSize: metka,
                // Смещение левого верхнего угла иконки относительно
                // её "ножки" (точки привязки).
                iconImageOffset: metkaIconImageOffset
            }),

            myPlacemarkWithContent = new ymaps.Placemark([<?=$arResult['ON_MAP'][0]?>, <?=$arResult['ON_MAP'][1]?>], {
                hintContent: 'Главный оффис',
                // balloonContent: 'А эта — новогодняя',
                // iconContent: '12'
            },
            {
                // Опции.
                // Необходимо указать данный тип макета.
                iconLayout: 'default#imageWithContent',
                // Своё изображение иконки метки.
                iconImageHref: 'img/map_pin.png',
                // Размеры метки.
                iconImageSize: pinImageSize,
                // Смещение левого верхнего угла иконки относительно
                // её "ножки" (точки привязки).
                iconImageOffset: pinIconImageOffset,
                // Смещение слоя с содержимым относительно слоя с картинкой.
                // iconContentOffset: [0, -20],
                // Макет содержимого.
                iconContentLayout: MyIconContentLayout
            });

        myMap.geoObjects
            .add(myPlacemark)
            .add(myPlacemarkWithContent);
    });
</script>