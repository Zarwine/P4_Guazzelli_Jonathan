<?php session_start();
?>
<div class="page_container">
<h2>S'inscrire</h2>

<form class="jf_form" action="register_confirm" method="POST">
    <div class="form-group">
        <label for="">Pseudo</label>
        <input type="text" name="username" required/>
    </div>
    <div class="form-group">
        <label for="">Email</label>
        <input type="email" name="email" required/>
    </div>
    <div class="form-group">
        <label for="">Mot de passe</label>
        <input type="password" name="password" required/>
    </div>
    <div class="form-group">
        <label for="">Confirmation du mot de passe</label>
        <input type="password" name="password_confirm" required/>
    </div>

    <button type="submit" class="button_jf">S'inscrire</button>

</form>
</div>