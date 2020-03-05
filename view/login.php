<?php
require_once (CONTROLLER.'Member.php');
$cookie = new Member();
$cookie->reconnect_from_cookie();

if(isset($_SESSION['auth'])){
    header('Location: account');
    exit();
}

if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {

    require_once (MODEL.'Jf_userManager.php');
    $req = $pdo->prepare('SELECT * FROM jf_users WHERE (username = :username OR email = :username) AND confirmed_at IS NOT NULL');
    $req->execute(['username' => $_POST['username']]);
    $user = $req->fetch();
    if(password_verify($_POST['password'], $user->password)){
        $_SESSION['auth'] = $user;
        $_SESSION['flash']['success'] = 'Vous êtes maintenant connecté';
        if($_POST['remember']){
            require_once (CONTROLLER.'Member.php');
            $mbr = new Member();
            $remember_token = $mbr->str_random(250);
            $pdo->prepare('UPDATE jf_users SET remember_token = ? WHERE id = ?')->execute([$remember_token, $user->id]);
            setcookie('remember', $user->id . '==' . $remember_token . sha1($user->id . 'clefarbitraire'), time() + 60 * 60 * 24 * 7);            
        }
        header('Location: account');
        exit();
    } else {
        $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
    }

}
?>
<h2>Se connecter</h2>

<form class="jf_form" action="" method="POST">
    <div class="form-group">
        <label for="">Pseudo ou email</label>
        <input type="text" name="username" required/>
    </div>
    <div class="form-group">
        <label for="">Mot de passe <a href="forget.php">(Mot de passe oublié ?)</a></label>
        <input type="password" name="password" required/>
    </div>
    <div class="form-group">

            <input class="remember_me" type="checkbox" name="remember" value="1" />Se souvenir de moi
    
    </div>

    <button type="submit" class="button_jf">Se connecter</button>

</form>