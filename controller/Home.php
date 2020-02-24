<?php

class Home 
{
    public function showHome()
    {
        $query = "SELECT * FROM jf_article";
        $bdd = new PDO("mysql:host=jogufrdkog533.mysql.db:3306;dbname=jogufrdkog533;charset=utf8", "jogufrdkog533", "MaBDD550");
        $req = $bdd->prepare($query);
        $req->execute();
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        
            $jf_article['id']          = $row['id']
            $jf_article['name']        = $row['name']
            $jf_article['content']     = $row['content']
            $jf_article['created_at']  = $row['created_at']
        
            $jf_articles[] = $jf_article
        };
        
        include(VIEW.'home.php');
        
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