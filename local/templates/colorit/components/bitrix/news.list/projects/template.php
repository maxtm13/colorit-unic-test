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

\Bitrix\Main\UI\Extension::load('ui.fonts.opensans');

$themeClass = isset($arParams['TEMPLATE_THEME']) ? ' bx-' . $arParams['TEMPLATE_THEME'] : '';
?>

        <div class="row">
            <h1><?=$arResult['NAME']?></h1>
            <div class="news-list ">
                <? foreach ($arResult["ITEMS"] as $arItem): ?>
                    <?

                    $this->AddEditAction(
                        $arItem['ID'],
                        $arItem['EDIT_LINK'],
                        CIBlock::GetArrayByID(
                            $arItem["IBLOCK_ID"],
                            "ELEMENT_EDIT"
                        )
                    );
                    $this->AddDeleteAction(
                        $arItem['ID'],
                        $arItem['DELETE_LINK'],
                        CIBlock::GetArrayByID(
                            $arItem["IBLOCK_ID"],
                            "ELEMENT_DELETE"),
                        array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))
                    );
                    ?>

                    <div class="col-md-3">
                        <div class="news-list-item" id="<?= $this->GetEditAreaId($arItem['ID']); ?>">
                            <div class="card">
                                <? if ($arParams["DISPLAY_PICTURE"] != "N"):
                                    if ($arItem["VIDEO"] ?? null) {
                                        ?>
                                        <div class="news-list-item-embed-video embed-responsive embed-responsive-16by9">
                                            <iframe
                                                class="embed-responsive-item"
                                                src="<? echo $arItem["VIDEO"] ?>"
                                                frameborder="0"
                                                allowfullscreen=""
                                            ></iframe>
                                        </div>
                                    <?
                                    }
                                    elseif ($arItem["SOUND_CLOUD"] ?? null)
                                    {
                                    ?>
                                        <div class="news-list-item-embed-audio embed-responsive embed-responsive-16by9">
                                            <iframe
                                                class="embed-responsive-item"
                                                width="100%"
                                                scrolling="no"
                                                frameborder="no"
                                                src="https://w.soundcloud.com/player/?url=<? echo urlencode($arItem["SOUND_CLOUD"]) ?>&amp;color=ff5500&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"
                                            ></iframe>
                                        </div>
                                    <?
                                    }
                                    elseif (isset($arItem["SLIDER"]) && is_array($arItem["SLIDER"]) && count($arItem["SLIDER"]) > 1)
                                    {
                                    ?>
                                        <div class="news-list-item-embed-slider">
                                            <div class="news-list-slider-container" style="width: <?
                                            echo count($arItem["SLIDER"]) * 100 ?>%;left: 0;">
                                                <?
                                                foreach ($arItem["SLIDER"] as $file):?>
                                                    <div class="news-list-slider-slide">
                                                        <img src="<?= $file["SRC"] ?>" alt="<?= $file["DESCRIPTION"] ?>">
                                                    </div>
                                                <? endforeach ?>
                                            </div>
                                            <div class="news-list-slider-arrow-container-left">
                                                <div class="news-list-slider-arrow"><i class="fa fa-angle-left"></i></div>
                                            </div>
                                            <div class="news-list-slider-arrow-container-right">
                                                <div class="news-list-slider-arrow"><i class="fa fa-angle-right"></i></div>
                                            </div>
                                            <ul class="news-list-slider-control">
                                                <?
                                                foreach ($arItem["SLIDER"] as $i => $file):?>
                                                    <li rel="<?= ($i + 1) ?>" <?
                                                    if (!$i)
                                                        echo 'class="current"' ?>><span></span></li>
                                                <? endforeach ?>
                                            </ul>
                                        </div>
                                        <script>
                                            BX.ready(function () {
                                                new JCNewsSlider('<?=CUtil::JSEscape($this->GetEditAreaId($arItem['ID']));?>', {
                                                    imagesContainerClassName: 'news-list-slider-container',
                                                    leftArrowClassName: 'news-list-slider-arrow-container-left',
                                                    rightArrowClassName: 'news-list-slider-arrow-container-right',
                                                    controlContainerClassName: 'news-list-slider-control'
                                                });
                                            });
                                        </script>
                                    <?
                                    }
                                    else if ($arItem["SLIDER"] ?? null)
                                    {
                                    ?>
                                        <div class="news-list-item-embed-img">
                                            <? if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])) {
                                                ?>
                                                <a href="<?= $arItem["DETAIL_PAGE_URL"] ?>">
                                                    <img
                                                        class="card-img-top"
                                                        src="<?= $arItem["SLIDER"][0]["SRC"] ?>"
                                                        width="<?= $arItem["SLIDER"][0]["WIDTH"] ?>"
                                                        height="<?= $arItem["SLIDER"][0]["HEIGHT"] ?>"
                                                        alt="<?= $arItem["SLIDER"][0]["ALT"] ?>"
                                                        title="<?= $arItem["SLIDER"][0]["TITLE"] ?>"
                                                    />
                                                </a>
                                                <?
                                            } else {
                                                ?>
                                                <img
                                                    class="card-img-top"
                                                    src="<?= $arItem["SLIDER"][0]["SRC"] ?>"
                                                    width="<?= $arItem["SLIDER"][0]["WIDTH"] ?>"
                                                    height="<?= $arItem["SLIDER"][0]["HEIGHT"] ?>"
                                                    alt="<?= $arItem["SLIDER"][0]["ALT"] ?>"
                                                    title="<?= $arItem["SLIDER"][0]["TITLE"] ?>"
                                                />
                                                <?
                                            }
                                            ?>
                                        </div>
                                        <?
                                    }
                                    elseif (isset($arItem["PREVIEW_PICTURE"]) && is_array($arItem["PREVIEW_PICTURE"])) {
                                    if (!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])) {
                                        ?>
                                        <a class="item-link" href="<?= $arItem["DETAIL_PAGE_URL"] ?>" data-id="<?=$arItem['ID']?>" src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>">
                                            <p  class="box_pict">
                                                <img
                                                    class="card-img-top ddd"
                                                    src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                                    alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                                    title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                                                />
                                                <span class="pict_magnify">
                                                    <svg width="54" height="50" viewBox="0 0 54 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="21" cy="21" r="19.5" stroke="white" stroke-width="3"/>
                                                    <path d="M35.5 34L53 48.5" stroke="white" stroke-width="3"/>
                                                    <path
                                                        d="M28.4761 20.4155V23.2192H12.395V20.4155H28.4761ZM21.9341 13.5674V30.6475H18.9531V13.5674H21.9341Z"
                                                        fill="white"/>
                                                    </svg>

                                                </span>
                                            </p>

                                        </a>
                                        <?
                                    }
                                    else {
                                        ?>
                                    <img
                                        src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
                                        class="card-img-top"
                                        alt="<?= $arItem["PREVIEW_PICTURE"]["ALT"] ?>"
                                        title="<?= $arItem["PREVIEW_PICTURE"]["TITLE"] ?>"
                                    />
                                        <?
                                    }
                                    }
                                    ?>

                                <? endif; ?>

                                <div class="card-body">

                                    <? if ($arParams["DISPLAY_PREVIEW_TEXT"] != "N" && $arItem["PREVIEW_TEXT"]): ?>
                                        <p class="card-text"><? echo $arItem["PREVIEW_TEXT"]; ?></p>
                                    <? endif; ?>


                                </div>
                            </div>
                        </div>
                    </div>


                <? endforeach; ?>
            </div>
        </div>


            <?= $arResult["NAV_STRING"] ?>

