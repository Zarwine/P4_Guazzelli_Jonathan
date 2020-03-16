
    <?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
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

            <section class="commentaire_container">
                <div class="titre">De "utilisateur" à "date"</div>
                <div class="content">Contenu du commentaire</div>
            </section>

            <?php if (isset($_SESSION['auth'])): ?>
            <?php if ($_SESSION['auth']->admin == 1): ?>             
            <div class="button_container">
                <div class="link_jf">
                    <a href="<?php echo HOST;?>#">
                    Supprimer le commentaire
                    </a>
                </div>
            </div>
            <?php endif; ?>
            <?php endif; ?>

        </div>