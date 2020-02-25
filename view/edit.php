<div id="container">
    <h2>Ajouter un article</h2>

    <form action="update.php" method="post">

        <?php if($jf_article->getId()):?>
            <input type="hidden" name="values[id]" value="<?php echo $jf_article->getId();?>"/>
        <?php endif;?>

        Titre : <input type="text" name="values[name]" value="<?php echo $jf_article->getName();?>"/><br/>
        Article : <textarea name="values[content]" ><?php echo $jf_article->getContent();?></textarea><br/>
        <input type="submit" value="ajouter"/>
    </form>
</div>