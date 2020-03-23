<?php
if(!empty($_POST) && !empty($_POST['email']) ) {
    $userData = $_POST;

    require_once (CONTROLLER.'Member.php');
    $memberForget = new Member();
    $memberForget->forgetPassword($userData);
}
?>
<div class="page_container">
<h2>Mot de passe oublié</h2>

<form class="jf_form" action="" method="POST">
    <div class="form-group">
        <label for="">Email</label>
        <input type="email" name="email" required/>
    </div>
    <button type="submit" class="button_jf">Réinitialiser mon mot de passeé</button>

</form>
</div>