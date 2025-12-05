<?php
    ob_start();
    session_start();
    // session_destroy();
     session_start();
    require_once "models/DataBase.php";
   
    //Controladores permitidos
    $allowedControllers =[
        'Landing',
        'User',
        'Company',
        'Admin'
    ];

    // se puede tener acceso al controlador  desde la URL
    $controllerName = isset($_REQUEST['c']) ? $_REQUEST['c'] : "Landing";
    if(!in_array($controllerName,$allowedControllers)){
        $controllerName = 'Landing';
    }
    $controllersMap = [
    'Landing' => 'controllers/Landing.php',
    'User'    => 'controllers/User.php',
    'Company' => 'controllers/Company.php',
    'Admin'   => 'controllers/Admin.php'
    
    ];
    
    require_once $controllersMap[$controllerName];

    $controller = new $controllerName;

    if (!method_exists($controller, $action)) {
    $action = 'main';
    }
    call_user_func([$controller, $action]); 
    
?>