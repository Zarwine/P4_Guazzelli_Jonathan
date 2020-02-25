<?php

class Home 
{
    public function showHome()
    {

        $manager = new Jf_articleManager();
        $jf_articles = $manager->findAll();        

        $myView = new View('home');
        $myView->render(array('jf_articles' => $jf_articles));
        
        //include(VIEW.'home.php');
        
    }

    public function createArticle()
    {
        if(isset($_GET['id'])) {

            $id = $_GET['id'];

            $manager = new Jf_article();
            $jf_article = $manager->find($id);

        } else {
            $jf_article = new Jf_article();
        }

        $myView = new View('edit');
        $myView->render(array('$jf_article' => $jf_article));
        
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