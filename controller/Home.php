<?php

class Home 
{
    public function showHome($params)
    {

        $manager = new Jf_articleManager();
        $jf_articles = $manager->findAll();        

        $myView = new View('home');
        $myView->render(array('jf_articles' => $jf_articles));
        
    }
    public function showArticle($params)
    {   
        extract($params);
        $art_manager = new Jf_articleManager();
        $jf_article = $art_manager->find($id);

        $comment_manager = new Jf_commentManager();
        $jf_comments = $comment_manager->findForOneArticle($jf_article->getId());  

        $myView = new View('article');
        if($jf_comments == NULL){
            $myView->render(array('jf_article' => $jf_article));
        }else {
            $myView->render(array(            
            'jf_article' => $jf_article,
            'jf_comments' => $jf_comments,
        ));
        }
        
    }

    public function createArticle($params) //Permet de créer ou éditer un article
    {        

        if(isset($params)){
            extract($params);
        }
        
        if(isset($id)) {

            $manager = new Jf_articleManager();
            $jf_article = $manager->find($id);

            $myView = new View('edit');
            $myView->render(array('jf_article' => $jf_article));
        

        } else {
            $jf_article = new Jf_article();
            $myView = new View('create');
            $myView->render(array('jf_article' => $jf_article));
        }
        
    }

    public function editionArticle($params)
    {

        $values = $_POST['values'];

        $manager = new Jf_articleManager();
        $manager->edit($values);

        session_start();
        $_SESSION['flash']['success'] = "L'article a correctement été édité";

        $myView = new View();
        $myView->redirect('home');
    }


    public function addArticle($params)
    {

        $values = $_POST['values'];


        $manager = new Jf_articleManager();
        $manager->create($values);

        session_start();
        $_SESSION['flash']['success'] = "Création d'article réussie";

        $myView = new View();
        $myView->redirect('home');
    }

    public function delArticle($params)
    {
        extract($params);

        $manager = new Jf_articleManager();
        $manager->delete($id);

        session_start();
        $_SESSION['flash']['success'] = "Article correctement supprimé";

        $myView = new View();
        $myView->redirect('home');

    }    
}



