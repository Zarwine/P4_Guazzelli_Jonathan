<?php

class Jf_userManager extends Database //Traite toute la partie utilisateur du site.
{

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
    
    public function addMember($userData){ //Ajoute l'utilisateur a la BDD et attend confirmation mail
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

    public function verifToken($params){ //vérifie token mail = token de BDD

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

        return $user;
    }
    public function loginFail($ip){
        //Loginfail et loginFaillCount servent à vérifier si l'utilisateur spam le formulaire de connection
        // On enregistre la tentative échouée pour cette ip
			$req = $this->bdd->prepare('INSERT INTO jf_bruteforce SET connexion_ip = :ip');
            $req->bindValue(':ip', $ip, PDO::PARAM_STR); 
            $req->execute();
    }
    public function loginFailCount($ip){
                // On regarde s'il est autorisé à se connecter
            $req = $this->bdd->prepare('SELECT * FROM jf_bruteforce WHERE connexion_ip = :ip');
            $req->bindValue(':ip', $ip, PDO::PARAM_STR); 
            $req->execute();
            $count = $req->rowCount();

            return $count;

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

    public function resetPassword($params){      //génère un nouveau MDP pour l'accés au compte utilisateur  

        $user_verif_id = $params['id'];
        $user_verif_reset_token = $params['token'];

        $req = $this->bdd->prepare("SELECT id FROM jf_users WHERE reset_token = '$user_verif_reset_token'");
        $req->execute();
        $user_id = $req->fetch();

        if($user_id == false) {
            session_start();
            $_SESSION['flash']['danger'] = "Une erreur est survenue";
            header('Location: https://jogu.fr/forteroche/home');
        }

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

            $req3 = $this->bdd->prepare('UPDATE jf_users SET password = :pwd, reset_at = NULL, reset_token = NULL WHERE id = :id');
            $req3->bindValue(':id', $user_id->id, PDO::PARAM_INT);
            $req3->bindValue(':pwd', $newpass, PDO::PARAM_STR);    
            $req3->execute();
            
            $_SESSION['flash']['reset'] = "Votre nouveau mot de passe est : ";
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
}