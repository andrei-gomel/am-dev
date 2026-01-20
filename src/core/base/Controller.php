<?php

namespace Oleh\AmDev\core\base;

abstract class Controller
{
    public $route = [];
    public $view;
    public $layout;
    public $vars = [];

    public function __construct($route)
    {
        $this->route = $route;
        
        $this->view = $route['action'];
        //include APP . "/views/". ucfirst($route['controller']) . "/{$this->view}.php";
    }

    public function getView()
    {
        $viewObj = new View($this->route, $this->view, $this->layout);

        $viewObj->render($this->vars);
    }

    public function set($vars)
    {
        $this->vars = $vars;        
    }

    public function isAjax(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
        $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }
}
