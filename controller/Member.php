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
    public function showAccount()
    {
        $myView = new View('account');
        $myView->render();
    }
    public function registerConfirm($params)
    {
        //$myView = new View('confirm');
        //$myView->render();
        
        $user_id = $params["id"];
        $token = $params["token"];

        require (MODEL.'Jf_userManager.php');
        $bdd = new PDO("mysql:host=jogufrdkog533.mysql.db:3306;dbname=jogufrdkog533;charset=utf8", "jogufrdkog533", "MaBDD550");
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        $req = $bdd->prepare('SELECT * FROM jf_users WHERE id = ?');

        $req->execute([$user_id]);

        $user = $req->fetch();

        session_start(); 

        if($user && $user->confirmation_token == $token) {
                
            $bdd->prepare('UPDATE jf_users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id =?')->execute([$user_id]);
            $_SESSION['flash']['success'] = 'Votre compte a bien été validé';
            $_SESSION['auth'] = $user;

            //$this->showAccount();
            header('Location: https://jogu.fr/forteroche/home');
        } else {
            $_SESSION['flash']['danger'] = "Ce token n'est plus valide";
            //$this->showLogin();
            header('Location: https://jogu.fr/forteroche/home');
        }
    }
    public function logout($params)
    {
        session_start();
        setcookie('remember', NULL, -1);
        unset($_SESSION['auth']);
        $_SESSION['flash']['success'] = "Vous êtes maintenant déconnecté";
        header('Location: login');

        //$myView = new View('logout');
        //$myView->render();
    }
    public function debug($variable){
        echo '<pre>' . print_r($variable, true) . '</pre>';
    }

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
            if(!isset($bdd)){
                global $bdd;
            }

            $remember_token = $_COOKIE['remember'];
            $parts = explode('==', $remember_token);
            $user_id = $parts[0];
            $req = $bdd->prepare('SELECT * FROM users WHERE id = ?');
            $req->execute([$user_id]);
            $user = $req->fetch();
            if($user){
                $exepted = $user_id . '==' . $user->remember_token . sha1($user_id . 'clefarbitraire');
                if($expected == $remember_token){
                    session_start();
                    $_SESSION['auth'] = $user;
                    setcookie('remember', $remember_token, time() + 60 * 60 * 24 * 7);
                }else{
                    setcookie('remember', null, -1);
                }
            }else{
                setcookie('remember', null, -1);
            }
        }
    }
}
