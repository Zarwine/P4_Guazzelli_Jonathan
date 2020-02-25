<?php

class Routeur
{
    private $request;

    private $routes = [
                        "home.html" => ["controller" => "Home", "method" => "showHome"],
                        "create-article.html" => ["controller" => "Home", "method" => "createArticle"],
                        "ajout.html" => ["controller" => "Home", "method" => "addArticle"],
                        "delete" => ["controller" => "Home", "method" => "delArticle"],
                        "modification" => ["controller" => "Home", "method" => "createArticle"],
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
            foreach($_POST as $key => $val)
            {
                $params[$key] = $val;
            }
        }

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