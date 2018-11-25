<?php

//echo 'Запрашиваемый url ' . $_SERVER['QUERY_STRING'];

// __DIR__

// Загружаем наши классы
spl_autoload_register( function ($class) {

    // получаем родительскую директорию
    $root = dirname(__DIR__);

    // получаем путь к файлу
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';

    if (is_readable($file)) {
        include $file;
    }
});

//echo get_class($router);

// Route   --     Controller --   Action
//--------------------------------------
// '/'          -- Home         -- index == главная страница
// '/posts'     -- Posts        -- index == список постов
// '/posts/show'-- Posts        -- show == один пост

// posts.php == posts.php


$router = new Core\Router();

// Добавим роуты
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('users', ['controller' => 'Users', 'action' => 'index']);
$router->add('posts/show', ['controller' => 'Posts', 'action' => 'show']);

$url = $_SERVER['QUERY_STRING'];
$router->dispatch($url);
