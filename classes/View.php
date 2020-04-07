<?php

class View
{
    
    private $template;

    public function __construct($template = null)
    {
        $this->template = $template;
    }

    public function render($params = array()) //ajoute le contenu de la page à la variable $contentPage
    {   
        extract($params);

        $template = $this->template;
        include_once (CLASSES.'DateFormat.php');
        ob_start();

        include (VIEW.$template.'.php');
        $contentPage = ob_get_clean();
        
        include_once (VIEW.'_gabarit.php');
        
        
    
    }

    public function redirect($route)
    {
        header("Location: ".HOST.$route);
        exit;
    }
}