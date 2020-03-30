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

    public function createComment($params)
    {    
        session_start() ;
        $manager = new Jf_commentManager();
        //var_dump($params["create"]);



       //$article_id = explode("/", $_REQUEST['r'])[1];
       if(isset($params["modification"])) {$this->modifComment($params);}
       if(isset($params["create"])) {$article_id = $params["create"];}

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

    public function reportComment($params)
    {
        $id = $params["id"];
        $manager = new Jf_commentManager();
        $manager->report($id);

        $_SESSION['flash']['success'] = 'Le commentaire a bien été signalé';

        $myView = new View();
        $myView->redirect('home');
    }

    public function modifComment($params) 
    {
        //var_dump($params);
        //exit();
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
           //array(1) { [0]=> array(14) { 
           //    ["id"]=> string(2) "19" [0]=> string(2) "19" 
           //    ["auteur"]=> string(10) "lenycherry" [1]=> string(10) "lenycherry" 
           //    ["created_at"]=> string(19) "2020-03-24 10:43:11" [2]=> string(19) "2020-03-24 10:43:11" 
           //    ["content"]=> string(79) "Commentaire par un autre utilisateur dans le but de tester l'édition d'article" [3]=> string(79) "Commentaire par un autre utilisateur dans le but de tester l'édition d'article" 
           //    ["article_id"]=> string(2) "18" [4]=> string(2) "18" ["reported"]=> string(1) "0" [5]=> string(1) "0" ["edited_at"]=> NULL [6]=> NULL } }

            $myView = new View('com_edit');
            $myView->render(array('jf_comment' => $jf_comment));
        

        } else {
            $jf_comment = new Jf_article();
            $myView = new View('home');
            $myView->render(array('jf_comment' => $jf_comment));
        }
        
    }

    public function addComment($params)
    {
        $values = $_POST['values'];
        $manager = new Jf_commentManager();
        //$manager->create($values);

        $myView = new View();
        $myView->redirect('home');
    }

    public function editionComment($params)
    {
        $values = $_POST['values'];
      //var_dump($params);
      //var_dump($id);
      //exit();

        $manager = new Jf_commentManager();
        $manager->edit($values);

        $myView = new View();
        $myView->redirect('home');
    }

    public function delComment($params)
    {
        extract($params);

        $manager = new Jf_commentManager();
        $manager->delete($id);

        $myView = new View();
        $myView->redirect('home');

    }
    public function showArticle($params)
    {   
        extract($params);
        $manager = new Jf_commentManager();
        $jf_comment = $manager->find($id);
        $myView = new View('article');
        $myView->render(array('jf_comment' => $jf_comment));
    }
    
}



