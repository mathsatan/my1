<?php

class Controller
{
    protected $model;
    protected $view;
    protected $params;

    public function __construct()
    {
        session_start();
        if (isset($_POST['lang']))
            $_SESSION['lang'] = $_POST['lang'];
        elseif (!isset($_SESSION['lang']))
            $_SESSION['lang'] = 'ru';

        require_once 'app/lang/'. $_SESSION['lang'].'.php';

        $this->view = new View();
    }

    public function action_index() //действие, вызываемое по умолчанию
    {
    }

    public function addParams($parameters)
    {
        $this->params = $parameters;
    }

    public function __get($param)
    {
        if (isset($this->params[$param]))
        {
            return $this->params[$param];
        }
        return false;
    }

} 