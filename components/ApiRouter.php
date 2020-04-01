<?php


class ApiRouter
{
    private $routes;

    public function __construct()       //при создании класа Router подключаем файл конфига
    {
        $routersPath = ROOT . '/config/routes.php';
        $this->routes = include($routersPath);
    }

    public function run()
    {

        $uri = $this->getUri();

        foreach ($this->routes as $uriPattern => $path) //проходим массив маршрутов
        {
            if (preg_match("~$uriPattern~", $uri))   //если есть совпадение маршрута и адресной строки
            {
                $internalroute = preg_replace("~$uriPattern~", $path, $uri);
                $segment = explode('/', $internalroute); //разбиваем на части значение маршрута

                $nameController = $this->getNameController($this->getMethod()); //имя контроллера

                $controlFile = ROOT . '/controllers/' . $nameController . '.php'; //подключаем контроллер

                require_once ROOT . '/controllers/GetController.php';
                if (file_exists($controlFile)) {  //если файл есть
                    include_once $controlFile;  //подключаем
                }

                $nameAction = strtolower(array_shift($segment)) . 'Action'; //имя Action4

                $parameters = $segment;     //скидываем лишнее палево

                $controllerObject = new $nameController($parameters); //подключаем контроллер

                $result = $controllerObject->$nameAction(); //запускаем экшн

                if ($result != null) {
                    break;
                }
            }
        }
       // ApiRouter::sendHeaders($_SERVER['REQUEST_METHOD'], 404, false, 'Not Found'); //вывод если ничего нету
    }

    private function getUri()
    {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        return $uri;
    }

    private function getMethod()
    {    //определение Метод
        $method = $_SERVER['REQUEST_METHOD']; //получаем метод
        $result = null;
        switch ($method) {
            case 'GET': $result = 'Get'; break;
            case 'PUT': $result = 'Put'; break;
            case 'POST': $result = 'Post'; break;
            case 'DELETE': $result = 'Delete'; break;
        }
        return $result;
    }

    private function getNameController($method)
    {     //пределение имени контроллера
        if ($method !== null) {
            $nameController = $method . "Controller"; //имя контроллера
        } else {
            http_response_code(404); //страница не найдена
            return null;
        }
        return $nameController;
    }

}