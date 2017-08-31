<?php

error_reporting(-1);

use vendor\core\Router;

define('ROOT', __DIR__);
define('APP', 'app');
define('LAYOUT', 'default');
define('IMG', 'web/image/');

spl_autoload_register(function ($class) {
    $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_file($file)) {
        require_once $file;
    }
});


$query = rtrim($_SERVER['QUERY_STRING'], '/');

//Defaults routs
Router::add('^$', ['controller' => 'SiteController', 'action' => 'index']);
Router::add('^([a-z-]+)/?(?P<action>[a-z-]+)?/?(?P<alias>[a-z-]+)?$', ['controller' => 'SiteController', 'action' => 'index']);

Router::dispatch($query);
