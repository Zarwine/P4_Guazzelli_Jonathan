<?php session_start();
?>
<div class="page_container">
<h2>S'inscrire</h2>

<form class="jf_form" action="register_confirm" method="POST">
    <div class="form-group">
        <label for="username">Pseudo</label>
        <input id="username" type="text" name="username" required/>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" required/>
    </div>
    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input id="password" type="password" name="password" required/>
    </div>
    <div class="form-group">
        <label for="password_confirm">Confirmation du mot de passe</label>
        <input id="password_confirm" type="password" name="password_confirm" required/>
    </div>

    <button type="submit" class="button_jf">S'inscrire</button>

</form>
</div>