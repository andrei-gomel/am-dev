<?php

namespace Oleh\AmDev\Controllers;

use Oleh\AmDev\core\base\Controller;
use Oleh\AmDev\Models\User;
use Oleh\AmDev\Servises\ValidateData;

class UserController extends Controller
{
    protected $model;

    protected int $id;

    protected string $login;

    protected string $name;

    public function __construct($route)
    {
        $this->model = new User();

        parent::__construct($route);
    }
    
    public function index()
    {
        echo 'UserController<br>';
        dd($this->route);
    }

    public function login(): void
    {
        $this->getView();
    }

    public function login_process(): void
    {
        $data = $_POST;

        if(ValidateData::checkFormParams($data))
        {
            $data['password'] = md5($data['password']);

            $user = $this->loginUser($data);
            
            if($user === false)
            {
                $error['formError'] = 'Не верный логин или пароль';

                $this->route['action'] = 'login';

                $this->view = 'login';

                $this->set($error['formError']);

                $this->getView();

            }
            else
            {
                if(isset($user->email))
                {
                    $_SESSION['email'] = $user->email;

                    $_SESSION['user_id'] = $user->id;
                }    

                $this->route['controller'] = $_SESSION['email'] == "admin@tasks.by" ? 'admin' : 'main';

                header('Location: /' . $this->route['controller']);
            }                     
        }
        else
        {
            $this->route['action'] = 'login';

            $this->view = 'login';

            $this->set($_SESSION['formError']);

            unset($_SESSION['formError']);

            $this->getView();
        }
    }

    public function logout(): void
    {
        session_destroy();

        header('Location: /');
    }
    
    public function register()
    {

        $this->route['action'] = 'register';

        $this->view = 'register';

        $this->getView();
    }

    public function register_process()
    {
        $data = $_POST;

        if(ValidateData::checkFormParams($data))
        {
            $data['password'] = md5($data['password']);

            $user = $this->loginUser($data);

            if($user == true AND $user->email == $data['email'])
            {
                $error['formError'] = 'Такой e-mail уже существует!';

                $this->route['action'] = 'register';

                $this->view = 'register';

                $this->set($error['formError']);

                $this->getView();

            }
            if($user == false)
            {
                $res = $this->registerUser($data);

                if($res !== false)
                {

                    header('Location: /user/login');
                }                
            }                     
        }
        else
        {
            $this->route['action'] = 'register';

            $this->view = 'register';

            $this->set($_SESSION['formError']);

            unset($_SESSION['formError']);

            $this->getView();
        }
    }

    public function loginUser(array $data): object|bool
    {
        $user = $this->model->getUser($data);

        return $user;
    }

    public function registerUser(array $data): int|bool
    {
        return $this->model->insertUser($data);
    }
}
