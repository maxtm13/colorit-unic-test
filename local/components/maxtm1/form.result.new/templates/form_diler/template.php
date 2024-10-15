<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="title text-center"><?= $arResult["FORM_TITLE"] ?></div>
            <?= $arResult["FORM_HEADER"] ?>
            <input type="hidden" name="web_form_submit" value="Y">
            <? if ($arResult["isFormErrors"] === "Y"): ?>
                <div class="errors">
                    <?= $arResult["FORM_ERRORS_TEXT"] ?>
                </div>
            <? endif; ?>
            <div class="form__inputs d-flex flex-md-row">
                <div class="form-item form__family">
                    <input type="text"
                           name="form_<?= $arResult["QUESTIONS"]['Family']['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arResult["QUESTIONS"]['Family']['STRUCTURE'][0]['ID'] ?>"
                           id="Family"
                           required
                           placeholder="<?= $arResult["QUESTIONS"]['Family']['CAPTION'] ?>">
                </div>
                <div class="form-item form__name">
                    <input type="text"
                           name="form_<?= $arResult["QUESTIONS"]['Name']['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arResult["QUESTIONS"]['Name']['STRUCTURE'][0]['ID'] ?>"
                           required
                           id="Name"
                           placeholder="<?= $arResult["QUESTIONS"]['Name']['CAPTION'] ?>">

                </div>
                <div class="form-item form__company">
                    <input type="text"
                           name="form_<?= $arResult["QUESTIONS"]['Company']['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arResult["QUESTIONS"]['Company']['STRUCTURE'][0]['ID'] ?>"
                           required
                           id="Company"
                           placeholder="<?= $arResult["QUESTIONS"]['Company']['CAPTION'] ?>">

                </div>
            </div>
            <div class="form__inputs d-flex flex-md-row">
                <div class="form-item form__type">
                    <input type="text"
                           name="form_<?= $arResult["QUESTIONS"]['type']['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arResult["QUESTIONS"]['type']['STRUCTURE'][0]['ID'] ?>"
                           required
                           id="type"
                           placeholder="<?= $arResult["QUESTIONS"]['type']['CAPTION'] ?>">

                </div>
                <div class="form-item form__city">
                    <input type="text"
                           name="form_<?= $arResult["QUESTIONS"]['city']['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arResult["QUESTIONS"]['city']['STRUCTURE'][0]['ID'] ?>"
                           required
                           id="city"
                           placeholder="<?= $arResult["QUESTIONS"]['city']['CAPTION'] ?>">

                </div>
            </div>
            <div class="form__inputs d-flex flex-md-row">
                <div class="form-item rating">
                    <input type="text"
                           name="form_<?= $arResult["QUESTIONS"]['rating']['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arResult["QUESTIONS"]['rating']['STRUCTURE'][0]['ID'] ?>"
                           required
                           id="rating"
                           placeholder="<?= $arResult["QUESTIONS"]['rating']['CAPTION'] ?>">

                </div>
                <div class="form-item form__phone">
                    <input type="text"
                           name="form_<?= $arResult["QUESTIONS"]['phone']['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arResult["QUESTIONS"]['phone']['STRUCTURE'][0]['ID'] ?>"
                           required
                           id="phone"
                           placeholder="<?= $arResult["QUESTIONS"]['phone']['CAPTION'] ?>">

                </div>
                <div class="form-item form__email">
                    <input type="text"
                           name="form_<?= $arResult["QUESTIONS"]['email']['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arResult["QUESTIONS"]['email']['STRUCTURE'][0]['ID'] ?>"
                           required
                           id="email"
                           placeholder="<?= $arResult["QUESTIONS"]['email']['CAPTION'] ?>">

                </div>

            </div>
            <div class="form__checkbox">
                <input type="checkbox" name="form_checkbox_policy[]"
                       id="form_checkbox_policy[]"
                       required
                       value="<?= $arResult["QUESTIONS"]['policy']['STRUCTURE'][0]['ID'] ?>">
                <label for="form_checkbox_policy[]">
                    <?= $arResult["QUESTIONS"]['policy']['CAPTION'] ?>
                </label>
            </div>
            <div class="text-center">
                <div class="form__btn" name="web_form_submit">
                <button type="submit">
                    <span>Отправить</span>
                    <span>
                        <svg width="48" height="3" viewBox="0 0 48 3" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                          <rect width="48" height="3" fill="white"/>
                        </svg>
                    </span>
                </button>
                </div>
            </div>
        </div>


<?= $arResult["FORM_FOOTER"] ?>
    </div>
<? if ($arResult["isFormNote"] === "Y"): ?>

    <div class="popup form__popup_success" id="form__popup_success" style="display: none; min-width: 500px;">
        <p>
            Успешно отправлено.
        </p>
    </div>
    <script>
        Fancybox.show([{src: "#form__popup_success", type: "inline"}])
    </script>

<? endif; ?>
<?php
// todo модалка
?>
    <script>
        $(document).ready(function () {
            $('#phone').mask("+7 (999) 999-9999");
        });
    </script>
<?


