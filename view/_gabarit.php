<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jean Forteroche</title>
    <meta name="description" content="Blog de Jean Forteroche">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo ASSETS;?>img/book-open-solid.svg">
    <link rel="stylesheet" href="<?php echo ASSETS;?>css/style.css">
    <script src="https://cdn.tiny.cloud/1/rhmcwo4c3c04oqicyi140d661xaxcuor848zntmj4er65w6b/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
    <link href="https://fonts.googleapis.com/css?family=Oxygen&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <nav class="navbar">
        <div class="nav-item">
            <a href='https://jogu.fr/forteroche/home'>
                <h1>Jean Forteroche</h1>
            </a>
        </div>
        <ul class="nav-item end-row">            
            <?php if (isset($_SESSION['auth'])): ?>
            <?php if ($_SESSION['auth']->admin == 1): ?>
                <li class="link_jf">
                    <a href="<?php echo HOST;?>create">
                        Ajouter un article 
                    </a>
                </li>
            <?php endif; ?>
                <li class="link_jf">
                    <a href="<?php echo HOST;?>account">
                        Mon compte
                    </a>
                </li>
                <li class="link_jf">
                    <a href="<?php echo HOST;?>logout">
                        Se déconnecter
                    </a>
                </li>
            <?php else: ?>
                <li class="link_jf">
                    <a href="<?php echo HOST;?>register">
                        S'inscrire
                    </a>
                </li>
                <li class="link_jf">
                    <a href="<?php echo HOST;?>login">
                        Se connecter
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<div class="article_container">

<div class="notif">
<?php if(isset($_SESSION['flash'])): ?>
        <?php foreach($_SESSION['flash'] as $type => $message): ?>
            <div class="alert alert-<?= $type; ?>">
                <?= $message; ?>
            </div>
        <?php endforeach; ?>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>
</div>

<?php echo $contentPage; ?>
</div>
<footer>
</footer>
<!--<script>tinymce.init({selector: '#mytextarea'});</script>-->
<script>
    tinymce.init({
      selector: 'textarea#mytextarea',
      //plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker image',
      //toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
      //menubar: "insert",
      toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | image',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
    });
  </script>
</body>
</html>