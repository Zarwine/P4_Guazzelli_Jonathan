
    <?php foreach($jf_articles as $jf_article): ?>
        <div class="article_content">
            <h3><?php echo $jf_article->getName();?></h3>
            <p>id = <?php echo $jf_article->getId();?></p><br/>
            <?php echo $jf_article->getContent();?>
            <hr/>
            <button>
                <a href="<?php echo HOST;?>modification/id/<?php echo $jf_article->getId();?>">
                modifier
                </a>
            </button>
            <button class="deleteButton">
                <a href="<?php echo HOST;?>delete/id/<?php echo $jf_article->getId();?>">
                effacer
                </a>
            </button>
        </div>
    <?php endforeach; ?>
