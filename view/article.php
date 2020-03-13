
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
            <?php endif; ?>
        </div>