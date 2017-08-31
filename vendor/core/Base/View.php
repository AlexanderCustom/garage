<?php

namespace vendor\core\Base;

class View {
    /**
     * текуший машрут и параметры (controller, action, alias)
     * @var Array
     */
    public $route;
    
    /**
     * текущий вид
     * @var sring
     */
    public $view;
    
    /**
     * текущий шаблон
     * @var string
     */
    public $layout;
    
    public function __construct($route, $layout='', $view='') 
    {
    $this->route = $route;
    if($layout === false) 
    {
        $this->layout = false;
    } else 
        {
        $this->layout = $layout ?: LAYOUT; 
    }
    $this->view = $view;  
    }
    
    /**
     * Подключает вид и шаблон
     */
    public function render($vars) 
    {
        if(is_array($vars)) extract($vars);
        $file_view = APP.'/Views/'.substr($this->route['controller'],0,-10).'/'.$this->view.'.php';
        ob_start();
        if(is_file($file_view))
        {
            require $file_view;
        } else 
            {
            echo "<p>Не найден вид <b>$file_view</b></p>";
        }
        $content = ob_get_clean();
        
        if(false !== $this->layout) 
        {
        $file_layout = APP.'/Views/layout/'.$this->layout.'.php';
        if(is_file($file_layout))
        {
            require $file_layout;
        }   else 
            {
            echo 'Шаблон не найден'.$file_layout;
            }
        }
        
    }
}
