<div id="container">
    <h2>écrire un article</h2>

    <form class="jf_form" action="<?php echo HOST;?>add" method="post">

        <?php if($jf_article->getId()):?>
            <input type="hidden" name="values[id]" value="<?php echo $jf_article->getId();?>"/>
        <?php endif;?>
        Nom de l'article : <input type="text" name="values[name]" value="<?php echo $jf_article->getName();?>" required/><br/>
        Contenu de l'article : <textarea id="mytextarea" name="values[content]" ><?php echo $jf_article->getContent();?></textarea><br/>
        <input class="button_jf" type="submit" value="ajouter"/>
    </form>
</div>
