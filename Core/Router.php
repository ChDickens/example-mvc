<?php
namespace Core;

class Router
{
    protected $routes = [];
    protected $params = [];


    // Добавляем роуты
    public function add($route, $params = [])
    {
        $route = preg_replace('/\//', '\\/', $route);
        $route = '/^' . $route . '$/i';
        $this->routes[$route] = $params;
    }
    /**
     * Получить список роутов
     */
    public function getRoutes()
    {
        return $this->routes;
    }
    /**
     * Сравниваем роуты и добавляем парамметры к ним
     */
    public function match($url)
    {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url)) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }
    /**
     * Получаем парамметры
     */
    public function getParams()
    {
        return $this->params;
    }
    /**
     * Отправляем роут, создаем контроллер и запускаем action
     */
    public function dispatch($url)
    {
        if ($this->match($url)) {
            // var_dump($this->params);
            // Получаем имя контроллера (наш класс)
            $controller = $this->params['controller'];
            // Получаем имя контроллера (наш класс) в пространстве имен
            $controller = $this->getNamespace() . $controller;
            // Если контроллер найден
            if (class_exists($controller)) {
                // Создаем экземпляр нашего класса (контроллера) с параметрами
                $controller_object = new $controller($this->params);
                // Получаем наш action
                $action = $this->params['action'];
                // Вызываем наш action
                $controller_object->$action();
            } else {
                // Если контроллер не найден бросаем исключение
                throw new \Exception("Controller class $controller not found");
            }
            // Если урл не находит отдаем текст с 404 ошибкой
        } else {
            echo "Такой страницы не существует";
        }
    }

    // Получаем пространство имен

    protected function getNamespace()
    {
        $namespace = 'App\Controllers\\';
        if (array_key_exists('namespace', $this->params)) {
            $namespace .= $this->params['namespace'] . '\\';
        }
        return $namespace;
    }
}