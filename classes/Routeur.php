<?php

class Routeur
{
    private $request;

    private $routes = [
                        "home"                => ["controller" => "Home",   "method" => "showHome"],                //Rediction vers la HomePage

                        "create"              => ["controller" => "Home",   "method" => "createArticle"],           //Début des redirections CRUD
                        "modification"        => ["controller" => "Home",   "method" => "createArticle"],
                        "delete"              => ["controller" => "Home",   "method" => "delArticle"],        
                        "edition"             => ["controller" => "Home",   "method" => "editionArticle"],
                        "add"                 => ["controller" => "Home",   "method" => "addArticle"],  
                        "view"                => ["controller" => "Home",   "method" => "showArticle"],             //Fin CRUD
   
                        "register"            => ["controller" => "Member", "method" => "showRegister"],            //Début Espace membre
                        "register_confirm"    => ["controller" => "Member", "method" => "verifAll"],     
                        "login"               => ["controller" => "Member", "method" => "showLogin"],
                        "login_confirm"       => ["controller" => "Member", "method" => "login"],
                        "forget"              => ["controller" => "Member", "method" => "showForget"],
                        "forgetPassword"      => ["controller" => "Member", "method" => "forgetPassword"],
                        "account"             => ["controller" => "Member", "method" => "showAccount"],
                        "confirm"             => ["controller" => "Member", "method" => "registerConfirm"],
                        "changePassword"      => ["controller" => "Member", "method" => "changePassword"],
                        "reset"               => ["controller" => "Member", "method" => "resetPassword"],
                        "reset_confirm"       => ["controller" => "Member", "method" => "resetPasswordConfirm"],
                        "logout"              => ["controller" => "Member", "method" => "logout"],                  //Fin Espace membre
   
                        "comCreate"           => ["controller" => "Comment",   "method" => "createComment"],        //Début Commentaires
                        "comReport"           => ["controller" => "Comment",   "method" => "reportComment"],
                        "comDelete"           => ["controller" => "Comment",   "method" => "delComment"],        
                        "comModif"            => ["controller" => "Comment",   "method" => "modifComment"],        
                        "com_edit"            => ["controller" => "Comment",   "method" => "editionComment"],
                        "com_add"             => ["controller" => "Comment",   "method" => "addArticle"],  
                        "com_view"            => ["controller" => "Comment",   "method" => "showArticle"],          //Fin Commentaires

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
        // -> methode getAction() prend l'element[1] qui vérifi s'il y a une action à faire dans le but de configurer le routeur autrement genre home/create 
        // ou bien encore comment/modif/id
        // revoir le routeur.

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