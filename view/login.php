<?php
require_once (CONTROLLER.'Member.php');
$cookie = new Member();
$cookie->reconnect_from_cookie();

if(isset($_SESSION['auth'])){
    header('Location: account');
    exit();
}

if(!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {
    $userData = $_POST;
    require_once (CONTROLLER.'Member.php');
    $member = new Member();
    $member->login($userData);   
}
?>
<h2>Se connecter</h2>

<form class="jf_form" action="" method="POST">
    <div class="form-group">
        <label for="">Pseudo ou email</label>
        <input type="text" name="username" required/>
    </div>
    <div class="form-group">
        <label for="">Mot de passe <a href="<?php echo HOST;?>forget">(Mot de passe oublié ?)</a></label>
        <input type="password" name="password" required/>
    </div>
    <div class="form-group">

            <input class="remember_me" type="checkbox" name="remember" value="1" />Se souvenir de moi
    
    </div>

    <button type="submit" class="button_jf">Se connecter</button>

</form>