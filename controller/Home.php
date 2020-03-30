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

        $myView = new View('article');
        $myView->render(array('jf_article' => $jf_article));
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

        $myView = new View();
        $myView->redirect('home');
    }


    public function addArticle($params)
    {

        $values = $_POST['values'];


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
}



