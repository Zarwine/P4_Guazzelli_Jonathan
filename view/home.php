
    <?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>

<div class="bienvenue">
    <h1>Bienvenue sur le blog de Jean Forteroche</h1>
</div>
<div class="sidebar">
    <h2>Billet simple pour l'Alaska</h2>
    <br/>
    <ul>
        <?php foreach($jf_articles as $jf_article): ?>
                <a href="<?php echo HOST;?>view/id/<?php echo $jf_article->getId();?>" class="titre_article"><li><?php echo htmlspecialchars($jf_article->getName());?></li></a>
                <br/>
        <?php endforeach; ?>
    </ul>
</div>
<div class="btn_container">
        <div id="slider_prev"><img class="icon-burger" src="<?php echo ASSETS;?>img/arrow-circle-left-solid.svg"></div>
        <div id="slider_next"><img class="icon-burger" src="<?php echo ASSETS;?>img/arrow-circle-right-solid.svg"></div>
    </div>
<div class="titre_livre article_content diapo_visible">
    <h1>Billet simple pour l'Alaska</h1>
    <p>À l'heure du tout connecté et de l'omniprésence des réseaux sociaux, nous (Jean Forteroche et les personnes concernées par le projet) avons décidé de transposer le nouveau récit de Jean Forteroche en ligne, sous la forme de chapitres périodiques et interactifs, afin d'établir une communication bilatérale qu'empêche le support papier.
Ce roman est un cadeau pour vous, la communauté de lecteurs qui s'est constituée au fil des histoires abracadabrantesques dont seul Jean Forteroche détient le secret. Un cadeau pour faire entendre votre voix, et pour vous récompenser de votre indéfectible loyauté.</p>
<p>Cliquez sur les flèches pour naviguer entre les chapitres </p>
</div>
<div class="diapo_container">
    <?php foreach($jf_articles as $jf_article): ?>
        <div class="article_content diapo_invisible">
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
    
</div>
<script src="<?php echo ASSETS;?>js/diaporama.js"></script>