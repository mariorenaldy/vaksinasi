<?php
    require_once 'config.php';

    function asset($fn)
    {
    return BASEURL . "/" . $fn;
    }

    function route($fn)
    {
    return BASEURL . $fn;
    }

    function redirect($url) {
        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();
    }

    session_start();
    
    $url = !$_SERVER['REQUEST_URI'] ? $_SERVER['REDIRECT_URL'] : $_SERVER['REQUEST_URI'];
    $url = strtok($url, '?');
    $baseURL = BASEURL;

    require_once 'routes.php';
?>