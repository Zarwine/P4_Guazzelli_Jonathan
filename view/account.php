<?php session_start();
    require_once (CONTROLLER.'Member.php');
    $member = new Member();
    //$member->logged_only();
    $userData = $_POST;
    $member->changePassword($userData);  
   //if($_SESSION['auth']->admin == 1){
   //    echo "Salut l'admin";
   //}else {
   //    echo "Salut l'utilisateur lambda";
   //    var_dump($_SESSION);
   //}
   //exit();
   //var_dump($_SESSION);
   //     exit();
?>
<div class="account_header">
<h1>Bonjour <?= $_SESSION['auth']->username; ?></h1>
<h3>Bienvenue dans votre espace membre</h3>
</div>
<?php if ($_SESSION['auth']->admin == 1): ?>

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
                        Éditer
                        </a>
                    </div>
                    <div class="link_jf">
                        <a href="<?php echo HOST;?>delete/id/<?php echo $jf_article->getId();?>">
                        Effacer
                        </a>
                    </div>
                </div>
        </div>
    <?php endforeach; ?>
    </div>
<?php endif; ?>


<?php if ($_SESSION['auth']->admin == 1): ?>
    <div class="account_crud">
        <h3>Agir sur les commentaires</h3>
        <ul>
            <li class="link_jf">
                <a class="view_comment">
                    Voir tous les commentaires
                </a>
            </li>
            <li class="link_jf">
                <a class="view_comment_reported">
                    Voir les commentaires signalés
                </a>
            </li>
        </ul>
    </div>
<?php endif; ?>

    <div id="account_view_comment" class="comment_container container_not_visible">
        <div class="comment_bis">
        <?php foreach($jf_comments as $jf_comment): ?>
            <div class="article_comment">
                <div id="<?php echo $jf_comment->getId();?>" class="comment comment_not_visible">
                    <p>De <?php echo $jf_comment->getAuteur();?></p>
                    <p>Date de création : <?php echo $jf_comment->getCreated_at();?></p>
                    <p>Contenu du commentaire : <?php echo $jf_comment->getContent();?></p>
                    <br/>
                </div>
                <div class="button_container">
                        <div class="link_jf">
                            <a href="<?php echo HOST;?>modification/id/<?php echo $jf_comment->getId();?>">
                            Éditer
                            </a>
                        </div>
                        <div class="link_jf">
                            <a href="<?php echo HOST;?>delete/id/<?php echo $jf_comment->getId();?>">
                            Effacer
                            </a>
                        </div>
                    </div>
            </div>
        <?php endforeach; ?> 

        </div>
    </div>
    <div id="account_view_comment_reported" class="comment_container container_not_visible">
        <div class="reported_comment">
            <?php foreach($jf_comments as $jf_comment): ?>
                <?php if ($jf_comment->getReported() == 1): ?>
                    <div class="article_comment">
                        <div id="<?php echo $jf_comment->getId();?>" class="comment comment_not_visible">
                            <p>De <?php echo $jf_comment->getAuteur();?></p>
                            <p>Date de création : <?php echo $jf_comment->getCreated_at();?></p>
                            <p>Contenu du commentaire : <?php echo $jf_comment->getContent();?></p>
                            <p class="reported">Ce commentaire a été signalé</p>
                            <br/>
                        </div>
                        <div class="button_container">
                                <div class="link_jf">
                                    <a href="<?php echo HOST;?>modification/id/<?php echo $jf_comment->getId();?>">
                                    Éditer
                                    </a>
                                </div>
                                <div class="link_jf">
                                    <a href="<?php echo HOST;?>delete/id/<?php echo $jf_comment->getId();?>">
                                    Effacer
                                    </a>
                                </div>
                        </div>
                    </div>
                <?php endif; ?> 
            <?php endforeach; ?> 
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

<?php if ($_SESSION['auth']->admin == 1): ?>
<script src="<?php echo ASSETS;?>js/account.js"></script>
<?php endif; ?>