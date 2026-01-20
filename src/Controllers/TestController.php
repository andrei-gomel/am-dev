<?php

namespace Oleh\AmDev\Controllers;

use Oleh\AmDev\core\base\Controller;
//use Oleh\ItMinsk\Models\Album;

class TestController extends Controller
{
    //public $table;

    //public $model;
    
    public function index()
    {
        //$this->model = new Album;
        //dd($this->model);

        //$arr = $this->model->getAlbumsWithAutor();
        dd("Контроллер: TestController, " . "метод: " . __METHOD__);
    }
    
}
