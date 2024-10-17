<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
    <div class="callback_form row">
        <div class="col-md-10 offset-md-1">
            <div class="title text-center"><?= $arResult["FORM_TITLE"] ?></div>
            <?= $arResult["FORM_HEADER"] ?>
            <input type="hidden" name="web_form_submit" value="Y">
            <? if ($arResult["isFormErrors"] === "Y"): ?>
                <div class="errors">
                    <?= $arResult["FORM_ERRORS_TEXT"] ?>
                </div>
            <? endif; ?>
            <div class="form__inputs d-flex flex-column">
                <div class="form-item form__FIO">
                    <input type="text"
                           name="form_<?= $arResult["QUESTIONS"]['FIO']['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arResult["QUESTIONS"]['FIO']['STRUCTURE'][0]['ID'] ?>"
                           id="FIO"
                           required
                           placeholder="<?= $arResult["QUESTIONS"]['FIO']['CAPTION'] ?>">
                </div>
                <div class="form-item form__phone">
                    <input type="text"
                           name="form_<?= $arResult["QUESTIONS"]['phone']['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arResult["QUESTIONS"]['phone']['STRUCTURE'][0]['ID'] ?>"
                           <? echo $arResult["QUESTIONS"]['phone'] ==='Y' ? 'required' : ''?>
                           id="phone"
                           placeholder="<?= $arResult["QUESTIONS"]['phone']['CAPTION'] ?>">

                </div>
                <div class="form-item form__comment">

                    <textarea  type="text"
                           name="form_<?= $arResult["QUESTIONS"]['comment']['STRUCTURE'][0]['FIELD_TYPE'] . '_' . $arResult["QUESTIONS"]['comment']['STRUCTURE'][0]['ID'] ?>"
                           id="comment"
                           placeholder="<?= $arResult["QUESTIONS"]['comment']['CAPTION'] ?>" ></textarea>
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
        </div>
<?// pre($arResult['QUESTIONS']['comment']['HTML_CODE'] )?>
<?// pre($arResult['QUESTIONS']['comment']['STRUCTURE'] )?>
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
        Fancybox.close('#callback');
        Fancybox.show([
            {
            src: "#form__popup_success",
            type: "inline"
            }
        ])
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


