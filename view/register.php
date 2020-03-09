<?php 

session_start();

if(!empty($_POST)){

    $errors = array();
    require_once (MODEL.'Jf_userManager.php');
    $bdd = new PDO("mysql:host=jogufrdkog533.mysql.db:3306;dbname=jogufrdkog533;charset=utf8", "jogufrdkog533", "MaBDD550");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);    

    if(empty($_POST['username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['username'])) {
        $errors['username'] = "Votre pseudo n'est pas valide";
    } else {
        $req = $bdd->prepare('SELECT id FROM jf_users WHERE username =?');
        $req->execute([$_POST['username']]);
        $user = $req->fetch();
        if($user){
            $errors['username'] = "Ce pseudo est déja pris";
        }
    }

    if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Votre email n'est pas valide";
    } else {
        $req = $bdd->prepare('SELECT id FROM jf_users WHERE email =?');
        $req->execute([$_POST['email']]);
        $user = $req->fetch();
        if($user){
            $errors['email'] = "Cet email est déja utilisé pour un autre compte";
        }
    }

    if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {
        $errors['password'] = "Votre mot de passe n'est pas valide";
    }


    if(empty($errors)){
    $req = $bdd->prepare("INSERT INTO jf_users SET username = ?, password = ?, email = ?, confirmation_token = ?");
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $member = new Member();

    $token = $member->str_random(60);

    $req->execute([$_POST['username'], $password, $_POST['email'], $token]);

    $user_id = $bdd->lastInsertId();

    mail($_POST['email'], 'Confirmation de votre compte', "Afin de valider votre compte, merci de cliquer sur ce lien\n\nhttps://jogu.fr/forteroche/confirm/id/$user_id/token/$token");
    
    $_SESSION['flash']['success'] = 'un email de confirmation vous a été envoyé pour valider votre compte';

    header('Location: login');
    exit();
    }

    
}

?>

<h2>S'inscrire</h2>

<?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
        <p>Vous n'avez pas rempli le formulaire correctement</p>
        <ul>
            <?php foreach($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif; ?>

<form class="jf_form" action="" method="POST">
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