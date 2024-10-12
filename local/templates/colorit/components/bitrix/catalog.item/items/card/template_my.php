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

<div class="product-item sss">
	<? echo '<pre>';
//	print_r($item);
	echo '</pre>';

	?>
	<a class="product-item-image-wrapper" href="<?=$item['DETAIL_PAGE_URL']?>" title="<?=$imgTitle?>"
	   data-entity="image-wrapper">
		<span class="product-item-image-original" id="<?=$itemIds['PICT']?>">
			<img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="">
		</span>
			<? if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y')
		{
			?>
			<div class="product-item-label-ring <?=$discountPositionClass?>" id="<?=$itemIds['DSC_PERC']?>"
				<?=($price['PERCENT'] > 0 ? '' : 'style="display: none;"')?>>
				<span><?=-$price['PERCENT']?>%</span>
			</div>
			<?
		}
		if ($item['LABEL'])
		{
		?>
		<div class="product-item-label-text <?=$labelPositionClass?>" id="<?=$itemIds['STICKER_ID']?>">
			<?
			if (!empty($item['LABEL_ARRAY_VALUE']))
			{
				foreach ($item['LABEL_ARRAY_VALUE'] as $code => $value)
				{
					?>
					<div<?=(!isset($item['LABEL_PROP_MOBILE'][$code]) ? ' class="hidden-xs"' : '')?>>
						<span title="<?=$value?>"><?=$value?></span>
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


</div>