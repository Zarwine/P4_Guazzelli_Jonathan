<?php


class Jf_commentManager
{

    private $bdd;

    public function __construct()
    {
        $this->bdd = new PDO("mysql:host=jogufrdkog533.mysql.db:3306;dbname=jogufrdkog533;charset=utf8", "jogufrdkog533", "MaBDD550");
    }

    public function findAll() //Trouve tous les comment pour le menu d'admin
    {
        $bdd = $this->bdd;
        
        $query = "SELECT * FROM jf_comment  ORDER BY id DESC";

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
            $jf_comment->setEdited_at($row['edited_at']);

            $jf_comments[] = $jf_comment;
        };

        return $jf_comments;
    }
    public function findForOneArticle($article_id)  //Trouve tous les comment pour un article défini
    {
        $bdd = $this->bdd;  
        $query = "SELECT * FROM jf_comment WHERE article_id = :id ORDER BY id DESC";

        $req = $bdd->prepare($query);
        $req->bindValue(':id', $article_id, PDO::PARAM_INT);
        $req->execute();
        $row = $req->fetchAll();

        for($i = 0 ; $i< count($row); $i++){                

        $jf_comment = new Jf_comment();
        $jf_comment->setId($row[$i]['id']);
        $jf_comment->setAuteur($row[$i]['auteur']);
        $jf_comment->setContent($row[$i]['content']);
        $jf_comment->setCreated_at($row[$i]['created_at']);   
        $jf_comment->setArticle_Id($row[$i]['article_id']);
        $jf_comment->setReported($row[$i]['reported']);
        $jf_comment->setEdited_at($row[$i]['edited_at']);

        $jf_comments[] = $jf_comment;

        }
        //var_dump($jf_comments);
        if(isset($jf_comments)) { 
        return $jf_comments;
        }
        //exit();
    }

    public function find($article_id) //Trouve quel commenaitre correspond a quel article
    {
        $bdd = $this->bdd;        
        $query = "SELECT * FROM jf_comment WHERE article_id = :id";

        $req = $bdd->prepare($query);
        $req->bindValue(':id', $article_id, PDO::PARAM_INT);
        $req->execute();
        $jf_comments = $req->fetchAll();

        return $jf_comments;

    }
    public function findArticle($comment_id) //Trouve a quel article correspond le commentaire grace aux infos du commentaires
    {
        $bdd = $this->bdd;        
        $query = "SELECT * FROM jf_comment WHERE id = :id";

        $req = $bdd->prepare($query);
        $req->bindValue(':id', $comment_id, PDO::PARAM_INT);
        $req->execute();
        $jf_comment = $req->fetchAll();

        $article_id = $jf_comment[0]["article_id"];

        $query2 = "SELECT * FROM jf_article WHERE id = :id";

        $req2 = $bdd->prepare($query2);
        $req2->bindValue(':id', $article_id, PDO::PARAM_INT);
        $req2->execute();

        $jf_comments = $req2->fetchAll();

        return $jf_comments;

    }

    public function findComment($id) //Trouve le commentaire
    {
        $bdd = $this->bdd;        
        $query = "SELECT * FROM jf_comment WHERE id = :id";

        $req = $bdd->prepare($query);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();

        while ($row = $req->fetch(PDO::FETCH_ASSOC)){
        
            $jf_comment = new Jf_comment();
            $jf_comment->setId($row['id']);
            $jf_comment->setAuteur($row['auteur']);
            $jf_comment->setCreated_at($row['created_at']);
            $jf_comment->setContent($row['content']);
            $jf_comment->setArticle_id($row['article_id']);
            $jf_comment->setReported($row['reported']);
            $jf_comment->setEdited_at($row['edited_at']);
        
        }
        return $jf_comment;
    }

    public function create($comment, $username, $article_id)
    {
        $bdd = $this->bdd; 
      
        $query = "INSERT INTO jf_comment (id, auteur, created_at, content, article_id)
        VALUES (NULL, :auteur, CURRENT_TIMESTAMP, :content, :article_id);";

        $req = $bdd->prepare($query);
        $req->bindValue(':auteur', $username, PDO::PARAM_STR);
        $req->bindValue(':content', $comment, PDO::PARAM_STR);
        $req->bindValue(':article_id', $article_id, PDO::PARAM_INT);
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

}