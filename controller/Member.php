<?php

class Member 
{
    public function showRegister($params)
    {  
        $myView = new View('register');
        $myView->render();        
    }
    public function showLogin($params)
    {
        $myView = new View('login');
        $myView->render();
    }
    public function debug($variable){
        echo '<pre>' . print_r($variable, true) . '</pre>';
    }

    public function str_random($length) {

        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $length)),0 ,$length);

    }
}
