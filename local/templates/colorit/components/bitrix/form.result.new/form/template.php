<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//if ($arResult["isFormErrors"] == "Y"):?><!----><?php //=$arResult["FORM_ERRORS_TEXT"];?><!----><?//endif;?>
<?= $arResult["FORM_NOTE"]?>
<?= $arResult["FORM_HEADER"] ?>



	<h3><?=$arResult["FORM_TITLE"]?></h3>
	<p><?=$arResult["FORM_DESCRIPTION"]?></p>



<? if ($arResult["isFormNote"] === "Y"): ?>
	Спасибо, ваша заявка принята!
<? else: ?>
	<?= $arResult["FORM_HEADER"] ?>
	<input type="hidden" name="web_form_submit" value="Y">
	<? if ($arResult["isFormErrors"] === "Y"): ?>
		<div class="errors">
			<?=$arResult["FORM_ERRORS_TEXT"]?>
		</div>
	<? endif; ?>

	<?=$arResult['funcGetInputHtml']($arResult["QUESTIONS"]['name_customer'], $arResult['arrVALUES'])?>
<!--	<input type="text" name="form_--><?php //=$arResult["QUESTIONS"]['name_customer']['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arResult["QUESTIONS"]['name_customer']['STRUCTURE'][0]['ID'] ?><!--" id="name_customer" placeholder="--><?php //= $arResult["QUESTIONS"]['name_customer']['CAPTION']?><!--">-->
<!--	--><?php //= $arResult["QUESTIONS"]['name_customer']['CAPTION']?>
<!--	--><?php //= ($arResult["QUESTIONS"]['name_customer']['REQUIRED'] === 'Y' ? ' *' : '')?><!--:-->
<!--	--><?php //= $arResult["QUESTIONS"]['name_customer']['HTML_CODE']?>
	<br>
	<?=$arResult['funcGetInputHtml']($arResult["QUESTIONS"]['phone_customer'], $arResult['arrVALUES'])?>

<!--	<input type="text" name="phone_customer" id="phone_customer" placeholder="--><?php //= $arResult["QUESTIONS"]['phone_customer']['CAPTION']?><!--">-->

<!--	--><?php //=$arResult["QUESTIONS"]['phone_customer']['CAPTION']?>
<!--	--><?php //=($arResult["QUESTIONS"]['phone_customer']['REQUIRED'] === 'Y' ? ' *' : '')?><!--:-->
<!--	--><?php //=$arResult["QUESTIONS"]['phone_customer']['HTML_CODE']?>
	<br>
<!--	--><?php //=//$arResult["QUESTIONS"]['policy_c']['CAPTION'];?>

	<?=$arResult['funcGetInputHtml']($arResult["QUESTIONS"]['policy_c'], $arResult['arrVALUES'])?>

<!--	<input type="checkbox" name="policy_c" id="policy_c">-->
	<?=$arResult["QUESTIONS"]['policy_c']['CAPTION']?>
	<?=($arResult["QUESTIONS"]['policy_c']['REQUIRED'] === 'Y' ? ' *' : '')?>:
	<?=$arResult["QUESTIONS"]['policy_c']['HTML_CODE']?>
	<br>
	<input type="submit" value="Отправить">
	<?=$arResult["FORM_FOOTER"]?>
<? endif; ?>
<script>
	ajaxForm(document.getElementsByName('<?=$arResult['arForm']['SID']?>')[0], '<?=$templateFolder?>/ajax.php')
</script>

<?php
// todo Переделать форму

?>




<?//if ($arResult["isFormNote"] != "Y")
//{
//?>
<?php //=$arResult["FORM_HEADER"]?>
<!--<table>-->
<?//
//if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y")
//{
//?>
<!--	<tr>-->
<!--		<td>--><?//
//if ($arResult["isFormTitle"])
//{
//?>
<!--	<h3>--><?php //=$arResult["FORM_TITLE"]?><!--</h3>-->
<?//
//} //endif ;
//
//	if ($arResult["isFormImage"] == "Y")
//	{
//	?>
<!--	<a href="--><?php //=$arResult["FORM_IMAGE"]["URL"]?><!--" target="_blank" alt="--><?php //=GetMessage("FORM_ENLARGE")?><!--"><img src="--><?php //=$arResult["FORM_IMAGE"]["URL"]?><!--" --><?//if($arResult["FORM_IMAGE"]["WIDTH"] > 300):?><!--width="300"--><?//elseif($arResult["FORM_IMAGE"]["HEIGHT"] > 200):?><!--height="200"--><?//else:?><!----><?php //=$arResult["FORM_IMAGE"]["ATTR"]?><!----><?//endif;?><!-- hspace="3" vscape="3" border="0" /></a>-->
<!--	--><?////=$arResult["FORM_IMAGE"]["HTML_CODE"]?>
<!--	--><?//
//	} //endif
//	?>
<!---->
<!--			<p>--><?php //=$arResult["FORM_DESCRIPTION"]?><!--</p>-->
<!--		</td>-->
<!--	</tr>-->
<!--	--><?//
//} // endif
//	?>
<!--</table>-->
<!--<br />-->
<!--<table class="form-table data-table">-->
<!--	<thead>-->
<!--		<tr>-->
<!--			<th colspan="2">&nbsp;</th>-->
<!--		</tr>-->
<!--	</thead>-->
<!--	<tbody>-->
<!--	--><?//
//	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
//	{
//		if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
//		{
//			echo $arQuestion["HTML_CODE"];
//		}
//		else
//		{
//	?>
<!--		<tr>-->
<!--			<td>-->
<!--				--><?//if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
<!--				<span class="error-fld" title="--><?php //=htmlspecialcharsbx($arResult["FORM_ERRORS"][$FIELD_SID])?><!--"></span>-->
<!--				--><?//endif;?>
<!--				--><?php //=$arQuestion["CAPTION"]?><!----><?//if ($arQuestion["REQUIRED"] == "Y"):?><!----><?php //=$arResult["REQUIRED_SIGN"];?><!----><?//endif;?>
<!--				--><?php //=$arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y" ? "<br />".$arQuestion["IMAGE"]["HTML_CODE"] : ""?>
<!--			</td>-->
<!--			<td>--><?php //=$arQuestion["HTML_CODE"]?><!--</td>-->
<!--		</tr>-->
<!--	--><?//
//		}
//	} //endwhile
//	?>
<?//
//if($arResult["isUseCaptcha"] == "Y")
//{
//?>
<!--		<tr>-->
<!--			<th colspan="2"><b>--><?php //=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?><!--</b></th>-->
<!--		</tr>-->
<!--		<tr>-->
<!--			<td>&nbsp;</td>-->
<!--			<td><input type="hidden" name="captcha_sid" value="--><?php //=htmlspecialcharsbx($arResult["CAPTCHACode"]);?><!--" /><img src="/bitrix/tools/captcha.php?captcha_sid=--><?php //=htmlspecialcharsbx($arResult["CAPTCHACode"]);?><!--" width="180" height="40" /></td>-->
<!--		</tr>-->
<!--		<tr>-->
<!--			<td>--><?php //=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><!----><?php //=$arResult["REQUIRED_SIGN"];?><!--</td>-->
<!--			<td><input type="text" name="captcha_word" size="30" maxlength="50" value="" class="inputtext" /></td>-->
<!--		</tr>-->
<?//
//} // isUseCaptcha
//?>
<!--	</tbody>-->
<!--	<tfoot>-->
<!--		<tr>-->
<!--			<th colspan="2">-->
<!--				<input --><?php //=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?><!-- type="submit" name="web_form_submit" value="--><?php //=htmlspecialcharsbx(trim($arResult["arForm"]["BUTTON"]) == '' ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?><!--" />-->
<!--				--><?//if ($arResult["F_RIGHT"] >= 15):?>
<!--				&nbsp;<input type="hidden" name="web_form_apply" value="Y" /><input type="submit" name="web_form_apply" value="--><?php //=GetMessage("FORM_APPLY")?><!--" />-->
<!--				--><?//endif;?>
<!--				&nbsp;<input type="reset" value="--><?php //=GetMessage("FORM_RESET");?><!--" />-->
<!--			</th>-->
<!--		</tr>-->
<!--	</tfoot>-->
<!--</table>-->
<!--<p>-->
<?php //=$arResult["REQUIRED_SIGN"];?><!-- - --><?php //=GetMessage("FORM_REQUIRED_FIELDS")?>
<!--</p>-->
<?php //=$arResult["FORM_FOOTER"]?>
<?
//} //endif (isFormNote)
echo '<pre>';
//print_r($arResult);
echo '</pre>';
