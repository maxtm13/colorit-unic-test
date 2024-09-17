<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
    <div class="row">
        <div class="col-sm-4">
            <h3 class="form__title"><?= $arResult["FORM_TITLE"] ?></h3>
            <p class="form__decription"><?= $arResult["FORM_DESCRIPTION"] ?></p>
        </div>
        <div class="form col-sm-8">


            <?= $arResult["FORM_HEADER"] ?>
            <input type="hidden" name="web_form_submit" value="Y">
            <? if ($arResult["isFormErrors"] === "Y"): ?>
                <div class="errors">
                    <?= $arResult["FORM_ERRORS_TEXT"] ?>
                </div>
            <? endif; ?>
            <div class="form__inputs">
                    <div class="form__name">
                        <input type="text"
                               name="form_<?= $arResult["QUESTIONS"]['name_customer']['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arResult["QUESTIONS"]['name_customer']['STRUCTURE'][0]['ID'] ?>"
                               id="name_customer"
                               required
                               placeholder="<?= $arResult["QUESTIONS"]['name_customer']['CAPTION'] ?>">
                    </div>
                    <div class="form__phone">
                        <input type="text"
                               name="form_<?= $arResult["QUESTIONS"]['phone_customer']['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arResult["QUESTIONS"]['phone_customer']['STRUCTURE'][0]['ID'] ?>"
                               required
                               id="phone_customer"
                               placeholder="<?= $arResult["QUESTIONS"]['phone_customer']['CAPTION'] ?>">

                    </div>
            </div>
            <div class="form__checkbox">
                <input type="checkbox" name="form_checkbox_policy_c[]"
                       id="form_checkbox_policy_c[]"
                       required
                       value="<?= $arResult["QUESTIONS"]['policy_c']['STRUCTURE'][0]['ID'] ?>">
                <label for="form_checkbox_policy_c[]" >
                    <?= $arResult["QUESTIONS"]['policy_c']['CAPTION'] ?>
                </label>
            </div>
            <div class="form__btn" name="web_form_submit">
                <button type="submit">
                <span>Отправить</span> <span><svg width="48" height="3" viewBox="0 0 48 3" fill="none" xmlns="http://www.w3.org/2000/svg">
  <rect width="48" height="3" fill="white" />
</svg></span>
                </button>
<!--                --><?php //echo $arResult['SUBMIT_BUTTON'] ?>
            </div>

        </div>


        <!--	<input type="submit" value="Отправить">-->
        <?= $arResult["FORM_FOOTER"] ?>
    </div>
<? if ($arResult["isFormNote"] === "Y"): ?>

    <div class="popup form__popup_success" id="form__popup_success" style="display: none; min-width: 500px;">
        <p>
            Успешно отправлено.
        </p>
    </div>
    <script >
        Fancybox.show([{ src: "#form__popup_success", type: "inline" }])
    </script>

<? endif; ?>
<?php
// todo модалка
?>
    <script>
        $(document).ready(function () {
            $('#phone_customer').mask("+7 (999) 999-9999");
        });
    </script>
<?

