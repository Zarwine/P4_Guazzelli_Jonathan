<?php

class Comment
{

    public function showArticle($params) //Montre 1 article avec ses com
    {   
        extract($params);
        $manager = new Jf_commentManager();
        $jf_comment = $manager->find($id);
        $myView = new View('article');
        $myView->render(array('jf_comment' => $jf_comment));
    }

    public function createComment($params) //Ajoute le com en BDD, redirige là où se trouvait l'utilisateur
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

                header("Location: https://jogu.fr/forteroche/view/id/".$article_id);

            } else {
                $_SESSION['flash']['alert'] = 'Message vide';
            }
        }  
        
    }

    public function modifComment($params) //Récupère les informations, redirige l'utilisateur vers la page d'édition d'article
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

    public function editionComment($params) //édit le com dans la BDD, redirige l'utilisateur vers l'article correspondant au commentaire
    {
        $values = $_POST['values'];

        $manager = new Jf_commentManager();
        $manager->edit($values);

        session_start();
        $_SESSION['flash']['success'] = 'Le commentaire a bien été édité';

        $jf_comments = $manager->findArticle($values['id']);
        $id = $jf_comments[0]["id"];


        header("Location: https://jogu.fr/forteroche/view/id/".$id);
    }
    
    public function reportComment($params) //change la valeur de "reported" en bdd == 1 et redirige l'utilisateur vers la page ou il se trouvait
    {
        $id = $params["id"];
        $manager = new Jf_commentManager();
        $manager->report($id);
        session_start();
        $_SESSION['flash']['success'] = 'Le commentaire a bien été signalé';


        $jf_comments = $manager->findArticle($id);
        $id_url = $jf_comments[0]["id"];


        header("Location: https://jogu.fr/forteroche/view/id/".$id_url);
    }
    public function acquitComment($params) //change la valeur de "reported" en bdd == 0
    {
        $id = $params["id"];
        $manager = new Jf_commentManager();
        $manager->acquit($id);
        session_start();
        $_SESSION['flash']['success'] = 'Le commentaire a bien été aquité';


        header("Location: https://jogu.fr/forteroche/account");
    }


    public function delComment($params) //supprime le com en bdd, redirige utilisateur là ou il se trouvait
    {
        extract($params);

        $manager = new Jf_commentManager();

        $jf_comments = $manager->findArticle($id);
        $id_url = $jf_comments[0]["id"];

        
        $manager->delete($id);

        session_start();
        $_SESSION['flash']['success'] = 'Le commentaire a bien été supprimé';

        header("Location: https://jogu.fr/forteroche/view/id/".$id_url);
    }

    public function delCommentAdmin($params) //supprime le com en bdd, redirige panneau admin
    {
        extract($params);

        $manager = new Jf_commentManager();
        
        $manager->delete($id);

        session_start();
        $_SESSION['flash']['success'] = 'Le commentaire a bien été supprimé';

        header ("Location : https://jogu.fr/forteroche/account");

    }
    
}



