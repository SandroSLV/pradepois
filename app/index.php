<?php
    require_once 'tools/util.php';
    require_once 'database/db.php';
    require_once 'const/const.php';

    header('Access-Control-Allow-Origin: https://www.pradepois.com.br', false);
    
    date_default_timezone_set('America/Sao_Paulo');

    $path = $_SERVER['SCRIPT_NAME'];
    $path = str_replace("index.php","",$path);

    $elements = str_replace($path,"",$_SERVER['REQUEST_URI']);
    $elements = explode("?", $elements);


    $routes = empty($elements[0]) ? '' : $elements[0];
    $params = empty($elements[1]) ? '' : $elements[1];

    $routes = explode("/", $routes);

    if(empty($routes[0]) && !empty($routes[1])){
    	$ctr = 'userpage';
    	$act = 'show';
        $arg = $routes[1];
    } else {
        $ctr = empty($routes[0]) ? 'login' : $routes[0];
        $act = empty($routes[1]) ? 'show' : $routes[1];
        $arg = empty($routes[2]) ? '' : $routes[2];
    }


    $controller = 'controllers/'.$ctr.'_controller.php';
    $class = $ctr."Controller";

    require_once $controller;

    $obj = new $class();
    
    if(!method_exists($obj,$act)){
        viewPage('404');
        exit;
    }
    
    $obj->$act($arg);
    
?>