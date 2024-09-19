<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); // Проверка на подключение ядра
use Bitrix\Main\Loader;
AddEventHandler('subscribe', 'OnStartSubscriptionAdd', 'getPopup');


// Подключаем модули
Loader::includeModule('subscribe'); // Подключаем модуль Подписка, рассылки
?>
    <section class="subscribe container">
        <div class="subscribe__text">
            <div class="subscribe__title"><?= $arResult['TITLE']; ?></div>
            <p class="subscribe__subtitle"><?= $arResult['SUBTITLE']; ?></p>
        </div>
        <form class="subscribe__form" method="post">
            <div class="input__container input__container_email">
                <input placeholder="Электронная почта" required name="email" data-type="email" type="email">
                <span class="error-message" style="display:none">Введите email </span>
            </div>
            <div class="form__checkbox">
                <input required name="agreement" id="agreement" data-type="checkbox" type="checkbox">
                <label for="agreement" class="checkbox checkbox_white">
                    <span class="label">Я согласен на обработку <a href="<?= $arResult['POLICY']; ?>" target="_blank">моих персональных данных </a></span>
                    <!--                    <span class="custom-checkbox"></span>-->
                    <span class="error-message" style="display:none">Обязательное поле</span>
                </label>
            </div>

            <button class="button" type="submit"  data-fancybox data-src="#notif_subscribe">
                <span class="text"><?= $arResult['BUTTON']; ?></span>
                <span class="decorate">
                    <svg width="112" height="4" viewBox="0 0 112 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="112" height="4" fill="#055B8C"/>
                    <rect x="22" width="23" height="4" fill="#0A8B43"/>
                    <rect x="45" width="22" height="4" fill="#844C82"/>
                    <rect x="67" width="23" height="4" fill="#DD5625"/>
                    <rect x="90" width="22" height="4" fill="#BA2226"/>
                    </svg>

                </span>
            </button>

        </form>
    </section>
<div class="popup notification" id="notif_subscribe" style="display:none;min-width:500px;" >
    <div class="notification__wrapper">
<?
if (!empty($_POST['email']) && !empty($_POST['agreement'])) {

    global $USER;
    $email = $_POST['email'];

    $subscribeFields = [
        'USER_ID' => ($USER->IsAuthorized() ? $USER->GetID() : false),
        'FORMAT' => 'html',
        'EMAIL' => $email,
        'ACTIVE' => 'Y',
        'CONFIRMED' => 'Y', // Подтверждаем подписку без подтверждения по почте
        'SEND_CONFIRM' => 'N', // Не отправялем письмо с подтверждение подписчику
        'RUB_ID' => [1] // Указываем ID рассылки
    ];

    $subscr = new CSubscription;
    $ID = $subscr->Add($subscribeFields);
    ?>

    <?
    if ($ID > 0) {
        CSubscription::Authorize($ID);
        ?>

<!--            <button class="btn notification__close"></button>-->
            <h4>Подписка на рассылку</h4>
            <p>Вы успешно подписались на рассылку с адресом <?= $email; ?></p>
    <? } else { ?>
            <h4>Подписка на рассылку</h4>
            <p>Адрес <?= $email; ?> уже подписан на рассылку</p>
    <? } ?>

<? } ?>
<!--        <script>-->
<!--            if ($('.notification__wrapper p').length > 0){-->
<!--                Fancybox.show([{ src: "#notif_subscribe", type: "inline" }]);-->
<!--            }-->
<!--        </script>-->
    </div>
</div>


