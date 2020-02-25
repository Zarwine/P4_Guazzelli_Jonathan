<?php


class Jf_articleManager
{

    private $bdd;

    public function __construct()
    {
        $this->bdd = new PDO("mysql:host=jogufrdkog533.mysql.db:3306;dbname=jogufrdkog533;charset=utf8", "jogufrdkog533", "MaBDD550");
    }

    public function findAll()
    {
        $bdd = $this->bdd;
        
        $query = "SELECT * FROM jf_article";

        $req = $bdd->prepare($query);
        $req->execute();
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {

            $jf_article = new Jf_article();
            $jf_article->setId($row['id']);
            $jf_article->setName(['name']);
            $jf_article->setContent(['content']);
            $jf_article->setCreated_at(['created_at']);

            $jf_articles[] = $jf_article;
        };

        return $jf_articles;
    }

    public function find($id)
    {
        
   
        
        $query = "SELECT * FROM jf_article WHERE id = :id";
        $bdd = new PDO("mysql:host=jogufrdkog533.mysql.db:3306;dbname=jogufrdkog533;charset=utf8", "jogufrdkog533", "MaBDD550");
        $req = $bdd->prepare($query);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $row = $req->fetch(PDO::FETCH_ASSOC);

        $jf_article = new Jf_article();
        $jf_article->setId($row['id']);
        $jf_article->setName(['name']);
        $jf_article->setContent(['content']);
        $jf_article->setCreated_at(['created_at']);

        return $jf_article;
    
    }
}