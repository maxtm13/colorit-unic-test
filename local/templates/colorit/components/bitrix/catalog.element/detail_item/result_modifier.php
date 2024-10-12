<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();


$additionalItem = $arResult['PROPERTIES']['ADDITIONAL']['VALUE'];
if (!empty($additionalItem)) {

        foreach ($additionalItem as $item) {
            $res = CIBlockElement::GetList(
                [],
                ['ID'=> $item],
                [
                    'ID',
                    'IBLOCK_ID',
                    'CODE',
                    'IBLOCK_SECTION_ID',
                    'NAME', 'PREVIEW_PICTURE',
                    'DETAIL_PAGE_URL'
                ]
            );
            while($ob = $res->GetNext()) $arResult['ADD_ITEMS'][] = $ob;
        }
}