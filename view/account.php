<?php session_start();
    require_once (CONTROLLER.'Member.php');
    $member = new Member();
    //$member->logged_only();

    if(!empty($_POST)){
        if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
            $_SESSION['flash']['danger'] = "Les mots de passes ne correspondent pas";
        }else{
            $user_id = $_SESSION['auth']->id;
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            require_once (MODEL.'Jf_userManager.php');
            $req = $bdd->prepare('UPDATE jf_users SET password = ?');
            $req->execute([$password]);

            $_SESSION['flash']['success'] = "Votre mot de passe a bien été mis à jour";
        }
    }
    


?>
<div class="account_header">
<h1>Bonjour <?= $_SESSION['auth']->username; ?></h1>
<h3>Bienvenue dans votre espace membre</h3>
</div>
<div class="account_crud">
    <h3>Agir sur les articles</h3>
    <ul>
        <li class="link_jf">
            <a href="<?php echo HOST;?>create">
                Ajouter
            </a>
        </li>
        <li class="link_jf">
            <a href="<?php echo HOST;?>create">
                Voir
            </a>
        </li>
        <li class="link_jf">
            <a href="<?php echo HOST;?>modification/id/<?php ?>">
                Éditer
            </a>
        </li>
        <li class="link_jf">
            <a href="<?php echo HOST;?>delete/id/<?php ?>">
                Effacer
            </a>
        </li>
    </ul>
</div>

<form class="jf_form jf_form_article" action="" method="post">
    <h3>Changer votre mot de passe</h3>
    <div class="form-group">
        <input class="form-control" type="password" name="password" placeholder="Changer de mot de passe" />
    </div>
    <div class="form-group">
        <input class="form-control" type="password" name="password_confirm" placeholder="Confirmation du mot de passe" />
    </div>
    <button class="button_jf">Changer de mot de passe</button>
</form>