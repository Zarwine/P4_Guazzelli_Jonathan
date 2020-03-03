<div id="container">
    <h2>éditer un article</h2>

    <form action="<?php echo HOST;?>edition" method="post">

        <?php if($jf_article->getId()):?>
            <input type="hidden" name="values[id]" value="<?php echo $jf_article->getId();?>"/>
        <?php endif;?>
        Id : <?php echo $jf_article->getId();?><br/>
        Titre : <input type="text" name="values[name]" value="<?php echo $jf_article->getName();?>"/><br/>
        Article : <textarea name="values[content]" ><?php echo $jf_article->getContent();?></textarea><br/>
        <input class="button_edit" type="submit" value="éditer"/>
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

<!--
    API key:
rhmcwo4c3c04oqicyi140d661xaxcuor848zntmj4er65w6b 
-->