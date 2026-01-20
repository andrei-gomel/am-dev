<?php

namespace Oleh\AmDev\Controllers;

use Oleh\AmDev\core\base\Controller;
use Oleh\AmDev\Models\Task;

class MainController extends Controller
{
    protected $model;

    public function __construct($route)
    {
        $this->model = new Task();

        parent::__construct($route);
    }

    public function index()
    {        
        if($_SESSION['email'])
        {            
            $email = $_SESSION['email'];
            $user_id = $_SESSION['user_id'];

            $tasks = $this->model->getTasksByAutor($user_id);

            $this->view = 'index';

            $this->set(compact('email', 'tasks'));

            $this->getView();
        }
        else
        {
            header('Location: /user/login');
        }
    }
}
