<?php

return [
    //'news/([a-z]+)/([0-9]+)' => 'news/view/$1/$2',

    'test' => 'test/index',

    
    // Регистрация и авторизация

    'user/login' => 'user/login',  // actionLogin в UserController

    'user/logout' => 'user/logout',  // actionLogout в UserController

    'user/register' => 'user/register',  // actionRegister в UserController

    'user/login_process' => 'user/login_process',  // actionLogin_process в UserController

    'user/register_process' => 'user/register_process',  // actionRegister_process в UserController

    
    // Задачи

    'task/save' => 'task/save',  // actionSave в TaskController

    //'task/([0-9]+)' => 'task/view/$1', //  actionView в TaskController
    
    'task/edit' => 'task/edit', //  actionEdit в TaskController
    
    'task/update' => 'task/update', //  actionUpdate в TaskController
    //'task/edit/([0-9]+)' => 'task/edit/$1', //  actionEdit в TaskController

    //'task' => 'album/index',  // actionIndex в AlbumController

    // страница админа
    'admin' => 'admin/index',  // actionIndex в AdminController
    
    // страница пользователя
    'main' => 'main/index',  // actionIndex в MainController
    
    // Главная страница

    '^$' => 'main/index',  // actionIndex в MainController
];
