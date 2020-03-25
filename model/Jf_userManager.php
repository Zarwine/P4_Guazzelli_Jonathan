<?php

class Jf_userManager
{

    private $bdd;

    public function __construct()
    {
        $this->bdd = new PDO("mysql:host=jogufrdkog533.mysql.db:3306;dbname=jogufrdkog533;charset=utf8", "jogufrdkog533", "MaBDD550");
        $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    public function verifName($userData) {
        $req = $this->bdd->prepare('SELECT id FROM jf_users WHERE username =?');
        $req->execute([$userData['username']]);
        $user = $req->fetch(); 
        if($user){
            return true;
        }                         
    }

    public function verifEmail($userData) {
        $req = $this->bdd->prepare('SELECT id FROM jf_users WHERE email =?');
        $req->execute([$userData['email']]);
        $user = $req->fetch();
        if($user){
            return true;
        }

    }
    
    public function addMember($userData){
        $req = $this->bdd->prepare("INSERT INTO jf_users SET username = ?, password = ?, email = ?, confirmation_token = ?");
        $password = password_hash($userData['password'], PASSWORD_BCRYPT);

        $member = new Member();

        $token = $member->str_random(60);

        $req->execute([$userData['username'], $password, $userData['email'], $token]);

        $user_id = $this->bdd->lastInsertId();

        mail($userData['email'], 'Confirmation de votre compte', "Afin de valider votre compte, merci de cliquer sur ce lien\n\nhttps://jogu.fr/forteroche/confirm/id/$user_id/token/$token");
        
        $_SESSION['flash']['success'] = 'un email de confirmation vous a été envoyé pour valider votre compte';

        header('Location: login');
        exit();
    }

    public function verifToken($params){

        $user_id = $params["id"];
        $token = $params["token"];

        $req = $this->bdd->prepare('SELECT * FROM jf_users WHERE id = ?');

        $req->execute([$user_id]);

        $user = $req->fetch();
                
        session_start(); 

        if($user && $user->confirmation_token == $token) {
                
            $this->bdd->prepare('UPDATE jf_users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id =?')->execute([$user_id]);
            $_SESSION['auth'] = $user;

            return $validation = true;

        } else {
            
            return $validation = false;
        }
    }

    public function login($userData){
        
        $req = $this->bdd->prepare('SELECT * FROM jf_users WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL');
        $req->execute(['username' => $userData['username']]);
        $user = $req->fetch();
        if($user !== false){
            if(password_verify($userData['password'], $user->password)){
                $_SESSION['auth'] = $user;
                $_SESSION['flash']['success'] = 'Vous êtes maintenant connecté';
                if($userData['remember']){

                    require_once (CONTROLLER.'Member.php');
                    $mbr = new Member();
                    $remember_token = $mbr->str_random(250);

                    $this->bdd->prepare('UPDATE jf_users SET remember_token = ? WHERE id = ?')->execute([$remember_token, $user->id]);
                    setcookie('remember', $user->id . '==' . $remember_token . sha1($user->id . 'clefarbitraire'), time() + 60 * 60 * 24 * 7);            
                }
                header('Location: account');
                exit();
            } else {
                $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
                header('Location: login');
                exit();
            }
        } else {
            $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
            header('Location: login');
                exit();
        }
    }

    public function forgetPassword($userData){

        $req = $this->bdd->prepare('SELECT * FROM jf_users WHERE email = ? AND confirmed_at IS NOT NULL');
        $req->execute([$userData['email']]);
        $user = $req->fetch();

        return $user;
    }

    public function updateToken($user, $reset_token){

    $this->bdd->prepare('UPDATE jf_users SET reset_token = ?, reset_at = NOW() WHERE id = ?')->execute([$reset_token, $user->id]);

    }

    public function resetPassword($params){        
        
        $user_verif_id = $params['id'];
        $user_verif_reset_token = $params['token'];

        $req = $this->bdd->prepare("SELECT id FROM jf_users WHERE reset_token = '$user_verif_reset_token'");
        $req->execute();
        $user_id = $req->fetch();
 

        $req2 = $this->bdd->prepare("SELECT reset_token FROM jf_users WHERE id = $user_id->id");
        $req2->execute();
        $user_token_reset = $req2->fetch();
        
        if($user_id->id == $user_verif_id || $user_token_reset == $user_verif_reset_token){

            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }

            $member = new Member();
            $newpass = $member->str_random(10);
            $newpassforuser = $newpass;
            $newpass = password_hash($newpass, PASSWORD_BCRYPT);
                
            $req3 = $this->bdd->prepare('UPDATE jf_users SET password = ?');
            $req3->execute([$newpass]);
            

            $_SESSION['flash']['success'] = $newpassforuser;

            header('Location: https://jogu.fr/forteroche/login');
        }else{

            $_SESSION['flash']['danger'] = "Une erreur est survenue";
            header('Location: https://jogu.fr/forteroche/home');
        }
    }

    public function changePassword($userData){
        
            $user_id = $_SESSION['auth']->id;
            $password = password_hash($userData['password'], PASSWORD_BCRYPT);
            
            $req = $this->bdd->prepare('UPDATE jf_users SET password = ? WHERE id = ?');
            $req->execute([$password, $user_id]);
    }
    
    public function reconnect_from_cookie(){

        $remember_token = $_COOKIE['remember'];
        $parts = explode('==', $remember_token);
        $user_id = $parts[0];
        $req = $this->bdd->prepare('SELECT * FROM users WHERE id = ?');
        $req->execute([$user_id]);
        $user = $req->fetch();
        if($user){
            $excepted = $user_id . '==' . $user->remember_token . sha1($user_id . 'clefarbitraire');
            if($excepted == $remember_token){
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