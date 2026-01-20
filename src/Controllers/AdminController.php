<?php

namespace Oleh\AmDev\Controllers;

use Oleh\AmDev\core\base\Controller;
use Oleh\AmDev\Models\Task;

class AdminController extends Controller
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

            if($email != 'admin@tasks.by')
                header('Location: /main');

            $tasks = $this->model->getAllTasks();

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