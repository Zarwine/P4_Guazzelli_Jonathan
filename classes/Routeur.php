<?php

class Routeur
{
    private $request;

    private $routes = [
                        "home"             => ["controller" => "Home",   "method" => "showHome"],        //Rediction vers la HomePage
                        "create"           => ["controller" => "Home",   "method" => "createArticle"],   //Début des redirections CRUD
                        "modification"     => ["controller" => "Home",   "method" => "createArticle"],
                        "delete"           => ["controller" => "Home",   "method" => "delArticle"],        
                        "edition"          => ["controller" => "Home",   "method" => "editionArticle"],
                        "add"              => ["controller" => "Home",   "method" => "addArticle"],      //Fin CRUD
                        "register"         => ["controller" => "Member", "method" => "showRegister"],      //Début Espace membre
                        "login"            => ["controller" => "Member", "method" => "showLogin"],
                      ];

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function getRoute()
    {
        $elements = explode('/', $this->request);
        return $elements[0];

    }

    public function getParams()
    {        
        $params = null;

        $elements = explode('/', $this->request);
        unset($elements[0]);

        for($i = 1; $i<count($elements); $i++)
        {
            $params[$elements[$i]] = $elements[$i+1];
            $i++;
        }

        if($_POST)
        {
            //echo '<pre>'; print_r($_POST); exit;
            foreach($_POST as $key => $val)
            {
                //echo '<pre>'; print_r($key); 
                //echo '<pre>'; print_r($params); exit;
                //echo '<pre>'; print_r($params[$key]); exit;
                $params[$key] = $val;
                //echo '<pre>'; print_r($val);
                //echo '<pre>'; print_r($params); exit;
            }
        }
        //echo '<pre>'; print_r($params);
        return $params;
    }

    public function renderController()
    {

        $route = $this->getRoute();
        $params = $this->getParams();

        if(key_exists($route, $this->routes))
        {
            $controller = $this->routes[$route]['controller'];
            $method     = $this->routes[$route]['method'];

            $currentController = new $controller();
            $currentController->$method($params);
        } else {
            echo '404';
        }
    }
}