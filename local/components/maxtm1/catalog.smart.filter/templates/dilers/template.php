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

use Bitrix\Iblock\SectionPropertyTable;

$this->setFrameMode(true);
$templateData = array(
	'TEMPLATE_CLASS' => 'bx-'.$arParams['TEMPLATE_THEME']
);

if (isset($templateData['TEMPLATE_THEME']))
{
	$this->addExternalCss($templateData['TEMPLATE_THEME']);
}
?>
<div class="smart-filter mb-4 <?=$templateData["TEMPLATE_CLASS"]?> <?if ($arParams["FILTER_VIEW_MODE"] == "HORIZONTAL") echo "smart-filter-horizontal"?>">
	<div class="smart-filter-section">



		<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smart-filter-form">

			<?foreach($arResult["HIDDEN"] as $arItem):?>
				<input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
			<?endforeach;?>

			<div class="row">
				<?foreach($arResult["ITEMS"] as $key=>$arItem)//prices
				{
					$key = $arItem["ENCODED_ID"];
					if(isset($arItem["PRICE"])):
						if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
							continue;

						$precision = 0;
						$step_num = 4;
						$step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / $step_num;
						$prices = array();
						if (Bitrix\Main\Loader::includeModule("currency"))
						{
							for ($i = 0; $i < $step_num; $i++)
							{
								$prices[$i] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MIN"]["VALUE"] + $step*$i, $arItem["VALUES"]["MIN"]["CURRENCY"], false);
							}
							$prices[$step_num] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MAX"]["VALUE"], $arItem["VALUES"]["MAX"]["CURRENCY"], false);
						}
						else
						{
							$precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
							for ($i = 0; $i < $step_num; $i++)
							{
								$prices[$i] = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step*$i, $precision, ".", "");
							}
							$prices[$step_num] = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
						}
						?>

						<div class="<?if ($arParams["FILTER_VIEW_MODE"] == "HORIZONTAL"):?>col-sm-6 col-md-4<?else:?>col-12<?endif?> mb-2 smart-filter-parameters-box bx-active">
							<div class="smart-filter-parameters-box-title" onclick="smartFilter.hideFilterProps(this)" style="display: none">
								<span class="smart-filter-container-modef"></span>
<!--								<span class="smart-filter-parameters-box-title-text">--><?php //=$arItem["NAME"]?><!--</span>-->
								<span data-role="prop_angle" class="smart-filter-angle smart-filter-angle-up">
									<span  class="smart-filter-angles"></span>
								</span>
							</div>

							<div class="smart-filter-block" data-role="bx_filter_block">
								<div class="smart-filter-parameters-box-container">
									<div class="smart-filter-input-group-number">
										<div class="d-flex justify-content-between">
											<div class="form-group" style="width: calc(50% - 10px);">
												<div class="smart-filter-input-container">
													<input
														class="min-price form-control form-control-sm"
														type="number"
														name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
														id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
														value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
														size="5"
														placeholder="<?=GetMessage("CT_BCSF_FILTER_FROM")?>"
														onkeyup="smartFilter.keyup(this)"
													/>
												</div>
											</div>

											<div class="form-group" style="width: calc(50% - 10px);">
												<div class="smart-filter-input-container">
													<input
														class="max-price form-control form-control-sm"
														type="number"
														name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
														id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
														value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
														size="5"
														placeholder="<?=GetMessage("CT_BCSF_FILTER_TO")?>"
														onkeyup="smartFilter.keyup(this)"
													/>
												</div>
											</div>
										</div>

										<div class="smart-filter-slider-track-container">
											<div class="smart-filter-slider-track" id="drag_track_<?=$key?>">
												<?for($i = 0; $i <= $step_num; $i++):?>
												<div class="smart-filter-slider-ruler p<?=$i+1?>"><span><?=$prices[$i]?></span></div>
												<?endfor;?>
												<div class="smart-filter-slider-price-bar-vd" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
												<div class="smart-filter-slider-price-bar-vn" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
												<div class="smart-filter-slider-price-bar-v"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
												<div class="smart-filter-slider-range" id="drag_tracker_<?=$key?>"  style="left: 0; right: 0;">
													<a class="smart-filter-slider-handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
													<a class="smart-filter-slider-handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?

						$arJsParams = array(
							"leftSlider" => 'left_slider_'.$key,
							"rightSlider" => 'right_slider_'.$key,
							"tracker" => "drag_tracker_".$key,
							"trackerWrap" => "drag_track_".$key,
							"minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
							"maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
							"minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
							"maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
							"curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
							"curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
							"fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
							"fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
							"precision" => $precision,
							"colorUnavailableActive" => 'colorUnavailableActive_'.$key,
							"colorAvailableActive" => 'colorAvailableActive_'.$key,
							"colorAvailableInactive" => 'colorAvailableInactive_'.$key,
						);
						?>
						<script>
							BX.ready(function(){
								window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
							});
						</script>
					<?endif;
				}

				//not prices
				foreach($arResult["ITEMS"] as $key=>$arItem)
				{
					if (empty($arItem["VALUES"]) || isset($arItem["PRICE"]))
						continue;

					if (
						$arItem["DISPLAY_TYPE"] === SectionPropertyTable::NUMBERS_WITH_SLIDER
						&& ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
					)
					{
						continue;
					}
					?>

					<div class="<?if ($arParams["FILTER_VIEW_MODE"] == "HORIZONTAL"):?>col-sm-6 col-md-4<?else:?>col-lg-12<?endif?> mb-2 smart-filter-parameters-box <?if ($arItem["DISPLAY_EXPANDED"]== "Y"):?>bx-active<?endif?>">
						<div class="smart-filter-parameters-box-title" onclick="smartFilter.hideFilterProps(this)" style="display: none">
							<span class="smart-filter-container-modef"></span>

<!--							<span class="smart-filter-parameters-box-title-text">--><?php //=$arItem["NAME"]?><!--</span>-->

							<span data-role="prop_angle" class="smart-filter-angle smart-filter-angle-<?if ($arItem["DISPLAY_EXPANDED"]== "Y"):?>up<?else:?>down<?endif?>">
								<span  class="smart-filter-angles"></span>
							</span>

							<?if ($arItem["FILTER_HINT"] <> ""):?>
								<span class="smart-filter-hint">
									<span class="smart-filter-hint-icon">?</span>
									<span class="smart-filter-hint-popup">
										<span class="smart-filter-hint-popup-angle"></span>
										<span class="smart-filter-hint-popup-content">

										</span>	<?=$arItem["FILTER_HINT"]?></span>
								</span>
							<?endif?>
						</div>

						<div class="smart-filter-block" data-role="bx_filter_block">
							<div class="smart-filter-parameters-box-container">
							<?
							$arCur = current($arItem["VALUES"]);
							switch ($arItem["DISPLAY_TYPE"])
							{
								//region NUMBERS_WITH_SLIDER +
								case SectionPropertyTable::NUMBERS_WITH_SLIDER:
								?>
									<div class="smart-filter-input-group-number">
										<div class="d-flex justify-content-between">

											<div class="form-group" style="width: calc(50% - 10px);">
												<div class="smart-filter-input-container">
													<input class="min-price form-control form-control-sm"
														type="number"
														name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
														id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
														value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
														size="5"
														placeholder="<?=GetMessage("CT_BCSF_FILTER_FROM")?>"
														onkeyup="smartFilter.keyup(this)"
													/>
												</div>
											</div>

											<div class="form-group" style="width: calc(50% - 10px);">
												<div class="smart-filter-input-container">
													<input
														class="max-price form-control form-control-sm"
														type="number"
														name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
														id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
														value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
														size="5"
														placeholder="<?=GetMessage("CT_BCSF_FILTER_TO")?>"
														onkeyup="smartFilter.keyup(this)"
													/>
												</div>
											</div>

										</div>

										<div class="smart-filter-slider-track-container">
											<div class="smart-filter-slider-track" id="drag_track_<?=$key?>">
												<?
													$precision = $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0;
													$step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 4;
													$value1 = number_format($arItem["VALUES"]["MIN"]["VALUE"], $precision, ".", "");
													$value2 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step, $precision, ".", "");
													$value3 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 2, $precision, ".", "");
													$value4 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 3, $precision, ".", "");
													$value5 = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
												?>
												<div class="smart-filter-slider-ruler p1"><span><?=$value1?></span></div>
												<div class="smart-filter-slider-ruler p2"><span><?=$value2?></span></div>
												<div class="smart-filter-slider-ruler p3"><span><?=$value3?></span></div>
												<div class="smart-filter-slider-ruler p4"><span><?=$value4?></span></div>
												<div class="smart-filter-slider-ruler p5"><span><?=$value5?></span></div>

												<div class="smart-filter-slider-price-bar-vd" style="left: 0;right: 0;" id="colorUnavailableActive_<?=$key?>"></div>
												<div class="smart-filter-slider-price-bar-vn" style="left: 0;right: 0;" id="colorAvailableInactive_<?=$key?>"></div>
												<div class="smart-filter-slider-price-bar-v"  style="left: 0;right: 0;" id="colorAvailableActive_<?=$key?>"></div>
												<div class="smart-filter-slider-range" 	id="drag_tracker_<?=$key?>"  style="left: 0;right: 0;">
													<a class="smart-filter-slider-handle left"  style="left:0;" href="javascript:void(0)" id="left_slider_<?=$key?>"></a>
													<a class="smart-filter-slider-handle right" style="right:0;" href="javascript:void(0)" id="right_slider_<?=$key?>"></a>
												</div>
											</div>
										</div>
									</div>

									<?
										$arJsParams = array(
										"leftSlider" => 'left_slider_'.$key,
										"rightSlider" => 'right_slider_'.$key,
										"tracker" => "drag_tracker_".$key,
										"trackerWrap" => "drag_track_".$key,
										"minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
										"maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
										"minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
										"maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
										"curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
										"curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
										"fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"] ,
										"fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
										"precision" => $arItem["DECIMALS"]? $arItem["DECIMALS"]: 0,
										"colorUnavailableActive" => 'colorUnavailableActive_'.$key,
										"colorAvailableActive" => 'colorAvailableActive_'.$key,
										"colorAvailableInactive" => 'colorAvailableInactive_'.$key,
									);
									?>
										<script>
											BX.ready(function(){
												window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
											});
										</script>
									<?

								break;

								//endregion

								//region NUMBERS +
								case SectionPropertyTable::NUMBERS:
								?>
									<div class="smart-filter-input-group-number">
										<div class="d-flex justify-content-between">
											<div class="form-group" style="width: calc(50% - 10px);">
												<div class="smart-filter-input-container">
													<input
														class="min-price form-control form-control-sm"
														type="number"
														name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>"
														id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"
														value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>"
														size="5"
														placeholder="<?=GetMessage("CT_BCSF_FILTER_FROM")?>"
														onkeyup="smartFilter.keyup(this)"
														/>
												</div>
											</div>

											<div class="form-group" style="width: calc(50% - 10px);">
											<div class="smart-filter-input-container">
												<input
													class="max-price form-control form-control-sm"
													type="number"
													name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>"
													id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"
													value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>"
													size="5"
													placeholder="<?=GetMessage("CT_BCSF_FILTER_TO")?>"
													onkeyup="smartFilter.keyup(this)"
													/>
											</div>
										</div>
										</div>
									</div>
								<?
								break;
								//endregion

								//region CHECKBOXES_WITH_PICTURES +
								case SectionPropertyTable::CHECKBOXES_WITH_PICTURES:
								?>
									<div class="smart-filter-input-group-checkbox-pictures">
										<?foreach ($arItem["VALUES"] as $val => $ar):?>
											<input
												style="display: none"
												type="checkbox"
												name="<?=$ar["CONTROL_NAME"]?>"
												id="<?=$ar["CONTROL_ID"]?>"
												value="<?=$ar["HTML_VALUE"]?>"
												<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
											/>
											<?
												$class = "";
												if ($ar["CHECKED"])
													$class.= " bx-active";
												if ($ar["DISABLED"])
													$class.= " disabled";
											?>
											<label for="<?=$ar["CONTROL_ID"]?>"
													data-role="label_<?=$ar["CONTROL_ID"]?>"
													class="smart-filter-checkbox-label<?=$class?>"
													onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'bx-active');">
												<span class="smart-filter-checkbox-btn bx-color-sl">
													<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
														<span class="smart-filter-checkbox-btn-image" style="background-image: url('<?=$ar["FILE"]["SRC"]?>');"></span>
													<?endif?>
												</span>
											</label>
										<?endforeach?>
										<div style="clear: both;"></div>
									</div>
								<?
								break;
								//endregion

								//region CHECKBOXES_WITH_PICTURES_AND_LABELS +
								case SectionPropertyTable::CHECKBOXES_WITH_PICTURES_AND_LABELS:
								?>
									<div class="smart-filter-input-group-checkbox-pictures-text">
										<?foreach ($arItem["VALUES"] as $val => $ar):?>
										<input
											style="display: none"
											type="checkbox"
											name="<?=$ar["CONTROL_NAME"]?>"
											id="<?=$ar["CONTROL_ID"]?>"
											value="<?=$ar["HTML_VALUE"]?>"
											<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
										/>
										<?
											$class = "";
											if ($ar["CHECKED"])
												$class.= " bx-active";
											if ($ar["DISABLED"])
												$class.= " disabled";
										?>
										<label for="<?=$ar["CONTROL_ID"]?>"
												data-role="label_<?=$ar["CONTROL_ID"]?>"
												class="smart-filter-checkbox-label<?=$class?>"
												onclick="smartFilter.keyup(BX('<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')); BX.toggleClass(this, 'bx-active');">
											<span class="smart-filter-checkbox-btn">
												<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
													<span class="smart-filter-checkbox-btn-image" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
												<?endif?>
											</span>
											<span class="smart-filter-checkbox-text" title="<?=$ar["VALUE"];?>">
												<?=$ar["VALUE"];
												if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
													?> (<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
												endif;?>
											</span>
										</label>
									<?endforeach?>
									</div>
								<?
								break;
								//endregion

								//region DROPDOWN +
								case SectionPropertyTable::DROPDOWN:
								?>
									<? $checkedItemExist = false; ?>
									<div class="smart-filter-input-group-dropdown">
										<div class="smart-filter-dropdown-block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
											<div class="smart-filter-dropdown-text" data-role="currentOption">
												<?foreach ($arItem["VALUES"] as $val => $ar)
												{
													if ($ar["CHECKED"])
													{
														echo $ar["VALUE"];
														$checkedItemExist = true;
													}
												}
												if (!$checkedItemExist)
												{
													echo GetMessage("CT_BCSF_FILTER_ALL");
												}
												?>
											</div>
											<div class="smart-filter-dropdown-arrow"></div>
											<input
												style="display: none"
												type="radio"
												name="<?=$arCur["CONTROL_NAME_ALT"]?>"
												id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
												value=""
											/>
											<?foreach ($arItem["VALUES"] as $val => $ar):?>
												<input
													style="display: none"
													type="radio"
													name="<?=$ar["CONTROL_NAME_ALT"]?>"
													id="<?=$ar["CONTROL_ID"]?>"
													value="<? echo $ar["HTML_VALUE_ALT"] ?>"
													<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
												/>
											<?endforeach?>

											<div class="smart-filter-dropdown-popup" data-role="dropdownContent" style="display: none;">
												<ul>
													<li>
														<label for="<?="all_".$arCur["CONTROL_ID"]?>"
																class="smart-filter-dropdown-label"
																data-role="label_<?="all_".$arCur["CONTROL_ID"]?>"
																onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
															<?=GetMessage("CT_BCSF_FILTER_ALL"); ?>
														</label>
													</li>
													<?foreach ($arItem["VALUES"] as $val => $ar):
														$class = "";
														if ($ar["CHECKED"])
															$class.= " selected";
														if ($ar["DISABLED"])
															$class.= " disabled";
													?>
														<li>
															<label for="<?=$ar["CONTROL_ID"]?>"
																	class="smart-filter-dropdown-label<?=$class?>"
																	data-role="label_<?=$ar["CONTROL_ID"]?>"
																	onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')">
																<?=$ar["VALUE"]?>
															</label>
														</li>
													<?endforeach?>
												</ul>
											</div>
										</div>
									</div>
								<?
								break;
								//endregion

								//region DROPDOWN_WITH_PICTURES_AND_LABELS
								case SectionPropertyTable::DROPDOWN_WITH_PICTURES_AND_LABELS:
									?>
										<div class="smart-filter-input-group-dropdown">
											<div class="smart-filter-dropdown-block" onclick="smartFilter.showDropDownPopup(this, '<?=CUtil::JSEscape($key)?>')">
												<div class="smart-filter-input-group-dropdown-flex" data-role="currentOption">
													<?
													$checkedItemExist = false;
													foreach ($arItem["VALUES"] as $val => $ar):
														if ($ar["CHECKED"])
														{
														?>
															<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
																<span class="smart-filter-checkbox-btn-image" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
															<?endif?>
															<span class="smart-filter-dropdown-text"><?=$ar["VALUE"]?></span>
														<?
															$checkedItemExist = true;
														}
													endforeach;
													if (!$checkedItemExist)
													{
														?>
															<span class="smart-filter-checkbox-btn-image all"></span>
															<span class="smart-filter-dropdown-text"><?=GetMessage("CT_BCSF_FILTER_ALL");?></span>
														<?
													}
													?>
												</div>

												<div class="smart-filter-dropdown-arrow"></div>

												<input
													style="display: none"
													type="radio"
													name="<?=$arCur["CONTROL_NAME_ALT"]?>"
													id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
													value=""
												/>
												<?foreach ($arItem["VALUES"] as $val => $ar):?>
													<input
														style="display: none"
														type="radio"
														name="<?=$ar["CONTROL_NAME_ALT"]?>"
														id="<?=$ar["CONTROL_ID"]?>"
														value="<?=$ar["HTML_VALUE_ALT"]?>"
														<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
													/>
												<?endforeach?>

												<div class="smart-filter-dropdown-popup" data-role="dropdownContent" style="display: none">
													<ul>
														<li style="border-bottom: 1px solid #e5e5e5;padding-bottom: 5px;margin-bottom: 5px;">
															<label for="<?="all_".$arCur["CONTROL_ID"]?>"
																	class="smart-filter-param-label"
																	data-role="label_<?="all_".$arCur["CONTROL_ID"]?>"
																	onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape("all_".$arCur["CONTROL_ID"])?>')">
																<span class="smart-filter-checkbox-btn-image all"></span>
																<span class="smart-filter-dropdown-text"><?=GetMessage("CT_BCSF_FILTER_ALL"); ?></span>
															</label>
														</li>
													<?
													foreach ($arItem["VALUES"] as $val => $ar):
														$class = "";
														if ($ar["CHECKED"])
															$class.= " selected";
														if ($ar["DISABLED"])
															$class.= " disabled";
													?>
														<li>
															<label for="<?=$ar["CONTROL_ID"]?>"
																	data-role="label_<?=$ar["CONTROL_ID"]?>"
																	class="smart-filter-param-label<?=$class?>"
																	onclick="smartFilter.selectDropDownItem(this, '<?=CUtil::JSEscape($ar["CONTROL_ID"])?>')">
																<?if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
																	<span class="smart-filter-checkbox-btn-image" style="background-image:url('<?=$ar["FILE"]["SRC"]?>');"></span>
																<?endif?>
																<span class="smart-filter-dropdown-text"><?=$ar["VALUE"]?></span>
															</label>
														</li>
													<?endforeach?>
													</ul>
												</div>
											</div>
										</div>
									<?
									break;
								//endregion

								//region RADIO_BUTTONS
								case SectionPropertyTable::RADIO_BUTTONS:
									?>
									<div class="col">
										<div class="radio">
											<label class="smart-filter-param-label" for="<? echo "all_".$arCur["CONTROL_ID"] ?>">
												<span class="smart-filter-input-checkbox">
													<input
														type="radio"
														value=""
														name="<? echo $arCur["CONTROL_NAME_ALT"] ?>"
														id="<? echo "all_".$arCur["CONTROL_ID"] ?>"
														onclick="smartFilter.click(this)"
													/>
													<span class="smart-filter-param-text"><? echo GetMessage("CT_BCSF_FILTER_ALL"); ?></span>
												</span>
											</label>
										</div>
										<?foreach($arItem["VALUES"] as $val => $ar):?>
											<div class="radio">
												<label data-role="label_<?=$ar["CONTROL_ID"]?>" class="smart-filter-param-label" for="<? echo $ar["CONTROL_ID"] ?>">
													<span class="smart-filter-input-checkbox <? echo $ar["DISABLED"] ? 'disabled': '' ?>">
														<input
															type="radio"
															value="<? echo $ar["HTML_VALUE_ALT"] ?>"
															name="<? echo $ar["CONTROL_NAME_ALT"] ?>"
															id="<? echo $ar["CONTROL_ID"] ?>"
															<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
															onclick="smartFilter.click(this)"
														/>
														<span class="smart-filter-param-text" title="<?=$ar["VALUE"];?>"><?=$ar["VALUE"];?><?
														if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
															?>&nbsp;(<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
														endif;?></span>
													</span>
												</label>
											</div>
										<?endforeach;?>
									</div>
									<div class="w-100"></div>
									<?
									break;

								//endregion

								//region CALENDAR
								case SectionPropertyTable::CALENDAR:
									?>
									<div class="col">
										<div class=""><div class="smart-filter-input-container smart-filter-calendar-container">
											<?$APPLICATION->IncludeComponent(
												'bitrix:main.calendar',
												'',
												array(
													'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
													'SHOW_INPUT' => 'Y',
													'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MIN"]["VALUE"]).'" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
													'INPUT_NAME' => $arItem["VALUES"]["MIN"]["CONTROL_NAME"],
													'INPUT_VALUE' => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
													'SHOW_TIME' => 'N',
													'HIDE_TIMEBAR' => 'Y',
												),
												null,
												array('HIDE_ICONS' => 'Y')
											);?>
										</div></div>
										<div class=""><div class="smart-filter-input-container smart-filter-calendar-container">
											<?$APPLICATION->IncludeComponent(
												'bitrix:main.calendar',
												'',
												array(
													'FORM_NAME' => $arResult["FILTER_NAME"]."_form",
													'SHOW_INPUT' => 'Y',
													'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="'.FormatDate("SHORT", $arItem["VALUES"]["MAX"]["VALUE"]).'" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
													'INPUT_NAME' => $arItem["VALUES"]["MAX"]["CONTROL_NAME"],
													'INPUT_VALUE' => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
													'SHOW_TIME' => 'N',
													'HIDE_TIMEBAR' => 'Y',
												),
												null,
												array('HIDE_ICONS' => 'Y')
											);?>
										</div></div>
									</div>
									<div class="w-100"></div>
									<?
									break;
								//endregion

								//region CHECKBOXES +
								default:
									?>
								<div class="smart-filter-input-group-checkbox-list">
										<?foreach($arItem["VALUES"] as $val => $ar):?>
											<div class="form-group form-check mb-1">
												<input
													type="checkbox"
													value="<? echo $ar["HTML_VALUE"] ?>"
													name="<? echo $ar["CONTROL_NAME"] ?>"
													id="<? echo $ar["CONTROL_ID"] ?>"
													class="form-check-input"
													<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
													<? echo $ar["DISABLED"] ? 'disabled': '' ?>
													onclick="smartFilter.click(this)"
												/>
												<label data-role="label_<?=$ar["CONTROL_ID"]?>" class="smart-filter-checkbox-text form-check-label" for="<? echo $ar["CONTROL_ID"] ?>">
													<?=$ar["VALUE"];
													if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
														?>&nbsp;(<span data-role="count_<?=$ar["CONTROL_ID"]?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
													endif;?>
												</label>
											</div>
										<?endforeach;?>
								</div>
							<?
								//endregion
							}
							?>
							</div>
						</div>
					</div>
				<?
				}
				?>
			</div><!--//row-->

			<div class="row">
				<div class="col smart-filter-button-box" style="display: none">
					<div class="smart-filter-block">
						<div class="smart-filter-parameters-box-container">
							<input
								class="btn btn-primary"
								type="submit"
								id="set_filter"
								name="set_filter"
								value="<?=GetMessage("CT_BCSF_SET_FILTER")?>"
							/>
							<input
								class="btn btn-link"
								type="submit"
								id="del_filter"
								name="del_filter"
								value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>"
							/>
							<div class="smart-filter-popup-result <?if ($arParams["FILTER_VIEW_MODE"] == "VERTICAL") echo $arParams["POPUP_POSITION"]?>" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?> style="display: inline-block;">
								<?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.(int)($arResult["ELEMENT_COUNT"] ?? 0).'</span>'));?>
								<span class="arrow"></span>
								<br/>
								<a href="<?echo $arResult["FILTER_URL"]?>" target=""><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>

	</div>
</div>


<div class="dilers">
	<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"dilers", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "arrFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "11",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "ADDRESS",
			1 => "PHONES",
			2 => "EMAIL",
			3 => "SITE",
			4 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "dilers",
		"TEMPLATE_THEME" => "blue",
		"MEDIA_PROPERTY" => "",
		"SLIDER_PROPERTY" => "",
		"SEARCH_PAGE" => "/search/",
		"USE_RATING" => "N",
		"USE_SHARE" => "N"
	),
	false
);?><br>
</div>

<script>
	var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);


	$('.news-item-title').click(function (e){
		let target = $( this ).closest('.news-item');
		if (target.hasClass('active')) {
			target.removeClass('active')
		} else {
			$('.news-item').removeClass('active')
			target.addClass('active')
		}
		$('.news-item').not('.active').find('.news-item-info').slideUp(300);
		$('.news-item.active').find('.news-item-info').slideDown(300);

	});

</script>