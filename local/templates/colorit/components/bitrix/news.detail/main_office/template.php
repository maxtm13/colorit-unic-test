<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

$props = $arResult['DISPLAY_PROPERTIES'];

?>
    <div class="main-office">

        <div class="row">
            <div class="col-md-4 offset-md-1">
                <h3 class="title"><?= $arResult["NAME"] ?></h3>
                <div class="address"><?= $props['ADDRESS']['VALUE'] ?></div>
                <div class="row office-contacts">
                    <div class="col-md-6">
                        <div class="phone">
                            <? if (!empty($props['PHONES']['VALUE'])) { ?>
                                <p class="contact-item"><b><?= $props['PHONES']['NAME'] ?>:</b> <br>
                                    <? foreach ($props['PHONES']['VALUE'] as $phoneValue) { ?>
                                        <span class="value">
                                    <?= $phoneValue ?>
                                </span><br>
                                    <?
                                    } ?>

                                </p>

                                <?
                            }
                            ?>
                        </div>
                        <div class="email">
                            <? if (!empty($props['EMAIL'])) { ?>
                                <p class="contact-item"><b><?= $props['EMAIL']['NAME'] ?>:</b><br>
                                    <?= $props['EMAIL']['VALUE'] ?>
                                </p>

                            <? } ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="work_hours">
                            <? if (!empty($props['WORK_HOURS'])) { ?>
                                <p class="contact-item"><b><?= $props['WORK_HOURS']['NAME'] ?>: </b> <br>
                                    <? foreach ($props['WORK_HOURS']['VALUE'] as $value) { ?>
                                        <span class="value"><?= $value ?></span><br>

                                    <? } ?>

                                </p>
                            <? } ?>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6 offset-md-1">
                <img src="<?= $props['PHOTO_OFFICE']['FILE_VALUE']['SRC'] ?>" alt="photo_ofice" class="main-office-pict">
            </div>
        </div>
    </div>



