<?php


class Jf_comment
{
    private $id;
    private $auteur;
    private $content;
    private $created_at;
    private $article_id;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getAuteur()
    {
        return $this->auteur;
    }
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    } 
    public function getContent()
    {
        return $this->content;
    }
    public function setContent($content)
    {
        $this->content = $content;
    } 
    public function getCreated_at()
    {
        return $this->created_at;
    }
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
    }
    public function getArticle_Id()
    {
        return $this->article_id;
    }
    public function setArticle_Id($article_id)
    {
        $this->article_id = $article_id;
    }
    public function getReported()
    {
        return $this->reported;
    }
    public function setReported($reported)
    {
        $this->reported = $reported;
    }
}
