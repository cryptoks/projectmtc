<?php

function CheckIfAjaxRequest($returnBool = false)
{
    $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

    if ($returnBool) {
        return $isAjax;
    }

    if (!$isAjax) {
        die('Restricted access');
    }

    (empty($_SERVER['HTTP_REFERER'])) ? die() : false;
}

function SecureInput($input)
{
    return htmlspecialchars(stripslashes($input));
}