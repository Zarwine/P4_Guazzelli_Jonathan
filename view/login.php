<?php
session_start();
if(isset($_SESSION['auth'])){
    header('Location: account');
    exit();
}
?>
<div class="page_container">

<h2>Se connecter</h2>

<form class="jf_form" action="<?php echo HOST;?>login_confirm" method="POST">
    <div class="form-group">
        <label for="username">Pseudo ou email</label>
        <input id="username" type="text" name="username" required/>
    </div>
    <div class="form-group">
        <label for="password">Mot de passe <a href="<?php echo HOST;?>forget">(Mot de passe oublié ?)</a></label>
        <input id="password" type="password" name="password" required/>
    </div>
    <button type="submit" class="button_jf">Se connecter</button>

</form>

</div>