<?php
global $SiteExpireDate;
if (DEMO && ($SiteExpireDate < time())) {
    $SiteExpireDate = time() * 1.1;
}
    function pre($var)
    {
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }