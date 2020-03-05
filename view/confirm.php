<?php 


$user_id = $_GET['id'];
$toekn = $_GET['token'];
require (MODEL.'Jf_userManager.php');

$req = $pdo->prepare('SELECT * FROM jf_users WHERE id = ?');

$req->execute([$user_id]);

$user = $req->fetch();

session_start(); 

if($user && $user->confirmation_token == $token) {
        
    $pdo->prepare('UPDATE jf_users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id =?')->execute([$user_id]);
    $_SESSION['flash']['success'] = 'Votre compte a bien été validé';
    $_SESSION['auth'] = $user;
    header('Location: account');
    //<?php echo HOST account
} else {
    $_SESSION['flash']['danger'] = "Ce token n'est plus valide";
    header('Location: login');
}