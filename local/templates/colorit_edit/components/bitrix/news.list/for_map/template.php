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


<?php

$this->SetViewTarget("map", 1);
?>
<div id="about-map">

</div>
<script>
    let ID = null;
    ymaps.ready(function () {
        var myMap = new ymaps.Map('about-map', {
            center: [52.521988, 48.905297],
            zoom: 4.25,
            controls: {}
        }, {
            searchControlProvider: 'yandex#search'
        })
        myMap.behaviors.disable(["scrollZoom", "drag"])
        // Создаём макет содержимого.
        // MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
        //     '<div style="color: #FFFFFF; font-weight: bold;">$[properties.iconContent]</div>'
        // ),
        let objectManager = new ymaps.ObjectManager({
            clusterize: true,
            gridSize: 32,
            clusterDisableClickZoom: true
        });
        objectManager.objects.options.set({
            iconLayout: 'default#image',
            iconImageSize: [30, 39],
            iconImageHref: '/img/map_pin.png', // Укажите путь к вашему изображению
            iconImageOffset: [-15, -39],

            // iconContentOffset: [0, 0],

        });
        myMap.geoObjects.add(objectManager);
        let objects = {
            type: 'FeatureCollection',
            features: [
                <?foreach ($arResult['dilers'] as $key=>$item) {?>
                {
                    type: 'Feature',
                    id: <?=$item['ID'] ?>,
                    geometry: {
                        type: 'Point',
                        coordinates: [<?=$item['MAP']?>],
                    },
                    properties: {
                        balloonContent: "<? echo $item['NAME'] . ' ' .   $item['ADDRESS']?>",
                        hintContent: "<?= $item['NAME']?>"
                    }
                },
                <?}?>


            ]
        };

        // Добавляем данные в ObjectManager
        objectManager.add(objects);
        objectManager.objects.events.add('click', function (e) {
            ID =  e.get('objectId');
            let items=$('.news-item')
            items.removeClass('active').find('.news-item-info').slideUp(300);
            let item = $('.news-item[data-id="'+ID+'"]')
            // console.log(item)
            item.addClass('active').find('.news-item-info').slideDown(300)
        });



    });
    //

</script>
<?php
$this->EndViewTarget();
?>
