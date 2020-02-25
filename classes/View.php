<?php

class View
{
    private $template;

    public function __contruct($template = null)
    {
        $this->template = $template;
    }

    public function render($params = array())
    {
        extract($params);

        $template = $this->template;

        ob_start();
        include(VIEW.$template.'.php');
        $contentPage = ob_get_clean();

        echo '<pre>'; print_r($params); exit;

        include_once (VIEW.'_gabarit.php');
    }

    public function redirect($route)
    {
        header("Location: ".HOST.$route);
        exit;
    }
}