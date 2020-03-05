<?php session_start();
    require_once (CONTROLLER.'Member.php');
    $member = new Member;
    $member->logged_only();

    if(!empty($_POST)){
        if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
            $_SESSION['flash']['danger'] = "Les mots de passes ne correspondent pas";
        }else{
            $user_id = $_SESSION['auth']->id;
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            require_once (MODEL.'Jf_userManager.php');
            $req = $pdo->prepare('UPDATE users SET password = ?');
            $req->execute([$password]);

            $_SESSION['flash']['success'] = "Votre mot de passe a bien été mis à jour";
        }
    }
    


?>
<h1>Bonjour <?= $_SESSION['auth']->username; ?></h1>

<form action="" method="post">
    <div class="form-group">
        <input class="form-control" type="password" name="password" placeholder="Changer de mot de passe" />
    </div>
    <div class="form-group">
        <input class="form-control" type="password" name="password_confirm" placeholder="Confirmation du mot de passe" />
    </div>
    <button class="btn btn-primary">Changer de mot de passe</button>
</form>