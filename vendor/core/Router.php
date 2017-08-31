<?php

namespace vendor\core;

/**
 * Description of Router
 *
 * @author Олександр
 */
class Router {
    
    /**
 * Содержит таблицу маршрутов
 * @var Array
 */
    protected static $routes = [];
    
/**
 * Содержит теперишний маршрут
 * @var Array
 */
    protected  static $route = [];

/**
 * Добавляет новые маршруты в таблицу Маршрутов
 * @param string $regexp маршрут в виде регулярного выражения
 * @param Array $route массив содержащий контроллер и действие
 */
    public static function add($regexp, $route=[]) 
    {
        self::$routes[$regexp]=$route;
    }
    
/**
 * Возвращает таблицу маршрутов
 * @return Array
 */
    public static function getRoutes() 
    {
        return self::$routes;    
    }
    
/**
 * Возвращает текущий маршрут
 * @return Array
 */
    public static function getRoute() 
    {
        return self::$route;    
    }
    
    /**
     * Проверяе наличие запрашиваемого маршрута в таблице маршрутов
     * @param string $url
     * @return boolean
     */
    public static function MatchRoutes($url) 
    {
        foreach (self::$routes as $pattern => $route) 
        {
            if(preg_match("#$pattern#i", $url, $matches))
            {
                foreach ($matches as $k => $v) 
                {
                if(is_string($k)) 
                   {
                   $route[$k]=$v;
                   }   
                }
                $route['controller'] = self::UpperUrl($route['controller']);
                self::$route=$route;
                return true;
            }        
        }   
        return false;
    }
    
    /**
     * Перенаправляет url по коректному маршруту
     * @param string $url входящий URLroute['controller'] = 'ap
     */
    public static function dispatch($url) 
    {
        $url = self::removeQueryString($url);
        if(self::MatchRoutes($url)) 
        {
            $controller = 'app\Controllers\\'.self::$route['controller'];
            if(class_exists($controller))
            {
                $objC = new $controller(self::$route);
                $action = self::FormatAction(self::$route['action']);
                if(method_exists($objC, $action))
                {
                    $objC->$action();
                    $objC->getView();
                } else 
                    {
                    echo "действие $action не найден";
                }
            } else 
                {
                echo "контроллер $controller не найден";
            }
        } else 
            {
            http_response_code(404);
            include '404.html';
        }
    }
    
    /**
     * Преобразует controller в коректный формат
     * @param string $url
     * @return string
     */
    protected static function UpperUrl($url) 
    {
       return str_replace(' ', '', ucwords(str_replace('-', ' ', $url)));
    }
    
    /**
     * Преобразует action в коректный формат
     * @param string $act
     * @return string
     */
    protected static function FormatAction($act) 
    {
        if($act != "") 
        {
            return 'action'.self::UpperUrl($act);    
        } else 
            {
            return 'actionIndex';
        }
    }
    
    /**
     * Приводит URL к двум частям: явныв и неявным get параметрам обрезая слеш вконце
     * @param string $url 
     * @return string
     */
    protected static function removeQueryString($url)
    {
    if($url) 
        {
        $params = explode('&', $url, 2);
        if(false === strpos($params[0], '='))
           {
           return rtrim($params[0], '/');
           }    else 
               {
               return '';
               }
        }    
    }
}
