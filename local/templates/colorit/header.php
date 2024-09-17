<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
$CurDir = $APPLICATION->GetCurDir();
$CurUri = $APPLICATION->GetCurUri();
?>

<!doctype html>
<html xml:lang="<?= LANGUAGE_ID ?>" lang="<?= LANGUAGE_ID ?>">
<head>
    <?

    use Bitrix\Main\Page\Asset;

    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/css/bootstrap-grid.min.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/js/fancybox/fancybox.min.css');
//    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . '/fonts/stylesheet.min.css');
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@100;300;400;500;700;800;900&display=swap"
        rel="stylesheet">
    <?
    CJSCore::Init(array("jquery3"));
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/main.min.js');
    Asset::getInstance()->addJs('https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=73ca52d4-f222-48f5-99aa-89da6d8dccfa');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/jquery-3.3.1.maskedinput.min.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . '/js/fancybox/fancybox.umd.js');
    $APPLICATION->ShowHead();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><? $APPLICATION->ShowTitle() ?></title>
</head>
<body>
<? $APPLICATION->ShowPanel(); ?>
<header class="header container">
    <div class="header__wrapper">
        <div class="header__logo">
            <a href="/" class="header__logo_link">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/includes/logo.php"
                    )
                ); ?>
                <!--                    <img src="/upload/medialibrary/cdd/bmlwgpew1l94xs4etil41m8oef9sssa0.png" alt="logo" class="header__logo_pict">-->
            </a>
        </div>
        <nav class="header__menu">
            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "main_menu",
                array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "left_infoblock",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "3",
                    "MENU_CACHE_GET_VARS" => array(),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "N",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "top",
                    "USE_EXT" => "Y",
                    "COMPONENT_TEMPLATE" => "main_menu"
                ),
                false
            ); ?>


        </nav>
        <div class="header__content_btn">
            <? $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/includes/content.php"
                )
            ); ?>

        </div>
        <div class="header__search_btn">
            <a href class="search_btn">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M21.7306 20.4376L17.7231 16.43C16.9958 15.7028 16.9618 14.5512 17.4477 13.6447C18.1458 12.3424 18.5429 10.8531 18.5429 9.27143C18.5429 4.15306 14.3898 0 9.27143 0C4.14857 0 0 4.15306 0 9.27143C0 14.3898 4.14857 18.5429 9.27143 18.5429C10.853 18.5429 12.3398 18.1482 13.6407 17.4515C14.5471 16.9662 15.6982 16.9998 16.4255 17.7264L20.4331 21.7306C20.7922 22.0898 21.3714 22.0898 21.7306 21.7306C22.0898 21.3759 22.0898 20.7922 21.7306 20.4376ZM9.27143 16.6975C5.17224 16.6975 1.84082 13.3661 1.84082 9.27143C1.84082 5.17673 5.17224 1.84082 9.27143 1.84082C13.3661 1.84082 16.702 5.17673 16.702 9.27143C16.702 13.3661 13.3661 16.6975 9.27143 16.6975Z"
                        fill="#141C20"/>
                </svg>
            </a>
        </div>
        <div class="header__search_wrapper">
            <? $APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	".default", 
	array(
		"CATEGORY_0" => array(
			0 => "no",
		),
		"CATEGORY_0_TITLE" => "",
		"CHECK_DATES" => "N",
		"CONTAINER_ID" => "title-search",
		"INPUT_ID" => "title-search-input",
		"NUM_CATEGORIES" => "1",
		"ORDER" => "date",
		"PAGE" => "#SITE_DIR#search/index.php",
		"SHOW_INPUT" => "Y",
		"SHOW_OTHERS" => "N",
		"TOP_COUNT" => "5",
		"USE_LANGUAGE_GUESS" => "Y",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
); ?>
        </div>
        <div class="header__social_box">
            <? $APPLICATION->IncludeComponent(
                "bitrix:main.include",
                "",
                array(
                    "AREA_FILE_SHOW" => "file",
                    "AREA_FILE_SUFFIX" => "inc",
                    "EDIT_TEMPLATE" => "",
                    "PATH" => "/includes/socials.php"
                )
            ); ?>

<!--            <a href="https://vk.com/coloritfasad" class="social_link vk" target="_blank">-->
<!--                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                    <g clip-path="url(#clip0_3403_1809)">-->
<!--                        <path-->
<!--                            d="M20.6547 10.6092C20.7589 10.2584 20.6547 10 20.1582 10H18.5173C18.0996 10 17.9076 10.2228 17.8034 10.469C17.8034 10.469 16.9687 12.5239 15.7868 13.859C15.4043 14.2454 15.2311 14.3682 15.0218 14.3682C14.9176 14.3682 14.7661 14.2447 14.7661 13.8938V10.6092C14.7661 10.1879 14.6454 10 14.2974 10H11.7191C11.4581 10 11.3014 10.1955 11.3014 10.3811C11.3014 10.7804 11.8923 10.8729 11.9538 11.9973V14.4386C11.9538 14.9743 11.8578 15.0713 11.6493 15.0713C11.0936 15.0713 9.73998 13.0066 8.93754 10.6448C8.78005 10.1856 8.62256 10 8.20334 10H6.56246C6.09374 10 6 10.2228 6 10.469C6 10.9085 6.55571 13.0861 8.58956 15.9669C9.94621 17.9339 11.8556 19 13.5947 19C14.6379 19 14.7669 18.7628 14.7669 18.3552V16.8686C14.7669 16.395 14.8659 16.3003 15.1958 16.3003C15.4396 16.3003 15.8565 16.4231 16.8307 17.3717C17.9429 18.4954 18.1266 19 18.7528 19H20.3937C20.8624 19 21.0972 18.7628 20.9622 18.2953C20.8144 17.8293 20.2827 17.1542 19.5778 16.3526C19.1953 15.8957 18.6223 15.4039 18.4476 15.1584C18.2046 14.8425 18.2744 14.7015 18.4476 14.4204C18.4476 14.4204 20.4462 11.5753 20.6547 10.6092Z"/>-->
<!--                        <path-->
<!--                            d="M27.6171 14.0547C27.6171 15.9578 27.5679 25.6922 27.6171 27.5953C23.9367 27.6008 4.17803 27.6664 0.497559 27.5953C0.497559 23.6742 0.497564 4.42431 0.497564 0.503218C4.06866 0.503218 23.9737 0.47034 27.5448 0.503153C27.4603 0.533203 27.6281 0.459434 27.6281 0.503143C27.6281 2.49377 27.6171 12.0586 27.6171 14.0547ZM2.51555 14.0547C2.51555 16.0617 2.51555 23.5703 2.51555 25.5774C6.18508 25.6321 21.9241 25.5883 25.5991 25.5774C25.5773 21.6946 25.5937 6.4094 25.5937 2.52659C21.9296 2.48284 6.1632 2.52112 2.49914 2.52659C2.56477 4.41878 2.51555 12.168 2.51555 14.0547Z"/>-->
<!--                    </g>-->
<!--                    <defs>-->
<!--                        <clipPath id="clip0_3403_1809">-->
<!--                            <rect width="28" height="28" fill="white"/>-->
<!--                        </clipPath>-->
<!--                    </defs>-->
<!--                </svg>-->
<!---->
<!--            </a>-->
<!--            <a href="https://instagram.com/coloritfasad" class="social_link instagram" target="_blank">-->
<!--                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                    <g clip-path="url(#clip0_3403_1801)">-->
<!--                        <path-->
<!--                            d="M14.0875 19.8516C10.5602 19.8516 7.71641 17.0406 7.71095 13.5406C7.70548 10.0953 10.5711 7.27345 14.0766 7.27345C17.593 7.26798 20.4477 10.0844 20.4531 13.557C20.4531 17.0242 17.6039 19.8461 14.0875 19.8516ZM14.0875 17.8281C16.4883 17.8281 18.4352 15.9086 18.4297 13.5461C18.4242 11.2055 16.4774 9.29141 14.0875 9.29141C11.6867 9.29141 9.72891 11.2 9.72891 13.557C9.73438 15.9195 11.6867 17.8336 14.0875 17.8281Z"/>-->
<!--                        <path-->
<!--                            d="M21.1913 5.35938C21.9296 5.35938 22.5312 5.98828 22.5312 6.75937C22.5257 7.53047 21.9187 8.15391 21.1804 8.14844C20.4531 8.14297 19.857 7.51953 19.857 6.76484C19.8515 5.99375 20.4531 5.35938 21.1913 5.35938Z"/>-->
<!--                        <path-->
<!--                            d="M27.6171 14.0547C27.6171 15.9578 27.5679 25.6922 27.6171 27.5953C23.9367 27.6008 4.17803 27.6664 0.497559 27.5953C0.497559 23.6742 0.497564 4.42431 0.497564 0.503218C4.06866 0.503218 23.9737 0.47034 27.5448 0.503153C27.4603 0.533203 27.6281 0.459434 27.6281 0.503143C27.6281 2.49377 27.6171 12.0586 27.6171 14.0547ZM2.51555 14.0547C2.51555 16.0617 2.51555 23.5703 2.51555 25.5774C6.18508 25.6321 21.9241 25.5883 25.5991 25.5774C25.5773 21.6946 25.5937 6.4094 25.5937 2.52659C21.9296 2.48284 6.1632 2.52112 2.49914 2.52659C2.56477 4.41878 2.51555 12.168 2.51555 14.0547Z"/>-->
<!--                    </g>-->
<!--                    <defs>-->
<!--                        <clipPath id="clip0_3403_1801">-->
<!--                            <rect width="28" height="28" fill="white"/>-->
<!--                        </clipPath>-->
<!--                    </defs>-->
<!--                </svg>-->
<!--            </a>-->
<!--            <a href="https://t.me/Coloritfasad" class="social_link telegram" target="_blank">-->
<!--                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">-->
<!--                    <g clip-path="url(#clip0_3403_1806)">-->
<!--                        <path-->
<!--                            d="M27.6171 14.0547C27.6171 15.9578 27.5679 25.6922 27.6171 27.5953C23.9367 27.6008 4.17803 27.6664 0.497559 27.5953C0.497559 23.6742 0.497564 4.42431 0.497564 0.503218C4.06866 0.503218 23.9737 0.47034 27.5448 0.503153C27.4603 0.533203 27.6281 0.459434 27.6281 0.503143C27.6281 2.49377 27.6171 12.0586 27.6171 14.0547ZM2.51555 14.0547C2.51555 16.0617 2.51555 23.5703 2.51555 25.5774C6.18508 25.6321 21.9241 25.5883 25.5991 25.5774C25.5773 21.6946 25.5937 6.4094 25.5937 2.52659C21.9296 2.48284 6.1632 2.52112 2.49914 2.52659C2.56477 4.41878 2.51555 12.168 2.51555 14.0547Z"/>-->
<!--                        <path-->
<!--                            d="M16.6667 12.25L13.1111 15.75L18.4444 21L22 7L6 13.125L9.55556 14.875L11.3333 20.125L14 16.625"-->
<!--                            stroke="#141C20" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"-->
<!--                            fill="none"/>-->
<!--                    </g>-->
<!--                    <defs>-->
<!--                        <clipPath id="clip0_3403_1806">-->
<!--                            <rect width="28" height="28" fill="white"/>-->
<!--                        </clipPath>-->
<!--                    </defs>-->
<!--                </svg>-->
<!---->
<!--            </a>-->


        </div>
        <div class="header__callback">
            <p class="header__phone">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/includes/phone.php"
                    )
                ); ?>



            </p>
            <p class="header__callback_form">
                <a href="#!" class="calback_form-link">Заказать звонок</a>
            </p>
        </div>
    </div>
</header>
<? if ($APPLICATION->GetCurPage() == "/") : ?>
    <section class="anonce">
        <div class="container">
            <div class="anonce__inner row">
                <div class="col-4 anonce__item anonce__item_first">
                    <?
                    //                $GLOBALS['sectionsFilter'] = ["SECTION_ID"=>3];
                    //                $sectionsFilter= ["ID"=>3];
                    $APPLICATION->IncludeComponent(
                        "maxtm1:catalog.section.list",
                        "section_pict",
                        array(
                            "ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
                            "ADD_SECTIONS_CHAIN" => "Y",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "COUNT_ELEMENTS" => "N",
                            "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
                            "FILTER_NAME" => "sectionsFilter",
                            "HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
                            "IBLOCK_ID" => "1",
                            "IBLOCK_TYPE" => "catalog",
                            "SECTION_CODE" => "asady-dlya-kukhonnykh-moduley",
                            "SECTION_FIELDS" => array(
                                0 => "PICTURE",
                                1 => "",
                            ),
                            "SECTION_ID" => '3',
                            "SECTION_URL" => "",
                            "SECTION_USER_FIELDS" => array("", ""),
                            "SHOW_PARENT_NAME" => "Y",
                            "TOP_DEPTH" => "2",
                            "VIEW_MODE" => "LINE"
                        )
                    ); ?>
                </div>
                <div class="col-4 anonce__item anonce__item_main">
                    <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"fasad_sections", 
	array(
		"ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
		"ADD_SECTIONS_CHAIN" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "N",
		"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
		"FILTER_NAME" => "sectionsFilter",
		"HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "catalog",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array(
			0 => "ID",
			1 => "CODE",
			2 => "XML_ID",
			3 => "NAME",
			4 => "SORT",
			5 => "DESCRIPTION",
			6 => "PICTURE",
			7 => "DETAIL_PICTURE",
			8 => "IBLOCK_TYPE_ID",
			9 => "IBLOCK_ID",
			10 => "IBLOCK_CODE",
			11 => "IBLOCK_EXTERNAL_ID",
			12 => "DATE_CREATE",
			13 => "CREATED_BY",
			14 => "TIMESTAMP_X",
			15 => "MODIFIED_BY",
			16 => "",
		),
		"SECTION_ID" => "3",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "3",
		"VIEW_MODE" => "LINE",
		"COMPONENT_TEMPLATE" => "fasad_sections"
	),
	false
);?>


<!--                    <ul class="row anonce__categories_items-top">-->
<!--                        <li class="col-4 category__item">-->
<!--                            <div class="category__item_title ">Название категории</div>-->
<!--                            <img src="#!" alt="name" class="category__item_pict">-->
<!--                        </li>-->
<!--                        <li class="col-4 category__item">-->
<!--                            <div class="category__item_title ">Название категории</div>-->
<!--                            <img src="#!" alt="name" class="category__item_pict">-->
<!--                        </li>-->
<!--                        <li class="col-4 category__item">-->
<!--                            <div class="category__item_title ">Название категории</div>-->
<!--                            <img src="#!" alt="name" class="category__item_pict">-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                    <div class="row anonce__item_main-center">-->
<!--                        <div class="col-12">-->
<!--                            --><?// // Вставка включаемой области - http://dev.1c-bitrix.ru/user_help/settings/settings/components_2/include_areas/main_include.php
//                            $APPLICATION->IncludeComponent(
//                                "bitrix:main.include",
//                                ".default",
//                                array(
//                                    "AREA_FILE_SHOW" => "file",
//                                    "AREA_FILE_SUFFIX" => "inc",
//                                    "EDIT_TEMPLATE" => "",
//                                    "COMPONENT_TEMPLATE" => ".default",
//                                    "PATH" => "/includes/logo_big.php"
//                                ),
//                                false
//                            ); ?>
<!--                        </div>-->
<!--                    </div>-->
<!--                    <ul class="row anonce__categories_items-bottom">-->
<!--                        <li class="col-4 category__item">-->
<!--                            <div class="category__item_title ">Название категории</div>-->
<!--                            <img src="#!" alt="name" class="category__item_pict">-->
<!--                        </li>-->
<!--                        <li class="col-4 category__item">-->
<!--                            <div class="category__item_title ">Название категории</div>-->
<!--                            <img src="#!" alt="name" class="category__item_pict">-->
<!--                        </li>-->
<!--                        <li class="col-4 category__item">-->
<!--                            <div class="category__item_title ">Название категории</div>-->
<!--                            <img src="#!" alt="name" class="category__item_pict">-->
<!--                        </li>-->
<!--                    </ul>-->




                </div>

                <!--                <div class="col-4 anonce__item anonce__item_main">--><? //
                //                    $APPLICATION->IncludeComponent(
                //                        "maxtm1:catalog.section.list",
                //                        "",
                //                        array(
                //                            "ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
                //                            "ADD_SECTIONS_CHAIN" => "Y",
                //                            "CACHE_FILTER" => "N",
                //                            "CACHE_GROUPS" => "Y",
                //                            "CACHE_TIME" => "36000000",
                //                            "CACHE_TYPE" => "A",
                //                            "COUNT_ELEMENTS" => "N",
                //                            "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
                //                            "FILTER_NAME" => "sectionsFilter",
                //                            "HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
                //                            "IBLOCK_ID" => "1",
                //                            "IBLOCK_TYPE" => "catalog",
                //                            "SECTION_CODE" => "",
                //                            "SECTION_FIELDS" => array(
                //                                0 => "PICTURE",
                //                                1 => "",
                //                            ),
                //                            "SECTION_ID" => "3",
                //                            "SECTION_URL" => "",
                //                            "SECTION_USER_FIELDS" => array(
                //                                0 => "",
                //                                1 => "",
                //                            ),
                //                            "SHOW_PARENT_NAME" => "Y",
                //                            "TOP_DEPTH" => "2",
                //                            "VIEW_MODE" => "LINE",
                //                            "COMPONENT_TEMPLATE" => "section_pict"
                //                        ),
                //                        false
                //                    ); ?>
                <!--                </div>-->
                <div class="col-4 anonce__item anonce__item_second">
                    <?
                    $APPLICATION->IncludeComponent(
                        "maxtm1:catalog.section.list",
                        "section_pict",
                        array(
                            "ADDITIONAL_COUNT_ELEMENTS_FILTER" => "additionalCountFilter",
                            "ADD_SECTIONS_CHAIN" => "Y",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "CACHE_TIME" => "36000000",
                            "CACHE_TYPE" => "A",
                            "COUNT_ELEMENTS" => "N",
                            "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
                            "FILTER_NAME" => "sectionsFilter",
                            "HIDE_SECTIONS_WITH_ZERO_COUNT_ELEMENTS" => "N",
                            "IBLOCK_ID" => "1",
                            "IBLOCK_TYPE" => "catalog",
                            "SECTION_CODE" => "",
                            "SECTION_FIELDS" => array(
                                0 => "PICTURE",
                                1 => "",
                            ),
                            "SECTION_ID" => "1",
                            "SECTION_URL" => "",
                            "SECTION_USER_FIELDS" => array(
                                0 => "",
                                1 => "",
                            ),
                            "SHOW_PARENT_NAME" => "Y",
                            "TOP_DEPTH" => "2",
                            "VIEW_MODE" => "LINE",
                            "COMPONENT_TEMPLATE" => "section_pict"
                        ),
                        false
                    ); ?>
                </div>
            </div>
        </div>
    </section>

<? endif ?>





