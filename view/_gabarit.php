<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jean Forteroche</title>
    <meta name="description" content="Blog de Jean Forteroche">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo ASSETS;?>img/book-open-solid.svg">
    <link rel="stylesheet" href="<?php echo ASSETS;?>css/style.css">
</head>
<body>
<header>
    <nav>
        <div class="nav-item">
            <a href='https://jogu.fr/forteroche/home'>
                <h1>Jean Forteroche</h1>
            </a>
        </div>
        <div class="nav-item end-row">
            <button>
                <a href="<?php echo HOST;?>create-article">
                    Ajouter un article 
                </a>
            </button>
        </div>
    </nav>
</header>
<div class="article_container">
<?php echo $contentPage; ?>
</div>

</body>
</html>