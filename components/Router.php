<?php

class Router {
    private $routes;
    public function __construct() {
        
        //путь к роутам
        $routesPath = ROOT.'/config/routes.php';
        
        //присвоить свойству routes массив с роутами
        $this->routes = include ($routesPath);
    }
    
    //метод для получения строки запроса
    private function getURI() {
        if(!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
    public function run() {
        
        //получить строку запроса
        $uri = $this->getURI();
        
        //проверить наличие такого маршрута в routes
        foreach ($this->routes as $uriPattern=>$path){
        
            //сравниваем $uriPattern и $uri
            if(preg_match("~$uriPattern~", $uri)){
                
                //определить какой контролер и экшн обрабатывают запрос
                $segments = explode('/', $path);
                $controllerName = array_shift($segments).'Controller';
                //сделать первую букву заглавной
                $controllerName = ucfirst($controllerName);
                
                $actionName = 'action'.ucfirst(array_shift($segments));
                        
                //подключаем файл класса-контроллера
                $controllerFile = ROOT.'/controllers/'.$controllerName.'.php';
                if(file_exists($controllerFile)){             
                    include_once ($controllerFile);
                }
        
                //создаем объект и вызываем метод
                $controllerObject = new $controllerName;
                $result = $controllerObject->$actionName();
                if($result !=  null){            
                    break;
                }
            }
        }
    }
}
