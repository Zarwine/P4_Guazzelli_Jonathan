<?php session_start();
    require_once (CONTROLLER.'Member.php');
    $member = new Member();
    //$member->logged_only();
    $userData = $_POST;
    $member->changePassword($userData);  
?>
<div class="account_header">
<h1>Bonjour <?= $_SESSION['auth']->username; ?></h1>
<h3>Bienvenue dans votre espace membre</h3>
</div>
<div class="account_crud">
    <h3>Agir sur les articles</h3>
    <ul>
        <li class="link_jf">
            <a href="<?php echo HOST;?>create">
                Ajouter un article
            </a>
        </li>
        <li class="link_jf">
            <a class="view_account">
                Voir les articles existants
            </a>
        </li>
    </ul>
</div>
<div id="account_view_article" class="article_container container_not_visible">
<?php foreach($jf_articles as $jf_article): ?>
    <div class="article_content">
        <a href="<?php echo HOST;?>view/id/<?php echo $jf_article->getId();?>" class="titre_article"><h3><?php echo $jf_article->getName();?></h3></a>
        <div id="<?php echo $jf_article->getId();?>" class="article article_not_visible">
            <p>id = <?php echo $jf_article->getId();?></p>
            <?php echo $jf_article->getContent();?>
            <br/>
        </div>
        <div class="button_container">
                <div class="link_jf">
                    <a href="<?php echo HOST;?>modification/id/<?php echo $jf_article->getId();?>">
                    éditer
                    </a>
                </div>
                <div class="link_jf">
                    <a href="<?php echo HOST;?>delete/id/<?php echo $jf_article->getId();?>">
                    effacer
                    </a>
                </div>
            </div>
    </div>
<?php endforeach; ?>
<div class="current_view_article">
    <?php if(isset($currentArticle)){
    echo $currentArticle;
    } ?>
</div>
</div>
<div class="account_gestion">
    <h2>Gestion du compte</h2>

    <form class="jf_form jf_form_article" action="" method="post">
        <h3>Changer votre mot de passe</h3>
        <div class="form-group">
            <input class="form-control" type="password" name="password" placeholder="Changer de mot de passe" />
        </div>
        <div class="form-group">
            <input class="form-control" type="password" name="password_confirm" placeholder="Confirmation du mot de passe" />
        </div>
        <button class="button_jf">Changer de mot de passe</button>
    </form>
</div>