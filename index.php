<?php
    ob_start();
    session_start();
    // session_destroy();
    require_once "models/DataBase.php";
    session_start();
    //Controladores permitidos
    $allowedControllers =[
        'Landing',
        'User',
        'Company',
        'Admin'
    ];
    $controller = isset($_REQUEST['c']) ? $_REQUEST['c'] : "Landing";
    if(!in_array($controller,$allowedControllers)){
        $controller = 'Landing';
    }
    $route_controller = "controllers/" . $controller . ".php";
    if (file_exists($route_controller)) {
        require_once $route_controller;
    }else{
        require_once "controllers/Landing.php";
    }
        $controller = new $controller;
        $action = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'main';
        call_user_func([$controller,$action]);
    
?>