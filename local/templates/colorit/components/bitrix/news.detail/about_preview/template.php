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
    <div class="section__pict" style="background-image: linear-gradient(90deg, rgba(255, 255, 255, 0%) 0%,  rgba(255, 255, 255, 0%) 50%, rgba(255, 255, 255, .69) 70.3%, #fff 100%), url(<?=$arResult['PREVIEW_PICTURE']['SRC']?>);"></div>
     <div class="section__content">
        <h2 class="section__title"><?= $arParams["PAGER_TITLE"] ?></h2>
        <div class="section__text"><?= $arResult['PREVIEW_TEXT'] ?></div>
         <a href="/about/" class="btn_more">
             <span class="btn_more">Подробнее</span>
         </a>
     </div>

</div>
<?php //pre($arResult)
?>
<!--<img-->
<!--        class="preview_picture"-->
<!--        border="0"-->
<!--        src="--><? //=$arResult["PREVIEW_PICTURE"]["SRC"]?><!--"-->
<!--        width="--><? //=$arResult["PREVIEW_PICTURE"]["WIDTH"]?><!--"-->
<!--        height="--><? //=$arResult["PREVIEW_PICTURE"]["HEIGHT"]?><!--"-->
<!--        alt="--><? //=$arResult["PREVIEW_PICTURE"]["ALT"]?><!--"-->
<!--        title="--><? //=$arResult["PREVIEW_PICTURE"]["TITLE"]?><!--"-->
<!--/>-->

<!--<div class="news-detail">-->
<!--	--><? //if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
<!--		<img-->
<!--			class="detail_picture"-->
<!--			border="0"-->
<!--			src="--><? //=$arResult["PREVIEW_PICTURE"]["SRC"]?><!--"-->
<!--			width="--><? //=$arResult["PREVIEW_PICTURE"]["WIDTH"]?><!--"-->
<!--			height="--><? //=$arResult["PREVIEW_PICTURE"]["HEIGHT"]?><!--"-->
<!--			alt="--><? //=$arResult["PREVIEW_PICTURE"]["ALT"]?><!--"-->
<!--			title="--><? //=$arResult["PREVIEW_PICTURE"]["TITLE"]?><!--"-->
<!--			/>-->
<!--	--><? //endif?>
<!--	--><? //if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
<!--		<span class="news-date-time">--><? //=$arResult["DISPLAY_ACTIVE_FROM"]?><!--</span>-->
<!--	--><? //endif;?>
<!--	--><? //if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
<!--		<h3>--><? //=$arResult["NAME"]?><!--</h3>-->
<!--	--><? //endif;?>
<!--	--><? //if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && ($arResult["FIELDS"]["PREVIEW_TEXT"] ?? '') !== ''):?>
<!--		<p>--><? //=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?><!--</p>-->
<!--	--><? //endif;?>
<!--	--><? //if($arResult["NAV_RESULT"]):?>
<!--		--><? //if($arParams["DISPLAY_TOP_PAGER"]):?><!----><? //=$arResult["NAV_STRING"]?><!--<br />--><? //endif;?>
<!--		--><? //echo $arResult["NAV_TEXT"];?>
<!--		--><? //if($arParams["DISPLAY_BOTTOM_PAGER"]):?><!--<br />--><? //=$arResult["NAV_STRING"]?><!----><? //endif;?>
<!--	--><? //elseif($arResult["DETAIL_TEXT"] <> ''):?>
<!--		--><? //echo $arResult["DETAIL_TEXT"];?>
<!--	--><? //else:?>
<!--		--><? //echo $arResult["PREVIEW_TEXT"];?>
<!--	--><? //endif?>
<!--	<div style="clear:both"></div>-->
<!--	<br />-->
<!--	--><? //foreach($arResult["FIELDS"] as $code=>$value):
//		if ('PREVIEW_PICTURE' == $code || 'DETAIL_PICTURE' == $code)
//		{
//			?><!----><? //=GetMessage("IBLOCK_FIELD_".$code)?><!--:&nbsp;--><? //
//			if (!empty($value) && is_array($value))
//			{
//				?><!--<img border="0" src="--><? //=$value["SRC"]?><!--" width="--><? //=$value["WIDTH"]?><!--" height="--><? //=$value["HEIGHT"]?><!--">--><? //
//			}
//		}
//		else
//		{
//			?><!----><? //=GetMessage("IBLOCK_FIELD_".$code)?><!--:&nbsp;--><? //=$value;?><!----><? //
//		}
//		?><!--<br />-->
<!--	--><? //endforeach;
//	foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
<!---->
<!--		--><? //=$arProperty["NAME"]?><!--:&nbsp;-->
<!--		--><? //if(is_array($arProperty["DISPLAY_VALUE"])):?>
<!--			--><? //=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
<!--		--><? //else:?>
<!--			--><? //=$arProperty["DISPLAY_VALUE"];?>
<!--		--><? //endif?>
<!--		<br />-->
<!--	--><? //endforeach;
//	if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
//	{
//		?>
<!--		<div class="news-detail-share">-->
<!--			<noindex>-->
<!--			--><? //
//			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
//					"HANDLERS" => $arParams["SHARE_HANDLERS"],
//					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
//					"PAGE_TITLE" => $arResult["~NAME"],
//					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
//					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
//					"HIDE" => $arParams["SHARE_HIDE"],
//				),
//				$component,
//				array("HIDE_ICONS" => "Y")
//			);
//			?>
<!--			</noindex>-->
<!--		</div>-->
<!--		--><? //
//	}
//	?>
<!--</div>-->