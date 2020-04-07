<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
 
?>

        <div class="article_content">
            <h3><?php echo htmlspecialchars($jf_article->getName());?></h3>
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
                    <div class="link_jf link_jf_alert">
                        <a href="<?php echo HOST;?>delete/id/<?php echo $jf_article->getId();?>">
                        Effacer
                        </a>
                    </div>
                </div>
                <?php endif; ?>
            <?php endif; ?>
            
            <br/>

            <?php if (isset($_SESSION['auth'])): ?>
            <form class="comment_create" action="<?php echo HOST;?>comCreate/<?php echo $jf_article->getId();?>" method="POST">
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
                        <p class="com_date">Écrit le : <?php echo dateFormat($jf_comment->getCreated_at());?></p>

                        <?php if($jf_comment->getEdited_at() !== NULL): ?>                                                        
                                <p class="com_date">Édité le : <?php echo dateFormat($jf_comment->getEdited_at());?></p>    
                        <?php endif ?>                       
                        

                        <p><?php echo htmlspecialchars($jf_comment->getContent());?></p>
                    </div> 

                    <div class="com_crud">

                        <?php if (isset($_SESSION['auth'])): ?>

                            <?php if ($jf_comment->getAuteur() == $_SESSION['auth']->username): ?> 
                                <div class="editer link_jf">
                                    <a href="<?php echo HOST;?>comModif/id/<?php echo $jf_comment->getId();?>">
                                    Éditer
                                    </a>
                                </div>                                
                            <?php endif; ?>

                            <?php if ($_SESSION['auth']->admin == "1" || $jf_comment->getAuteur() == $_SESSION['auth']->username): ?>                      
                                <div class="link_jf link_jf_alert">
                                    <a href="<?php echo HOST;?>comDelete/id/<?php echo $jf_comment->getId();?>">
                                    Supprimer ce commentaire
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php if ($jf_comment->getAuteur() != $_SESSION['auth']->username): ?> 
                            <div class="signaler link_jf link_jf_alert">
                                <a href="<?php echo HOST;?>comReport/id/<?php echo $jf_comment->getId();?>">
                                Signaler
                                </a>
                            </div>
                            <?php endif; ?>

                        <?php endif; ?>

                    </div>

                    <?php if (isset($_SESSION['auth'])): ?>
                        <?php if ($_SESSION['auth']->admin == '1'): ?>  
                            <?php if ($jf_comment->getReported() == 1): ?>
                                <p class="reported">Ce commentaire a été signalé</p>  
                            <?php endif; ?>    
                            </section>                            
                        <?php endif; ?>                        
                    <?php endif; ?>

                <?php endforeach; ?>

            <?php endif; ?>     

        </div>


