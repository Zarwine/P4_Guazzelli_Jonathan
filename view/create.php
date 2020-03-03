<div id="container">
    <h2>écrire un article</h2>

    <form action="<?php echo HOST;?>add" method="post">

        <?php if($jf_article->getId()):?>
            <input type="hidden" name="values[id]" value="<?php echo $jf_article->getId();?>"/>
        <?php endif;?>
        Titre : <input type="text" name="values[name]" value="<?php echo $jf_article->getName();?>"/><br/>
        Article : <textarea name="values[content]" ><?php echo $jf_article->getContent();?></textarea><br/>
        <input class="button_edit" type="submit" value="ajouter"/>
    </form>
</div>

<script>tinymce.init({selector: '#mytextarea'});</script>
    <h1>
        TinyMCE Quick Start Guide
    </h1>
    <form method="post">
        <textarea id="mytextarea" name="mytextarea">
            Hello, World!
        </textarea>
    </form>