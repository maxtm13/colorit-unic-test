// ymaps.ready(function () {
//     var myMap = new ymaps.Map('map', {
//             center: [<?=$arResult['ON_MAP'][0]?>, <?=$arResult['ON_MAP'][1]?>],
//             zoom: 9
//         }, {
//             searchControlProvider: 'yandex#search'
//         }),
//
//         // Создаём макет содержимого.
//         MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
//             '<div style="color: #FFFFFF; font-weight: bold;">$[properties.iconContent]</div>'
//         ),
//
//         myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
//             hintContent: 'Собственный значок метки',
//             balloonContent: 'Это красивая метка'
//         }, {
//             // Опции.
//             // Необходимо указать данный тип макета.
//             iconLayout: 'default#image',
//             // Своё изображение иконки метки.
//             iconImageHref: 'images/myIcon.gif',
//             // Размеры метки.
//             iconImageSize: [30, 42],
//             // Смещение левого верхнего угла иконки относительно
//             // её "ножки" (точки привязки).
//             iconImageOffset: [-5, -38]
//         }),
//
//         myPlacemarkWithContent = new ymaps.Placemark([<?=$arResult['ON_MAP'][0]?>, <?=$arResult['ON_MAP'][1]?>, {
//             hintContent: 'Собственный значок метки с контентом',
//             balloonContent: 'А эта — новогодняя',
//             iconContent: '12'
//         }, {
//             // Опции.
//             // Необходимо указать данный тип макета.
//             iconLayout: 'default#imageWithContent',
//             // Своё изображение иконки метки.
//             iconImageHref: 'images/ball.png',
//             // Размеры метки.
//             iconImageSize: [48, 48],
//             // Смещение левого верхнего угла иконки относительно
//             // её "ножки" (точки привязки).
//             iconImageOffset: [-24, -24],
//             // Смещение слоя с содержимым относительно слоя с картинкой.
//             iconContentOffset: [15, 15],
//             // Макет содержимого.
//             iconContentLayout: MyIconContentLayout
//         });
//
//     myMap.geoObjects
//         .add(myPlacemark)
//         .add(myPlacemarkWithContent);
// });