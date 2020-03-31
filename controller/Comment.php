<?php

class Comment
{
    public function showHome($params)
    {

        $manager = new Jf_commentManager();
        $jf_comments = $manager->findAll();        

        $myView = new View('home');
        $myView->render(array('jf_comments' => $jf_comments));
        
    }
    public function showArticle($params)
    {   
        extract($params);
        $manager = new Jf_commentManager();
        $jf_comment = $manager->find($id);
        $myView = new View('article');
        $myView->render(array('jf_comment' => $jf_comment));
    }
    public function createComment($params)
    {    
        session_start() ;
        $manager = new Jf_commentManager();

       $article_id = explode("/", $_REQUEST['r'])[1];

        if(isset($_POST['submit_commentaire'])){
            if(!empty($_POST['commentaire'])){       
                
                $username =  $_SESSION["auth"]->username;
                $comment = htmlspecialchars($_POST['commentaire']);
                
                           
                $manager->create($comment, $username, $article_id);  
        
                $_SESSION['flash']['success'] = 'Votre commentaire a bien été reçu';
                $myView = new View();
                $myView->redirect('home');
            } else {
                $_SESSION['flash']['alert'] = 'Message vide';
            }
        }  
        
    }
    
    public function addComment($params)
    {
        $values = $_POST['values'];
        $manager = new Jf_commentManager();

        $myView = new View();
        $myView->redirect('home');
    }

    public function modifComment($params) //Récupère les informations et redirige l'utilisateur vers la page d'édition d'article
    {
        if(isset($params)){
            extract($params);
        }
        
        if(isset($id)) {
            session_start();
            $manager = new Jf_commentManager();
            $jf_comment = $manager->findComment($id);

            $verif = $jf_comment->getAuteur();

            if($verif != $_SESSION["auth"]->username){
                $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'éditer ce commentaire";
                $myView = new View();
                $myView->redirect('home');
            }
            $myView = new View('com_edit');
            $myView->render(array('jf_comment' => $jf_comment));
        

        } else {
            $jf_comment = new Jf_article();
            $myView = new View('home');
            $myView->render(array('jf_comment' => $jf_comment));
        }
        
    }

    public function editionComment($params)
    {
        $values = $_POST['values'];

        $manager = new Jf_commentManager();
        $manager->edit($values);

        session_start();
        $_SESSION['flash']['success'] = 'Le commentaire a bien été édité';

        $myView = new View();
        $myView->redirect('home');
    }
    
    public function reportComment($params)
    {
        $id = $params["id"];
        $manager = new Jf_commentManager();
        $manager->report($id);
        session_start();
        $_SESSION['flash']['success'] = 'Le commentaire a bien été signalé';

        $myView = new View();
        $myView->redirect('home');
    }


    public function delComment($params)
    {
        extract($params);

        $manager = new Jf_commentManager();
        $manager->delete($id);

        session_start();
        $_SESSION['flash']['success'] = 'Le commentaire a bien été supprimé';

        $myView = new View();
        $myView->redirect('home');

    }
    
}



