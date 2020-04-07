<?php session_start();
if($_SESSION['auth']->admin == 0){
    $_SESSION['alert']['danger'] = "Vous n'avez pas l'autorisation d'accéder à cette page";
    header('Location: https://jogu.fr/forteroche');
}
?>
<div id="container" class="page_container">
    <h2>Éditer un article</h2>

    <form class="jf_form" action="<?php echo HOST;?>edition" method="post">

        <?php if($jf_article->getId()):?>
            <input type="hidden" name="values[id]" value="<?php echo $jf_article->getId();?>"/>
        <?php endif;?>
        Numéro d'identifiant de l'article : <?php echo $jf_article->getId();?><br/>
        Nom de l'article: <input type="text" name="values[name]" value="<?php echo $jf_article->getName();?>" required/><br/>
        Contenu de l'article : <textarea id ="mytextarea" name="values[content]" ><?php echo $jf_article->getContent();?></textarea><br/>
        <input class="button_jf" type="submit" value="éditer"/>
    </form>
</div>
