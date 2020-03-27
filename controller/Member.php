<?php
require_once(MODEL . 'Jf_userManager.php');
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
    public function showAccount($params)
    {

        $manager = new Jf_articleManager();
        $jf_articles = $manager->findAll();
        $com_manager = new Jf_commentManager();
        $jf_comments = $com_manager->findAll();

        $myView = new View('account');
        $myView->render(array('jf_articles' => $jf_articles, 'jf_comments' => $jf_comments));
        //$myView->render(array('jf_comments' => $jf_comments));

    }

    public function registerConfirm($params)
    {

        $userManager = new Jf_userManager();

        $validation = $userManager->verifToken($params);

        if ($validation === true) {
            $_SESSION['flash']['success'] = 'Votre compte a bien été validé';
            header('Location: https://jogu.fr/forteroche/home');
        } else {
            $_SESSION['flash']['danger'] = "Ce token n'est plus valide";
            header('Location: https://jogu.fr/forteroche/home');
        }
    }
    public function resetPassword($params)
    {

        $userManager = new Jf_userManager();

        $userManager->resetPassword($params);
    }

    public function verifAll()
    {

        session_start();

        $userData = $_POST;

        $userManager = new Jf_userManager();
        //$errors = $userManager->verifName($userData);
        $errors = array();

        if (empty($userData['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $userData['username'])) {
            $errors['username'] = "Votre pseudo n'est pas valide";
        } else {
            if ($userManager->verifName($userData) == true) {
                $errors['username'] = "Ce pseudo est déja pris";
            }
        }

        if (empty($userData['email']) || !filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Votre email n'est pas valide";
        } else {
            if ($userManager->verifEmail($userData) == true) {
                $errors['email'] = "Cet email est déja utilisé pour un autre compte";
            }
        }

        if (empty($userData['password']) || $userData['password'] != $userData['password_confirm']) {
            $errors['password'] = "Votre mot de passe n'est pas valide";
        }


        if (empty($errors)) {
            $userManager->addMember($userData);
        } else {
            $danger = 'danger danger-register 0';

            foreach ($errors as $error) {

                $_SESSION['flash'][$danger] = $error;
                $danger++;
            }

            header('Location: register');

            exit();
        }
    }
    public function login()
    {

        if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {

            sleep(1);
            session_start();
            $ip = $_SERVER['REMOTE_ADDR'];
            $userData = $_POST;
            $userManager = new Jf_userManager();
            $user = $userManager->login($userData);
            $count = $userManager->loginFailCount($ip);

            if ($user !== false) {
                if ($count >= 10) {
                    $_SESSION['flash']['danger'] = 'Nombre de tentatives autorisées dépassé, vous êtes banni pour une heure';
                    header('Location: login');
                    exit();
                } else if (password_verify($userData['password'], $user->password)) {
                    $_SESSION['auth'] = $user;
                    $_SESSION['flash']['success'] = 'Vous êtes maintenant connecté';
                    header('Location: account');
                    exit();
                } else {

                    $userManager->loginFail($ip);
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
    }

    public function forgetPassword()
    {

        session_start();

        if (!empty($_POST) && !empty($_POST['email'])) {
            $userData = $_POST;
            $userData = str_replace(array("\n", "\r", PHP_EOL), '', $userData);
            $userManager = new Jf_userManager();
            $user = $userManager->forgetPassword($userData);

            if ($user !== false) {
                session_start();
                $reset_token = $this->str_random(60);
                $userManager->updateToken($user, $reset_token);

                $_SESSION['flash']['success'] = 'Les instructions du rappel de mot de passe vous ont été envoyées par email';
                mail($userData['email'], 'Reinitialisation du mot de passe - Jogu.fr', "Afin de reinitialiser votre mot de passe, merci de cliquer sur ce lien\n\nhttps://jogu.fr/forteroche/reset/id/$user->id/token/$reset_token");

                header('Location: login');
                exit();
            } else {
                $_SESSION['flash']['danger'] = 'Aucun compte ne correspond à cette adresse';
                header('Location: login');
            }
        }
    }
    public function logout()
    {

        session_start();
        setcookie('remember', NULL, -1);
        unset($_SESSION['auth']);
        $_SESSION['flash']['success'] = "Vous êtes maintenant déconnecté";
        header('Location: login');
    }

    public function str_random($length)
    {

        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }

    public function logged_only()
    {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";
        header('Location: login.php');
        exit();
    }

    public function changePassword()
    {
        session_start();
        $userData = $_POST;
        if (!empty($userData)) {
            if (empty($userData['password']) || $userData['password'] != $userData['password_confirm']) {
                $_SESSION['flash']['danger'] = "Les mots de passes ne correspondent pas";
                header('Location: account');
            } else {
                $userManager = new Jf_userManager();
                $userManager->changePassword($userData);

                $_SESSION['flash']['success'] = "Votre mot de passe a bien été mis à jour";
                header('Location: account');
            }
        }
    }
}
