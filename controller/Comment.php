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
        //$member->logged_only();
        //$username = $_SESSION["auth"]->username;
        //$comment = $_POST;

         
        //var_dump($params);
        //var_dump($comment);
           // exit();   
        if(!empty($comment)){
        //array(1) { ["auth"]=> object(stdClass)#15 (10) { ["id"]=> string(2) "54" ["username"]=> string(7) "Zarwine" ["email"]=> string(28) 
        //"jonathanguazzelli@hotmail.fr" ["password"]=> string(60) "$2y$10$ZZijtdAJjd2Fpz/2rL9oD.D8j2IpQR5.zKE9W/xbOBNeE4Xh5OCX2" 
        //["confirmation_token"]=> NULL ["confirmed_at"]=> string(19) "2020-03-16 11:17:13" ["reset_token"]=> NULL 
        //["reset_at"]=> NULL ["remember_token"]=> string(0) "" ["admin"]=> string(1) "1" } }
//var_dump($_SESSION["auth"]->username);
//var_dump($_POST);
           //exit();   
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

        //if(isset($params)){
        //    extract($params);
        //}
        //
        //if(isset($id)) {
//
        //    $manager = new Jf_commentManager();
        //    $jf_comment = $manager->find($id);
//
        //    $myView = new View('edit');
        //    $myView->render(array('jf_comment' => $jf_comment));
        //
//
        //} else {
        //    $jf_comment = new Jf_article();
        //    $myView = new View('create');
        //    $myView->render(array('jf_comment' => $jf_comment));
        //}

        
    }

    public function editionArticle($params)
    {

        $values = $_POST['values'];

        $manager = new Jf_commentManager();
        $manager->edit($values);

        $myView = new View();
        $myView->redirect('home');
    }


    public function addArticle($params)
    {
        $values = $_POST['values'];
        $manager = new Jf_commentManager();
        //$manager->create($values);

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



