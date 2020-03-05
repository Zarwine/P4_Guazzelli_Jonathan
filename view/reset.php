<?php
if(isset($_GET['id']) && isset($_GET['token'])){
    require_once (MODEL.'Jf_userManager.php');
    $req = $pdo->prepare('SELECT * FROM jf_users WHERE id = ? AND reset_token IS NOT NULL AND token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');
    $req->execute([$_GET['id'], $_GET['token']]);
    $user = $req->fetch();
    if($user){
        if(!empty($_POST)){
            if(!empty($_POST['password']) && $_POST['password_confirm']){
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $pdo->prepare('UPDATE jf_users SET password = ?, reset_at = NULL, reset_token = NULL')->execute([$password]);
                session_start();
                $_SESSION['flash']['success'] = "Votre mot de passe a bien été modifié";
                $_SESSION['auth'] = $user;
                header('Location: account');
                exit();
            }
        }
    }else{
        session_start();
        $_SESSION['flash']['danger'] = "Ce token n'est pas valide";
        header('Location: login');
        exit();
    }
}else{
    header('Location: login');
    exit();
}
?>
<h2>Réinitialisation du mot de passe</h2>

<form class="jf_form" action="" method="POST">
    <div class="form-group">
        <label for="">Mot de passe <a href="forget.php">(Mot de passe oublié ?)</a></label>
        <input type="password" name="password" required/>
    </div>
    <div class="form-group">
        <label for="">Confirmation du mot de passe</label>
        <input type="password" name="password_confirm" required/>
    </div>

    <button type="submit" class="button_jf">Réinitialiser mon mot de passe</button>

</form>