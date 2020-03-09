<?php
if(!empty($_POST) && !empty($_POST['email']) ) {
    require_once (MODEL.'Jf_userManager.php');

    $req = $bdd->prepare('SELECT * FROM jf_users WHERE email = ? AND confirmed_at IS NOT NULL');
    $req->execute([$_POST['email']]);
    $user = $req->fetch();
    if($user){
        session_start();
        require (CONTROLLER.'Member.php');
        $member= new Member();
        $reset_token = $member->str_random(60);
        $bdd->prepare('UPDATE jf_users SET reset_token = ?, reset_at = NOW() WHERE id = ?')->execute([$reset_token, $user->id]);
        $_SESSION['flash']['success'] = 'Les instructions du rappel de mot de passe vous ont été envoyées par email';
        mail($POST['email'], 'Réinitialisation du mot de passe - Jogu.fr', "Afin de réinitialiser votre mot de passe, merci de cliquer sur ce lien\n\nhttps://jogu.fr/forteroche/confirm.php?id={$user->id}&token=$reset_token");
    
        header('Location: login');
        exit();
    } else {
        $_SESSION['flash']['danger'] = 'Aucun compte ne correspond à cette adresse';
    }

}
?>
<h2>Mot de passe oublié</h2>

<form class="jf_form" action="" method="POST">
    <div class="form-group">
        <label for="">Email</label>
        <input type="email" name="email" required/>
    </div>
    <button type="submit" class="button_jf">Se connecter</button>

</form>