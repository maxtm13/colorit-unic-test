<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}
?>
<section class="section__form">
    <div class="container">
        <? $APPLICATION->IncludeComponent(
	"maxtm1:form.result.new", 
	"form", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"EDIT_URL" => "",
		"IGNORE_CUSTOM_TEMPLATE" => "Y",
		"LIST_URL" => "",
		"SEF_MODE" => "N",
		"SUCCESS_URL" => "",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_SHADOW" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"USE_EXTENDED_ERRORS" => "N",
		"WEB_FORM_ID" => "2",
		"COMPONENT_TEMPLATE" => "form",
		"VARIABLE_ALIASES" => array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID",
		)
	),
	false
); ?>
    </div>
</section>

<footer class="footer">
    <section class="footer__top ">
        <div class="container">
            <div class="row">

                <div class="col-sm-4">
                    <div class="footer__first_section">
                        <div class="footer__logo">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "inc",
                                    "EDIT_TEMPLATE" => "",
                                    "PATH" => "/includes/footer_logo.php"
                                )
                            ); ?>
                        </div>
                        <div class="section_wrapper">
                            <div class="section_menu">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:menu",
                                    "main_menu",
                                    array(
                                        "IS_SEF" => "Y",
                                        "SEF_BASE_URL" => "/catalog/",
                                        "SECTION_PAGE_URL" => "#SECTION_CODE#/",
                                        "DETAIL_PAGE_URL" => "#SECTION_CODE#/#ELEMENT_CODE#/",
                                        "IBLOCK_TYPE" => "catalog",
                                        "IBLOCK_ID" => "1",
                                        "DEPTH_LEVEL" => "1",
                                        "CACHE_TYPE" => "N",
                                        "CACHE_TIME" => "3600",
                                        "COMPONENT_TEMPLATE" => "main_menu",
                                        "ROOT_MENU_TYPE" => "footer1",
                                        "MENU_CACHE_TYPE" => "N",
                                        "MENU_CACHE_TIME" => "3600",
                                        "MENU_CACHE_USE_GROUPS" => "Y",
                                        "MENU_CACHE_GET_VARS" => array(),
                                        "MAX_LEVEL" => "1",
                                        "CHILD_MENU_TYPE" => "left",
                                        "USE_EXT" => "Y",
                                        "DELAY" => "N",
                                        "ALLOW_MULTI_SELECT" => "N"
                                    ),
                                    false
                                ); ?>
                            </div>
                            <div class="section_search">
                                <? $APPLICATION->IncludeComponent(
                                    "bitrix:search.title",
                                    "visual",
                                    array(
                                        "CATEGORY_0" => array("no"),
                                        "CATEGORY_0_TITLE" => "",
                                        "CHECK_DATES" => "N",
                                        "CONTAINER_ID" => "footer__title-search",
                                        "INPUT_ID" => "footer__title-search-input",
                                        "NUM_CATEGORIES" => "1",
                                        "ORDER" => "date",
                                        "PAGE" => "#SITE_DIR#search/index.php",
                                        "SHOW_INPUT" => "Y",
                                        "SHOW_OTHERS" => "N",
                                        "TOP_COUNT" => "5",
                                        "USE_LANGUAGE_GUESS" => "Y"
                                    )
                                ); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer__second_section col-sm-2">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "main_menu",
                        array(
                            "IS_SEF" => "Y",
                            "SEF_BASE_URL" => "/catalog/",
                            "SECTION_PAGE_URL" => "#SECTION_CODE#/",
                            "DETAIL_PAGE_URL" => "#SECTION_CODE#/#ELEMENT_CODE#/",
                            "IBLOCK_TYPE" => "catalog",
                            "IBLOCK_ID" => "1",
                            "DEPTH_LEVEL" => "1",
                            "CACHE_TYPE" => "N",
                            "CACHE_TIME" => "3600",
                            "COMPONENT_TEMPLATE" => "main_menu",
                            "ROOT_MENU_TYPE" => "footer2",
                            "MENU_CACHE_TYPE" => "N",
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => array(),
                            "MAX_LEVEL" => "1",
                            "CHILD_MENU_TYPE" => "left",
                            "USE_EXT" => "N",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N"
                        ),
                        false
                    ); ?>
                </div>
                <div class="footer__third_section col-sm-2">
                    <div class="footer__social_box">
                        <div class="footer__social_box_title">Мы в соцсетях</div>
                        <div class="footer__social_box_link">
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
                        </div>

                    </div>
                    <div class="footer__phone">
                        <a href="<?=preg_replace('/[^0-9]/', '',$phone)  ?>" ><?=$phone ?></a>
                    </div>
                    <div class="footer__address">
                        <?=$address?>
                    </div>


                </div>
                <div class="footer__fourth_section col-sm-4">
                    <div class="subscribe__box">
                        <?$APPLICATION->IncludeComponent(
	"maxtm1:newsletter.subscription", 
	".default", 
	array(
		"BUTTON" => "Подписаться",
		"POLICY" => "/policy/",
		"SUBTITLE" => "",
		"TITLE" => "Подпишитесь на рассылку",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
                    </div>

                </div>
            </div>
        </div>

    </section>
    <section class="footer__bottom">
        <div class="container">
            <div class="footer__bottom_inner">
                <div class="copyrigth">© Все права защищены, 2024</div>
                <div class="development">
                    <a href="#!" class="development__link">Разработка — MAXITOP</a></div>
            </div>
        </div>
    </section>
</footer>


</body>
</html>

