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
                        "add"              => ["controller" => "Home",   "method" => "addArticle"],  
                        "view"             => ["controller" => "Home",   "method" => "showArticle"],          //Fin CRUD

                        "register"         => ["controller" => "Member", "method" => "showRegister"],      //Début Espace membre
                        "register_confirm" => ["controller" => "Member", "method" => "verifAll"],     
                        "login"            => ["controller" => "Member", "method" => "showLogin"],
                        "login_confirm"    => ["controller" => "Member", "method" => "login"],
                        "forget"           => ["controller" => "Member", "method" => "showForget"],
                        "forgetPassword"   => ["controller" => "Member", "method" => "forgetPassword"],
                        "account"          => ["controller" => "Member", "method" => "showAccount"],
                        "confirm"          => ["controller" => "Member", "method" => "registerConfirm"],
                        "changePassword"   => ["controller" => "Member", "method" => "changePassword"],
                        "reset"            => ["controller" => "Member", "method" => "resetPassword"],
                        "reset_confirm"    => ["controller" => "Member", "method" => "resetPasswordConfirm"],
                        "logout"           => ["controller" => "Member", "method" => "logout"],             //Fin Espace membre

                        "com_create"       => ["controller" => "Comment",   "method" => "createComment"],   //Début Commentaires
                        "com_report"       => ["controller" => "Comment",   "method" => "reportComment"],
                        "com_delete"       => ["controller" => "Comment",   "method" => "delComment"],        
                        "com_modif"        => ["controller" => "Comment",   "method" => "modifComment"],        
                        "com_edit"         => ["controller" => "Comment",   "method" => "editionComment"],
                        "com_add"          => ["controller" => "Comment",   "method" => "addArticle"],  
                        "com_view"         => ["controller" => "Comment",   "method" => "showArticle"],          //Fin Commentaires

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
        
        //var_dump($elements);

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
        //var_dump($params);
     
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
            echo '404 Page non trouvée';          
            exit;
        }
    }
}