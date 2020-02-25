
    <?php foreach($jf_articles as $jf_article): ?>
        <div class="article_content">
            <h3><?php echo $jf_article->getName();?></h3>
            <?php echo $jf_article->getContent();?>
            <hr/>
            <button>
                <a href="edit.php?id=<?php echo $jf_article->getId();?>">
                modifier
                </a>
            </button>
            <button class="deleteButton">
                <a href="delete.php?id=<?php echo $jf_article->getId();?>">
                effacer
                </a>
            </button>
        </div>
    <?php endforeach; ?>
