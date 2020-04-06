<?php


class Jf_comment
{
    private $id;
    private $auteur;
    private $content;
    private $created_at;
    private $article_id;
    private $edited_at;
    private $reported;

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
        if(!preg_match('/^\d/', $this->created_at)){
        setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
        
        $com_date = ucfirst(strftime("%A %d ", strtotime($this->created_at)));
        $com_date .= ucfirst(strftime("%B %Y à %T", strtotime($this->created_at)));
        
        $this->created_at = $com_date;
       
        return $this->created_at;
        } else if ($this->created_at == "Jeudi 01 Janvier 1970 à 01:00:00"){
            $this->created_at = NULL;
            return $this->created_at;
        } else {
            return $this->created_at;
        }

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
    public function getEdited_at()
    {
        if(!preg_match('/^\d/', $this->edited_at)){
            setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
            
            $com_date = ucfirst(strftime("%A %d ", strtotime($this->edited_at)));
            $com_date .= ucfirst(strftime("%B %Y à %T", strtotime($this->edited_at)));
            
            $this->edited_at = $com_date;
           
            return $this->edited_at;
            } else if ($this->edited_at == "Jeudi 01 Janvier 1970 à 01:00:00"){
                $this->edited_at = NULL;
                return $this->edited_at;
            } else {
                return $this->edited_at;
            }
    }
    public function setEdited_at($edited_at)
    {
        $this->edited_at = $edited_at;
    }
}
