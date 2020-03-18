
    <?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
require_once (MODEL.'Jf_commentManager.php');
$manager = new Jf_commentManager(); 

if(isset($_POST['submit_commentaire'])){
    if(!empty($_POST['commentaire'])){
       //var_dump($_POST['']);
       //exit();

        
        $username =  $_SESSION["auth"]->username;
        $comment = htmlspecialchars($_POST['commentaire']);
        $article_id = $jf_article->getId();
                   
        $manager->create($comment, $username, $article_id);  

        $_SESSION['flash']['success'] = 'Votre commentaire a bien été reçu';
        $myView = new View();
        $myView->redirect('home');
    } else {
        $_SESSION['flash']['alert'] = 'Message vide';
    }
}
$article_id = $jf_article->getId();
$manager->find($article_id);

//var_dump($_SESSION);
?>
        <div class="article_content">
            <h3><?php echo $jf_article->getName();?></h3>
            <?php echo $jf_article->getContent();?>
            <br/>
            
            <?php if (isset($_SESSION['auth'])): ?>
                <?php if ($_SESSION['auth']->admin == 1): ?>              
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
                <?php endif; ?>
            <?php endif; ?>

            <?php foreach($jf_comments as $jf_comment): ?>
            <div class="article_content">
                <h3><?php echo $jf_comment->getAuteur();?></h3>
                <?php echo $jf_comment->getContent();?>
                <br/>
            </div>
            <?php endforeach; ?>

                <div class="signaler">Signaler</div>

            <?php if (isset($_SESSION['auth'])): ?>
                <?php if ($_SESSION['auth']->admin == 1): ?>             
                    <div class="button_container">
                        <div class="link_jf">
                            <a href="<?php echo HOST;?>#">
                            Supprimer le commentaire
                            </a>
                        </div>
                    </div>
                    </section>
                <?php endif; ?>
            <form class="comment_create" action="" method="POST">
                <p>écrire un commentaire</p>
                <textarea name="commentaire" id="comment_textarea" cols="30" rows="10" placeholder="Votre commentaire..."></textarea>
                <input type="submit" value="Poster mon commentaire" name="submit_commentaire"/>
            </form>
            <?php else: ?>
                <p>Vous devez vous connecter pour écrire un commentaire</p>
            <?php endif; ?>         

        </div>