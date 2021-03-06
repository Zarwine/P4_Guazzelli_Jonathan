<?php

require_once (MODEL.'Jf_article.php');

class Jf_articleManager //Traite toute la partie BDD des articles du site
{
    private $bdd;
    
    public function __construct()
    {
        $this->bdd = new PDO("mysql:host=jogufrdkog533.mysql.db:3306;dbname=" . BDDNAMEJOGU . ";charset=utf8", BDDNAMEJOGU, BDDPWDJOGU);
    }

    public function findAll() //Trouve tous les articles
    {
        $bdd = $this->bdd;
        
        $query = "SELECT * FROM jf_article ORDER BY id";

        $req = $bdd->prepare($query);
        $req->execute();
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {

            $jf_article = new Jf_article();
            $jf_article->setId($row['id']);
            $jf_article->setName($row['name']);
            $jf_article->setContent($row['content']);
            $jf_article->setCreated_at($row['created_at']);

            $jf_articles[] = $jf_article;

        };

        return $jf_articles;
    }

    public function find($id) //Trouve un article choisi
    {
        $bdd = $this->bdd;      
        
        $query = "SELECT * FROM jf_article WHERE id = :id";
        $bdd = new PDO("mysql:host=jogufrdkog533.mysql.db:3306;dbname=" . BDDNAMEJOGU . ";charset=utf8", BDDNAMEJOGU, BDDPWDJOGU);
        $req = $bdd->prepare($query);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $row = $req->fetch(PDO::FETCH_ASSOC);

        $jf_article = new Jf_article();
        $jf_article->setId($row['id']);
        $jf_article->setName($row['name']);
        $jf_article->setContent($row['content']);
        $jf_article->setCreated_at($row['created_at']);

        return $jf_article;
    
    }

    public function create($values)
    {
        $bdd = $this->bdd;    
      
        $query = "INSERT INTO jf_article (id, name, content, created_at)
        VALUES (NULL, :name, :content, CURRENT_TIMESTAMP);";

        $req = $bdd->prepare($query);
        $req->bindValue(':name', $values['name'], PDO::PARAM_STR);
        $req->bindValue(':content', $values['content'], PDO::PARAM_STR);
        $req->execute();
    }
    public function edit($values)
    {
        $bdd = $this->bdd;      
      
        $query = "UPDATE jf_article SET `name` = :name, `content` = :content WHERE `jf_article`.`id` = :id;";

        $req = $bdd->prepare($query);

        $req->bindValue(':id', $values['id'], PDO::PARAM_INT);
        $req->bindValue(':name', $values['name'], PDO::PARAM_STR);
        $req->bindValue(':content', $values['content'], PDO::PARAM_STR);

        $req->execute();
    }

    public function delete($id)
    {
        $bdd = $this->bdd;
        $query = "DELETE FROM jf_article WHERE id = :id";

        $req = $bdd->prepare($query);
        $req->bindValue(':id', $id, PDO::PARAM_INT);

        $req->execute();
    }
}