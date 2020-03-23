<?php


class Jf_commentManager
{

    private $bdd;

    public function __construct()
    {
        $this->bdd = new PDO("mysql:host=jogufrdkog533.mysql.db:3306;dbname=jogufrdkog533;charset=utf8", "jogufrdkog533", "MaBDD550");
    }

    public function findAll()
    {
        $bdd = $this->bdd;
        
        $query = "SELECT * FROM jf_comment";

        $req = $bdd->prepare($query);
        $req->execute();
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {

            $jf_comment = new Jf_comment();
            $jf_comment->setId($row['id']);
            $jf_comment->setAuteur($row['auteur']);
            $jf_comment->setCreated_at($row['created_at']);
            $jf_comment->setContent($row['content']);
            $jf_comment->setArticle_id($row['article_id']);
            $jf_comment->setReported($row['reported']);
            $jf_comment->setEdited_at($row['reported']);

            $jf_comments[] = $jf_comment;
        };

        return $jf_comments;
    }

    public function find($article_id)
    {
        $bdd = $this->bdd;        
        $query = "SELECT * FROM jf_comment WHERE article_id = :id";

        $req = $bdd->prepare($query);
        $req->bindValue(':id', $article_id, PDO::PARAM_INT);
        $req->execute();
        $jf_comments = $req->fetchAll();
        return $jf_comments;
    }

    public function create($comment, $username, $article_id)
    {
        $bdd = $this->bdd; 
        
        //var_dump($comment);
        //var_dump($username);
        //var_dump($article_id);
        //exit();
      
        $query = "INSERT INTO jf_comment (id, auteur, created_at, content, article_id)
        VALUES (NULL, :auteur, CURRENT_TIMESTAMP, :content, :article_id);";

        $req = $bdd->prepare($query);
        $req->bindValue(':auteur', $username, PDO::PARAM_STR);
        $req->bindValue(':content', $comment, PDO::PARAM_STR);
        $req->bindValue(':article_id', $article_id, PDO::PARAM_INT);
        $req->execute();
    }
    public function report($id)
    {
        $bdd = $this->bdd;      
      
        $query = "UPDATE jf_comment SET `reported` = '1' WHERE `jf_comment`.`id` = :id;";

        $req = $bdd->prepare($query);

        $req->bindValue(':id', $id, PDO::PARAM_INT);

        $req->execute();
    }

    public function delete($id)
    {
        $bdd = $this->bdd;
        $query = "DELETE FROM jf_comment WHERE id = :id";

        $req = $bdd->prepare($query);
        $req->bindValue(':id', $id, PDO::PARAM_INT);

        $req->execute();
    }

    public function edit($values)
    {
        $bdd = $this->bdd;      
      
        $query = "UPDATE jf_comment SET `content` = :content WHERE `jf_comment`.`id` = :id;";

        $req = $bdd->prepare($query);

        $req->bindValue(':id', $values['id'], PDO::PARAM_INT);
        $req->bindValue(':content', $values['content'], PDO::PARAM_STR);

        $req->execute();
    }
}