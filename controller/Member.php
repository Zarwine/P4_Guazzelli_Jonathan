<?php

class Member 
{
    public function showRegister($params)
    {  
        $myView = new View('register');
        $myView->render();        
    }
    public function showLogin()
    {
        $myView = new View('login');
        $myView->render();
    }
    public function showForget()
    {
        $myView = new View('forget');
        $myView->render();
    }
    public function showAccount()
    {
        $myView = new View('account');
        $myView->render();
    }
    public function registerConfirm($params)
    {
        require (MODEL.'Jf_userManager.php');
        $userManager = new Jf_userManager();

        $validation = $userManager->verifToken($params);
        
        if($validation === true){
            $_SESSION['flash']['success'] = 'Votre compte a bien été validé';
            header('Location: https://jogu.fr/forteroche/home');
            //$myView = new View('home');
            //$myView->render();
        }else{
            $_SESSION['flash']['danger'] = "Ce token n'est plus valide";
            header('Location: https://jogu.fr/forteroche/home');
            //$myView = new View('home');
            //$myView->render();
        }
    }
    public function resetPassword($params){
        
        require (MODEL.'Jf_userManager.php');
        $userManager = new Jf_userManager();

        $userManager->resetPassword($params);

    }

    public function verifAll($userData){
        require_once (MODEL.'Jf_userManager.php');
        $userManager = new Jf_userManager();
        $errors = array();

        if(empty($userData['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $userData['username'])) {
            $errors['username'] = "Votre pseudo n'est pas valide";
        } else {
            
            $userManager->verifName($userData);        
        }
        if(empty($userData['email']) || !filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Votre email n'est pas valide";
        } else {
            
            $userManager->verifEmail($userData);        
        }

        if(empty($userData['password']) || $userData['password'] != $userData['password_confirm']) {
            $errors['password'] = "Votre mot de passe n'est pas valide";
        }
        if(empty($errors)){
            
            $userManager->addMember($userData);
        }
    }  
    public function login($userData){

        require_once (MODEL.'Jf_userManager.php');
        $userManager = new Jf_userManager();
        $userManager->login($userData);
    }
    public function forgetPassword($userData){
        
        require_once (MODEL.'Jf_userManager.php');
        $userManager = new Jf_userManager();
        $userManager->forgetPassword($userData);

    }
    public function logout()
    {
        session_start();
        setcookie('remember', NULL, -1);
        unset($_SESSION['auth']);
        $_SESSION['flash']['success'] = "Vous êtes maintenant déconnecté";
        header('Location: login');
    }
    
   //public function debug($variable){
   //    echo '<pre>' . print_r($variable, true) . '</pre>';
   //}

    public function str_random($length) {

        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $length)),0 ,$length);

    }

    public function logged_only() {
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";
        header('Location: login.php');
        exit();
    }

    public function reconnect_from_cookie(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        
        if(isset($_COOKIE['remember']) && !isset($_SESSION['auth'])){
    
            require_once (MODEL.'Jf_userManager.php');
            $userManager = new Jf_userManager();
            $userManager->reconnect_from_cookie();
            
        }
    }

    public function changePassword($userData){
        if(!empty($userData)){
            if(empty($userData['password']) || $userData['password'] != $userData['password_confirm']){
                $_SESSION['flash']['danger'] = "Les mots de passes ne correspondent pas";
            }else{
                require_once (MODEL.'Jf_userManager.php');
                $userManager = new Jf_userManager();
                $userManager->changePassword($userData);
    
                $_SESSION['flash']['success'] = "Votre mot de passe a bien été mis à jour";
            }
        }
    }
}
