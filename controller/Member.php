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
    public function showAccount($params)
    {
        $myView = new View('account');
        $myView->render();
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
            if(!isset($pdo)){
                global $pdo;
            }

            $remember_token = $_COOKIE['remember'];
            $parts = explode('==', $remember_token);
            $user_id = $parts[0];
            $req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
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
