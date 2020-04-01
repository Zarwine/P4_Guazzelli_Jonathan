
    <?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>

<div class="bienvenue">
    <h1>Bienvenue sur le blog de Jean Forteroche</h1>
</div>
<div class="sidebar">
    <h2>Un billet simple pour l'Alaska</h2>
    <br/>
    <ul>
        <?php foreach($jf_articles as $jf_article): ?>
                <a href="<?php echo HOST;?>view/id/<?php echo $jf_article->getId();?>" class="titre_article"><li><?php echo htmlspecialchars($jf_article->getName());?></li></a>
                <br/>
        <?php endforeach; ?>
    </ul>
</div>
    <?php foreach($jf_articles as $jf_article): ?>
        <div class="article_content">
            <h3 class="titre_article"><?php echo htmlspecialchars($jf_article->getName());?></h3>
            <?php echo $jf_article->getContent();?>
            <br/>
           
            <div class="button_container">
                <div class="link_jf">
                    <a href="<?php echo HOST;?>view/id/<?php echo $jf_article->getId();?>">
                    Commentaires ...
                    </a>
                </div>
            </div>
            <?php if (isset($_SESSION['auth'])): ?>
            <?php if ($_SESSION['auth']->admin == 1): ?>             
            <div class="button_container">
                <div class="link_jf">
                    <a href="<?php echo HOST;?>modification/id/<?php echo $jf_article->getId();?>">
                    Éditer
                    </a>
                </div>
                <div class="link_jf">
                    <a href="<?php echo HOST;?>delete/id/<?php echo $jf_article->getId();?>">
                    Effacer
                    </a>
                </div>
            </div>
            <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
