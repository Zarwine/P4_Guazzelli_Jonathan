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
            $jf_comment->setContent($row['content']);
            $jf_comment->setCreated_at($row['created_at']);

            $jf_comments[] = $jf_comment;
        };

        return $jf_comments;
    }

    public function find($article_id)
    {
        $bdd = $this->bdd;
        $jf_comments = [];
        
        $query = "SELECT * FROM jf_comment WHERE article_id = :id ORDER BY id DESC";

        $req = $bdd->prepare($query);
        $req->bindValue(':id', $article_id, PDO::PARAM_INT);
        $req->execute();
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        //array_map ($row = $req->fetch(PDO::FETCH_ASSOC)) {

            $jf_comment = new Jf_comment();
            $jf_comment->setId($row['id']);
            $jf_comment->setAuteur($row['auteur']);
            $jf_comment->setContent($row['content']);
            $jf_comment->setCreated_at($row['created_at']);            

            $jf_comments[] = $jf_comment;
        //var_dump($jf_comments);      // -> Ce var_dump affiche correctement $jf_comments
        //exit();      
        };      
        var_dump($jf_comments);       //-> Ce var_dump rend la valeur : NULL
        exit();        
        return $jf_comments; //         -> J'ai remarqué que cette ligne s'execute avant la ligne 46.

                                        //Est-ce que tu sais pourquoi stp ?
    
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
    public function edit($values)
    {
        $bdd = $this->bdd;      
      
        $query = "UPDATE jf_comment SET `name` = :name, `content` = :content WHERE `jf_comment`.`id` = :id;";

        $req = $bdd->prepare($query);

        $req->bindValue(':id', $values['id'], PDO::PARAM_INT);
        $req->bindValue(':name', $values['name'], PDO::PARAM_STR);
        $req->bindValue(':content', $values['content'], PDO::PARAM_STR);

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