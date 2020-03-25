
    <?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
require_once (MODEL.'Jf_commentManager.php');
require_once (MODEL.'Jf_comment.php');
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
//$manager->find($article_id);

    $bdd = new PDO("mysql:host=jogufrdkog533.mysql.db:3306;dbname=jogufrdkog533;charset=utf8", "jogufrdkog533", "MaBDD550");     
    $query = "SELECT * FROM jf_comment WHERE article_id = :id ORDER BY id DESC";

    $req = $bdd->prepare($query);
    $req->bindValue(':id', $article_id, PDO::PARAM_INT);
    $req->execute();
    $row = $req->fetchAll();

    for($i = 0 ; $i< count($row); $i++){                

    $jf_comment = new Jf_comment();
    $jf_comment->setId($row[$i]['id']);
    $jf_comment->setAuteur($row[$i]['auteur']);
    $jf_comment->setContent($row[$i]['content']);
    $jf_comment->setCreated_at($row[$i]['created_at']);   
    $jf_comment->setArticle_Id($row[$i]['article_id']);
    $jf_comment->setReported($row[$i]['reported']);
    $jf_comment->setEdited_at($row[$i]['edited_at']);

    $jf_comments[] = $jf_comment;

}

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

            <?php if (isset($_SESSION['auth'])): ?>
            <form class="comment_create" action="" method="POST">
                <p>écrire un commentaire</p>
                <textarea name="commentaire" id="comment_textarea" cols="30" rows="10" placeholder="Votre commentaire..."></textarea>
                <input type="submit" value="Poster mon commentaire" name="submit_commentaire" class="button_jf"/>
            </form>
            <?php else: ?>
                <p>Vous pouvez écrire un commentaire en vous connectant</p>
            <?php endif; ?>    

            <?php if (isset($jf_comments)): ?>

                <?php foreach($jf_comments as $jf_comment): ?>
                    <div class="article_content article_comment">
                        <h3><?php echo $jf_comment->getAuteur();?></h3>
                        <p class="com_date">écrit le : <?php echo $jf_comment->getCreated_at();?></p>
                        
                            <?php if ($jf_comment->getEdited_at() !== null): ?>
                                <p class="com_date">édité le : <?php echo $jf_comment->getEdited_at();?></p>
                            <?php endif; ?>
                        

                        <p><?php echo $jf_comment->getContent();?></p>
                    </div> 

                    <div class="com_crud">
                        <?php if (isset($_SESSION['auth'])): ?>
                            <?php if ($jf_comment->getAuteur() == $_SESSION['auth']->username): ?> 
                                <div class="editer link_jf">
                                    <a href="<?php echo HOST;?>com_modif/id/<?php echo $jf_comment->getId();?>">
                                    Éditer
                                    </a>
                                </div>
                            <?php endif; ?>
                            <div class="signaler link_jf">
                            <a href="<?php echo HOST;?>com_report/id/<?php echo $jf_comment->getId();?>">
                            Signaler
                            </a>
                        </div>
                        <?php endif; ?>

                    </div>

                    <?php if (isset($_SESSION['auth'])): ?>


                        <?php if ($_SESSION['auth']->admin == 1): ?>  
                            <?php if ($jf_comment->getReported() == 1): ?>
                                <p class="reported">Ce commentaire a été signalé</p>  
                            <?php endif; ?>    
                            <div class="button_container">
                                <div class="link_jf">
                                    <a href="<?php echo HOST;?>com_delete/id/<?php echo $jf_comment->getId();?>">
                                    Supprimer le commentaire
                                    </a>
                                </div>
                            </div>
                            </section>
                            
                        <?php endif; ?>
                        
                    <?php endif; ?>

                <?php endforeach; ?>

            <?php endif; ?>     

        </div>


