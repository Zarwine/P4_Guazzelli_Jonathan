<?php include('_head.php');?>
<?php include('_header.php');?>

    <?php foreach($jf_articles as $jf_article): ?>
        <div class="article_content">
            <h3><?php echo $jf_article['name'];?></h3>
            <?php echo $jf_article['content'];?>
            <hr/>
            <button>
                <a href="edit.php?id=<?php echo $jf_article['id'];?>">
                modifier
                </a>
            </button>
            <button class="deleteButton">
                <a href="delete.php?id=<?php echo $jf_article['id'];?>">
                effacer
                </a>
            </button>
        </div>
    <?php endforeach; ?>
<?php include('_footer.php'); ?>