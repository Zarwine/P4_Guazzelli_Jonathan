<?php

class Home 
{
    public function showHome($params)
    {

        $manager = new Jf_articleManager();
        $jf_articles = $manager->findAll();        

        $myView = new View('home');
        $myView->render(array('jf_articles' => $jf_articles));
        
        //include(VIEW.'home.php');
        
    }

    public function createArticle($params)
    {
        extract($params);
        if(isset($id)) {

            $manager = new Jf_articleManager();
            $jf_article = $manager->find($id);

        } else {
            $jf_article = new Jf_article();
        }

        $myView = new View('edit');
        $myView->render(array('$jf_article' => $jf_article));
        
    }

    public function addArticle($params)
    {
        $values = $_POST['values'];

        $manager = new Jf_articleManager();
        $manager->create($values);

        $myView = new View();
        $myView->redirect('home.html');
    }

    public function delArticle($params)
    {
        extract($params);

        $manager = new Jf_articleManager();
        $manager->delete($id);

        $myView = new View();
        $myView->redirect('home.html');

    }
}



//<!-- 
//
//
//Script pour initialiser le module de traitement de texte de Wordpress
//<head>   
//    <script src="https://cdn.tiny.cloud/1/rhmcwo4c3c04oqicyi140d661xaxcuor848zntmj4er65w6b/tinymce/5/tinymce.min.js"
//    referrerpolicy="origin"></script>
//
//    <script>
//        tinymce.init({
//            selector: '#mytextarea'
//        });
//    </script>
//</head>
//
//<body>
//    <h1>
//        TinyMCE Quick Start Guide
//    </h1>
//    <form method="post">
//        <textarea id="mytextarea" name="mytextarea">
//            Hello, World!
//        </textarea>
//    </form>
//</body>
//
//API key:
//rhmcwo4c3c04oqicyi140d661xaxcuor848zntmj4er65w6b -->