<?php
global $SiteExpireDate;
if (DEMO && ($SiteExpireDate < time())) {
    $SiteExpireDate = time() * 1.1;
}
    function pre($var)
    {
        global $USER;
        if ($USER->IsAdmin()) {

            echo '<pre>';
            print_r($var);
            echo '</pre>';
        }
    }
    function getPopup() {
        $script =  'Fancybox.show([{ src: "#notif_subscribe", type: "inline" }]);';
        echo "<script> {$script} </script>";
    }
AddEventHandler("main", "OnEpilog", "My404PageInSiteStyle");
function My404PageInSiteStyle()
{
    if(defined('ERROR_404') && ERROR_404 == 'Y')
    {
        global $APPLICATION;
        $APPLICATION->RestartBuffer();
        include $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/header.php';
        include $_SERVER['DOCUMENT_ROOT'].'/404.php';
        include $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/footer.php';
    }
}