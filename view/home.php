
    <?php foreach($jf_articles as $jf_article): ?>
        <div class="article_content">
            <h3><?php echo $jf_article->getName();?></h3>
            <p>id = <?php echo $jf_article->getId();?></p>
            <?php echo $jf_article->getContent();?>
            <br/>
            <div class="button_container">
                <button class="jf_button">
                    <a href="<?php echo HOST;?>modification/id/<?php echo $jf_article->getId();?>">
                    éditer
                    </a>
                </button>
                <button class="jf_button">
                    <a href="<?php echo HOST;?>delete/id/<?php echo $jf_article->getId();?>">
                    effacer
                    </a>
                </button>
            </div>
        </div>
    <?php endforeach; ?>
