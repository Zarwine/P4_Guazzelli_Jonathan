
    <?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>
    <?php foreach($jf_articles as $jf_article): ?>
        <div class="article_content">
            <h3><?php echo $jf_article->getName();?></h3>
            <p>id = <?php echo $jf_article->getId();?></p>
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
    <?php endforeach; ?>
