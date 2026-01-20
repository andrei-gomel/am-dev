<?php

namespace Oleh\AmDev\Controllers;

use Oleh\AmDev\core\base\Controller;
use Oleh\AmDev\Models\Task;

class TaskController extends Controller
{
    protected $model;

    public function __construct($route)
    {
        $this->model = new Task();

        parent::__construct($route);
    }

    public function index()
    {

    }

    public function save()
    {
        $data = $_POST;
        $data['user_id'] = $_SESSION['user_id'];

        $res = $this->model->insertTask($data);

        if($res !== false)
            header('Location: /');
        else
            dd('NOT OK');
    }

    public function edit()
    {
        $id = intval(trim($_GET['id']));

        header('Content-Type: application/json');
        $data = $this->model->findTaskById($id);
        unset($data->pdo);

        echo json_encode($data, JSON_FORCE_OBJECT);        
    }

    public function update()
    {
        $data = $_POST;
        header('Content-Type: application/json');
        $res = $this->model->updateStatus($data);
        
        $new_data = $this->model->findTaskById($data['task_id']);
        unset($new_data->pdo);
        echo json_encode($new_data, JSON_FORCE_OBJECT);
    }

}