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
 
        if(!empty($comment)){

            $manager = new Jf_commentManager();            
            //$manager->create($comment, $username);  

            $_SESSION['flash']['success'] = 'Votre commentaire a bien été reçu';
            $myView = new View();
            $myView->redirect('home');
        } else {
            //var_dump($_SESSION);
            //exit();
            $_SESSION['flash']['danger'] = 'Vous ne pouvez pas envoyer de commentaire vide';
            $myView = new View();
            $myView->redirect('home');
        }

        
    }

    public function reportComment($params)
    {
        //var_dump($params); --> array(1) { ["id"]=> string(2) "10" }
        //exit();
        $id = $params["id"];
        $manager = new Jf_commentManager();
        $manager->report($id);

        $_SESSION['flash']['success'] = 'Le commentaire a bien été signalé';

        $myView = new View();
        $myView->redirect('home');
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



