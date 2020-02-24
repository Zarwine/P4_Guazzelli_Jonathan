<?php
include_once('config.php');

if(isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = "SELECT * FROM jf_article WHERE id = :id";
    $bdd = new PDO("mysql:host=jogufrdkog533.mysql.db:3306;dbname=jogufrdkog533;charset=utf8", "jogufrdkog533", "MaBDD550");
    $req = $bdd->prepare($query);
    $req->bindValue(':id', $id, PDO::PARAM_INT);
    $req->execute();
    $row = $req->fetch(PDO::FETCH_ASSOC);

    $jf_article['id']           = $row['id'];
    $jf_article['name']         = $row['name'];
    $jf_article['content']      = $row['content'];
    $jf_article['created_at']   = $row['created_at'];

} else {
    $jf_article['id']           = null;
    $jf_article['name']         = null;
    $jf_article['content']      = null;
    $jf_article['created_at']   = null;
}

;?>

<?php include('_head.php');?>
<?php include('_header.php');?>

    <div id="container">
        <h2>Ajouter un article</h2>

        <form action="update.php" method="post">

            <?php if($jf_article['id']):?>
                <input type="hidden" name="values[id]" value="<?php echo $jf_article['id'];?>"/>
            <?php endif;?>

            Titre : <input type="text" name="values[name]" value="<?php echo $jf_article['name'];?>"/><br/>
            Article : <textarea name="values[content]" ><?php echo $jf_article['content'];?></textarea><br/>
            <input type="submit" value="ajouter"/>
        </form>
    </div>
<?php include('_footer.php');?>