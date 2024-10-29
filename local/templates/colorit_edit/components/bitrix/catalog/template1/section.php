<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
/**
 * @global CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 * @var array $arCurSection
 */

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;



$this->setFrameMode(true);
//$this->addExternalCss("/bitrix/css/main/bootstrap.css");
if (!isset($arParams['FILTER_VIEW_MODE']) || (string)$arParams['FILTER_VIEW_MODE'] == '')
	$arParams['FILTER_VIEW_MODE'] = 'VERTICAL';
$arParams['USE_FILTER'] = (isset($arParams['USE_FILTER']) && $arParams['USE_FILTER'] == 'Y' ? 'Y' : 'N');

$isVerticalFilter = ('Y' == $arParams['USE_FILTER'] && $arParams["FILTER_VIEW_MODE"] == "VERTICAL");
$isSidebar = ($arParams["SIDEBAR_SECTION_SHOW"] == "Y" && isset($arParams["SIDEBAR_PATH"]) && !empty($arParams["SIDEBAR_PATH"]));
$isFilter = ($arParams['USE_FILTER'] == 'Y');

if ($isFilter)
{
	$arFilter = array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"ACTIVE" => "Y",
		"GLOBAL_ACTIVE" => "Y",
	);
	if (0 < intval($arResult["VARIABLES"]["SECTION_ID"]))
		$arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
	elseif ('' != $arResult["VARIABLES"]["SECTION_CODE"])
		$arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];

	$obCache = new CPHPCache();
	if ($obCache->InitCache(36000, serialize($arFilter), "/iblock/catalog"))
	{
		$arCurSection = $obCache->GetVars();
	}
	elseif ($obCache->StartDataCache())
	{
		$arCurSection = array();
		if (Loader::includeModule("iblock"))
		{
			$dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID"));

			if(defined("BX_COMP_MANAGED_CACHE"))
			{
				global $CACHE_MANAGER;
				$CACHE_MANAGER->StartTagCache("/iblock/catalog");

				if ($arCurSection = $dbRes->Fetch())
					$CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);

				$CACHE_MANAGER->EndTagCache();
			}
			else
			{
				if(!$arCurSection = $dbRes->Fetch())
					$arCurSection = array();
			}
		}
		$obCache->EndDataCache($arCurSection);
	}
	if (!isset($arCurSection))
		$arCurSection = array();
}
?>
<div class="row">
<?


if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] == 'Y')
{
	$basketAction = $arParams['COMMON_ADD_TO_BASKET_ACTION'] ?? '';
}
else
{
	$basketAction = $arParams['SECTION_ADD_TO_BASKET_ACTION'] ?? '';
}

if ($isFilter || $isSidebar): ?>
	<div class="col-md-2 col-sm-4<?=(isset($arParams['FILTER_HIDE_ON_MOBILE']) && $arParams['FILTER_HIDE_ON_MOBILE'] === 'Y' ? ' hidden-xs' : '')?>">
		<? if ($isFilter): ?>
			<div class="bx-sidebar-block">
				<?
				$APPLICATION->IncludeComponent(
					"bitrix:catalog.smart.filter",
					"catalog",
					array(
						"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
						"IBLOCK_ID" => $arParams["IBLOCK_ID"],
						"SECTION_ID" => $arCurSection['ID'],
						"FILTER_NAME" => $arParams["FILTER_NAME"],
						"PRICE_CODE" => $arParams["~PRICE_CODE"],
						"CACHE_TYPE" => $arParams["CACHE_TYPE"],
						"CACHE_TIME" => $arParams["CACHE_TIME"],
						"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
						"SAVE_IN_SESSION" => "N",
						"FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
						"XML_EXPORT" => "N",
						"SECTION_TITLE" => "NAME",
						"SECTION_DESCRIPTION" => "DESCRIPTION",
						'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
						"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
						'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
						'CURRENCY_ID' => $arParams['CURRENCY_ID'],
						"SEF_MODE" => $arParams["SEF_MODE"],
						"SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
						"SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
						"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
						"INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],

					),
					$component,
					array('HIDE_ICONS' => 'Y')
				);
				?>

			</div>
		<? endif ?>
		<? if ($isSidebar): ?>
			<div class="hidden-xs">
				<?
				$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"PATH" => $arParams["SIDEBAR_PATH"],
						"AREA_FILE_RECURSIVE" => "N",
						"EDIT_MODE" => "html",
					),
					false,
					array('HIDE_ICONS' => 'Y')
				);
				?>
			</div>
		<?endif?>
	</div>
	<?endif?>
	<div class="<?=(($isFilter || $isSidebar) ? "col-md-10 col-sm-8" : "col-xs-12")?>">
		<div class="row">

			<div class="col-xs-12">
				<?
				$sectionListParams = array(
					"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
					"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
					"CACHE_TYPE" => $arParams["CACHE_TYPE"],
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
					"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
					"TOP_DEPTH" => $arParams["SECTION_TOP_DEPTH"],
					"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
					"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
					"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
					"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
					"ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
				);
				if ($sectionListParams["COUNT_ELEMENTS"] === "Y")
				{
					$sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_ACTIVE";
					if ($arParams["HIDE_NOT_AVAILABLE"] == "Y")
					{
						$sectionListParams["COUNT_ELEMENTS_FILTER"] = "CNT_AVAILABLE";
					}
				}

							$APPLICATION->IncludeComponent(
								"bitrix:catalog.section.list",
								"no_sections",
								$sectionListParams,
								$component,
								array("HIDE_ICONS" => "Y")
							);
				unset($sectionListParams);



				$intSectionID=$APPLICATION->IncludeComponent("bitrix:catalog.section", "catalog_list", Array(
					"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],	// Тип инфоблока
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],	// Инфоблок
					"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],	// По какому полю сортируем элементы
					"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],	// Порядок сортировки элементов
					"ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],	// Поле для второй сортировки элементов
					"ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],	// Порядок второй сортировки элементов
					"PROPERTY_CODE" => (isset($arParams["LIST_PROPERTY_CODE"])?$arParams["LIST_PROPERTY_CODE"]:[]),
					"PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
					"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],	// Установить ключевые слова страницы из свойства
					"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],	// Установить описание страницы из свойства
					"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],	// Установить заголовок окна браузера из свойства
					"SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],	// Устанавливать в заголовках ответа время модификации страницы
					"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],	// Показывать элементы подразделов раздела
					"BASKET_URL" => $arParams["BASKET_URL"],	// URL, ведущий на страницу с корзиной покупателя
					"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],	// Название переменной, в которой передается действие
					"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],	// Название переменной, в которой передается код товара для покупки
					"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],	// Название переменной, в которой передается код группы
					"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],	// Название переменной, в которой передается количество товара
					"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],	// Название переменной, в которой передаются характеристики товара
					"FILTER_NAME" => $arParams["FILTER_NAME"],	// Имя массива со значениями фильтра для фильтрации элементов
					"CACHE_TYPE" => $arParams["CACHE_TYPE"],	// Тип кеширования
					"CACHE_TIME" => $arParams["CACHE_TIME"],	// Время кеширования (сек.)
					"CACHE_FILTER" => $arParams["CACHE_FILTER"],	// Кешировать при установленном фильтре
					"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],	// Учитывать права доступа
					"SET_TITLE" => $arParams["SET_TITLE"],	// Устанавливать заголовок страницы
					"MESSAGE_404" => $arParams["~MESSAGE_404"],	// Сообщение для показа (по умолчанию из компонента)
					"SET_STATUS_404" => $arParams["SET_STATUS_404"],	// Устанавливать статус 404
					"SHOW_404" => $arParams["SHOW_404"],	// Показ специальной страницы
					"FILE_404" => $arParams["FILE_404"],
					"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],	// Разрешить сравнение товаров
					"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],	// Количество элементов на странице
					"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],	// Количество элементов выводимых в одной строке таблицы
					"PRICE_CODE" => $arParams["~PRICE_CODE"],	// Тип цены
					"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],	// Использовать вывод цен с диапазонами
					"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],	// Выводить цены для количества
					"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],	// Включать НДС в цену
					"USE_PRODUCT_QUANTITY" => $arParams["USE_PRODUCT_QUANTITY"],	// Разрешить указание количества товара
					"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"])?$arParams["ADD_PROPERTIES_TO_BASKET"]:""),	// Добавлять в корзину свойства товаров и предложений
					"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"])?$arParams["PARTIAL_PRODUCT_PROPERTIES"]:""),	// Разрешить добавлять в корзину товары, у которых заполнены не все характеристики
					"PRODUCT_PROPERTIES" => (isset($arParams["PRODUCT_PROPERTIES"])?$arParams["PRODUCT_PROPERTIES"]:[]),
					"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],	// Выводить над списком
					"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],	// Выводить под списком
					"PAGER_TITLE" => $arParams["PAGER_TITLE"],	// Название категорий
					"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],	// Выводить всегда
					"PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],	// Шаблон постраничной навигации
					"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],	// Использовать обратную навигацию
					"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],	// Время кеширования страниц для обратной навигации
					"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],	// Показывать ссылку "Все"
					"PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],	// Включить обработку ссылок
					"PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
					"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
					"LAZY_LOAD" => $arParams["LAZY_LOAD"],	// Показать кнопку ленивой загрузки Lazy Load
					"MESS_BTN_LAZY_LOAD" => $arParams["~MESS_BTN_LAZY_LOAD"],	// Текст кнопки "Показать ещё"
					"LOAD_ON_SCROLL" => $arParams["LOAD_ON_SCROLL"],	// Подгружать товары при прокрутке до конца
					"OFFERS_CART_PROPERTIES" => (isset($arParams["OFFERS_CART_PROPERTIES"])?$arParams["OFFERS_CART_PROPERTIES"]:[]),
					"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
					"OFFERS_PROPERTY_CODE" => (isset($arParams["LIST_OFFERS_PROPERTY_CODE"])?$arParams["LIST_OFFERS_PROPERTY_CODE"]:[]),
					"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
					"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
					"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
					"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
					"OFFERS_LIMIT" => (isset($arParams["LIST_OFFERS_LIMIT"])?$arParams["LIST_OFFERS_LIMIT"]:0),	// Максимальное количество предложений для показа (0 - все)
					"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],	// ID раздела
					"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],	// Код раздела
					"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],	// URL, ведущий на страницу с содержимым раздела
					"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],	// URL, ведущий на страницу с содержимым элемента раздела
					"USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],	// Использовать основной раздел для показа элемента
					"CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
					"CURRENCY_ID" => $arParams["CURRENCY_ID"],
					"HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
					"HIDE_NOT_AVAILABLE_OFFERS" => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],
					"LABEL_PROP" => $arParams["LABEL_PROP"],
					"LABEL_PROP_MOBILE" => $arParams["LABEL_PROP_MOBILE"],
					"LABEL_PROP_POSITION" => $arParams["LABEL_PROP_POSITION"]??"",
					"ADD_PICT_PROP" => $arParams["ADD_PICT_PROP"],
					"PRODUCT_DISPLAY_MODE" => $arParams["PRODUCT_DISPLAY_MODE"],
					"PRODUCT_BLOCKS_ORDER" => $arParams["LIST_PRODUCT_BLOCKS_ORDER"],	// Порядок отображения блоков товара
					"PRODUCT_ROW_VARIANTS" => $arParams["LIST_PRODUCT_ROW_VARIANTS"],	// Вариант отображения товаров
					"ENLARGE_PRODUCT" => $arParams["LIST_ENLARGE_PRODUCT"],	// Выделять товары в списке
					"ENLARGE_PROP" => isset($arParams["LIST_ENLARGE_PROP"])?$arParams["LIST_ENLARGE_PROP"]:"",
					"SHOW_SLIDER" => $arParams["LIST_SHOW_SLIDER"],	// Показывать слайдер для товаров
					"SLIDER_INTERVAL" => isset($arParams["LIST_SLIDER_INTERVAL"])?$arParams["LIST_SLIDER_INTERVAL"]:"",
					"SLIDER_PROGRESS" => isset($arParams["LIST_SLIDER_PROGRESS"])?$arParams["LIST_SLIDER_PROGRESS"]:"",
					"OFFER_ADD_PICT_PROP" => $arParams["OFFER_ADD_PICT_PROP"],
					"OFFER_TREE_PROPS" => (isset($arParams["OFFER_TREE_PROPS"])?$arParams["OFFER_TREE_PROPS"]:[]),
					"PRODUCT_SUBSCRIPTION" => $arParams["PRODUCT_SUBSCRIPTION"],
					"SHOW_DISCOUNT_PERCENT" => $arParams["SHOW_DISCOUNT_PERCENT"],
					"DISCOUNT_PERCENT_POSITION" => $arParams["DISCOUNT_PERCENT_POSITION"],
					"SHOW_OLD_PRICE" => $arParams["SHOW_OLD_PRICE"],
					"SHOW_MAX_QUANTITY" => $arParams["SHOW_MAX_QUANTITY"],
					"MESS_SHOW_MAX_QUANTITY" => (isset($arParams["~MESS_SHOW_MAX_QUANTITY"])?$arParams["~MESS_SHOW_MAX_QUANTITY"]:""),
					"RELATIVE_QUANTITY_FACTOR" => (isset($arParams["RELATIVE_QUANTITY_FACTOR"])?$arParams["RELATIVE_QUANTITY_FACTOR"]:""),
					"MESS_RELATIVE_QUANTITY_MANY" => (isset($arParams["~MESS_RELATIVE_QUANTITY_MANY"])?$arParams["~MESS_RELATIVE_QUANTITY_MANY"]:""),
					"MESS_RELATIVE_QUANTITY_FEW" => (isset($arParams["~MESS_RELATIVE_QUANTITY_FEW"])?$arParams["~MESS_RELATIVE_QUANTITY_FEW"]:""),
					"MESS_BTN_BUY" => (isset($arParams["~MESS_BTN_BUY"])?$arParams["~MESS_BTN_BUY"]:""),	// Текст кнопки "Купить"
					"MESS_BTN_ADD_TO_BASKET" => (isset($arParams["~MESS_BTN_ADD_TO_BASKET"])?$arParams["~MESS_BTN_ADD_TO_BASKET"]:""),	// Текст кнопки "Добавить в корзину"
					"MESS_BTN_SUBSCRIBE" => (isset($arParams["~MESS_BTN_SUBSCRIBE"])?$arParams["~MESS_BTN_SUBSCRIBE"]:""),	// Текст кнопки "Уведомить о поступлении"
					"MESS_BTN_DETAIL" => (isset($arParams["~MESS_BTN_DETAIL"])?$arParams["~MESS_BTN_DETAIL"]:""),	// Текст кнопки "Подробнее"
					"MESS_NOT_AVAILABLE" => $arParams["~MESS_NOT_AVAILABLE"]??"",	// Сообщение об отсутствии товара
					"MESS_NOT_AVAILABLE_SERVICE" => $arParams["~MESS_NOT_AVAILABLE_SERVICE"]??"",	// Сообщение о недоступности услуги
					"MESS_BTN_COMPARE" => (isset($arParams["~MESS_BTN_COMPARE"])?$arParams["~MESS_BTN_COMPARE"]:""),
					"USE_ENHANCED_ECOMMERCE" => (isset($arParams["USE_ENHANCED_ECOMMERCE"])?$arParams["USE_ENHANCED_ECOMMERCE"]:""),	// Отправлять данные электронной торговли в Google и Яндекс
					"DATA_LAYER_NAME" => (isset($arParams["DATA_LAYER_NAME"])?$arParams["DATA_LAYER_NAME"]:""),
					"BRAND_PROPERTY" => (isset($arParams["BRAND_PROPERTY"])?$arParams["BRAND_PROPERTY"]:""),
					"TEMPLATE_THEME" => (isset($arParams["TEMPLATE_THEME"])?$arParams["TEMPLATE_THEME"]:""),	// Цветовая тема
					"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
					"ADD_TO_BASKET_ACTION" => $basketAction,
					"SHOW_CLOSE_POPUP" => isset($arParams["COMMON_SHOW_CLOSE_POPUP"])?$arParams["COMMON_SHOW_CLOSE_POPUP"]:"",
					"COMPARE_PATH" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["compare"],
					"COMPARE_NAME" => $arParams["COMPARE_NAME"],
					"USE_COMPARE_LIST" => "Y",
					"BACKGROUND_IMAGE" => (isset($arParams["SECTION_BACKGROUND_IMAGE"])?$arParams["SECTION_BACKGROUND_IMAGE"]:""),	// Установить фоновую картинку для шаблона из свойства
					"COMPATIBLE_MODE" => (isset($arParams["COMPATIBLE_MODE"])?$arParams["COMPATIBLE_MODE"]:""),	// Включить режим совместимости
					"DISABLE_INIT_JS_IN_COMPONENT" => (isset($arParams["DISABLE_INIT_JS_IN_COMPONENT"])?$arParams["DISABLE_INIT_JS_IN_COMPONENT"]:""),	// Не подключать js-библиотеки в компоненте
				),
					false
				);
				?>
			</div>

		</div>


	</div>
	<div class="section__decription row">
		<div class="col-lg-8">
			<?
			if(!CModule::IncludeModule("iblock")) die();
			$sectionID = $arResult['VARIABLES']['SECTION_ID'];

			$res = CIBlockSection::GetByID($sectionID);
			if($ar_res = $res->GetNext())
				$sectionDescr=$ar_res['DESCRIPTION'];
			echo $sectionDescr;
			?>
		</div>
	</div>

</div>
