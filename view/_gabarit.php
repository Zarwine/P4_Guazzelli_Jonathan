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
    <link href="https://fonts.googleapis.com/css?family=Amita&display=swap" rel="stylesheet">
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
            <li class="button_header">
                <a href="<?php echo HOST;?>create">
                    Ajouter un article 
                </a>
            </li>
            <?php if (isset($_SESSION['auth'])): ?>
                <li class="button_header">
                    <a href="logout.php">
                        Se déconnecter
                    </a>
                </li>
            <?php else: ?>
                <li class="button_header">
                    <a href="<?php echo HOST;?>register">
                        S'inscrire
                    </a>
                </li>
                <li class="button_header">
                    <a href="<?php echo HOST;?>login">
                        Se connecter
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<div class="article_container">

    <?php if(isset($_SESSION['flash'])): ?>
        <?php foreach($_SESSION['flash'] as $type => $message): ?>
            <div class="alert alert-<?= $type; ?>">
                <?= $message; ?>
            </div>
        <?php endforeach; ?>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

<?php echo $contentPage; ?>
</div>

</body>
</html>