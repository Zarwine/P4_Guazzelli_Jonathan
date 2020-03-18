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

    public function createArticle($params)
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

        $myView = new View();
        $myView->redirect('home');
    }


    public function addArticle($params)
    {
        //echo '<pre>'; print_r($params); exit;
        $values = $_POST['values'];

        //echo '<pre>'; print_r($values); exit;

        $manager = new Jf_articleManager();
        $manager->create($values);

        $myView = new View();
        $myView->redirect('home');
    }

    public function delArticle($params)
    {
        extract($params);

        $manager = new Jf_articleManager();
        $manager->delete($id);

        $myView = new View();
        $myView->redirect('home');

    }
    public function showArticle($params)
    {   
        extract($params);
        $art_manager = new Jf_articleManager();
        $jf_article = $art_manager->find($id);

        $com_manager = new Jf_commentManager();
        $jf_comments = $com_manager->find($article_id);
        //$jf_comments = $com_manager->find($article_id);
        $myView = new View('article');

       //$manager = new Jf_articleManager();
       //$jf_articles = $manager->findAll();        

       //$myView = new View('home');
       //$myView->render(array('jf_articles' => $jf_articles));

        
        
        $myView->render(array('jf_article' => $jf_article, 'jf_comments' => $jf_comments));
        //$myView->render(array('jf_comments' => $jf_comments));
        
                //if(isset($_POST['submit_commentaire'])){
                //    if(!empty($_POST['commentaire'])){
                //    //var_dump($_POST['']);
                //    //exit();
//
                //        
                //        $username =  $_SESSION["auth"]->username;
                //        $comment = htmlspecialchars($_POST['commentaire']);
                //        $article_id = $jf_article->getId();
                //                
                //        $manager->create($comment, $username, $article_id);  
//
                //        $_SESSION['flash']['success'] = 'Votre commentaire a bien été reçu';
                //        $myView = new View();
                //        $myView->redirect('home');
                //    } else {
                //        $_SESSION['flash']['alert'] = 'Message vide';
                //    }
                //   }
                //   $article_id = $jf_article->getId();
                //   $manager->find($article_id);
    }
    
}



