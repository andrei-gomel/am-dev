
    <div class="menu__bar">
        <h1 class="logo">Photo<span>Gallary</span></h1>

        <ul>
            <li><a href="/">Главная</a></li>
            <li><a href="#">Категории <i class="fas fa-caret-down"></a></i>
                <div class="dropdown__menu">
                    <ul>
                        <li><a href="#">Животные</a></li>
                        <li><a href="#">Природа</a></li>
                        <li><a href="#">Техника <i class="fas fa-caret-right"></i></a>
                            <div class="dropdown__menu-1">
                                <ul>
                                    <li><a href="#">Автомобили</a></li>
                                    <li><a href="#">Мотоциклы</a></li>
                                    <li><a href="#">Корабли</a></li>
                                    <li><a href="#">Самолёты</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="#">Архитектура</a></li>
                    </ul>
                </div>
            </li>               
            <li><a href="#">Блог</a></li>
            <li><a href="#">О нас</a></li>          
            <li><a href="#">Контакты</a></li>
<?php
    if($_SESSION['login'])
          echo '<li><a href="/user/logout">Выйти</a></li>';

    if(!$_SESSION['login'])
        echo '<li><a href="/user/login">Войти</a></li>';
?>

        </ul>       
    </div>
