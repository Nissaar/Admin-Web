<?php
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors',1);
require '../config/config.php';
require '../config/common.php';
if(isset($_SESSION['Username'])){
    //try{
        $connection = new PDO($dsn, $username, $password, $options);
        $sql = "SELECT EmailID FROM user";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    /* }catch(PDOException $error) {
        echo $error->getMessage();
    }*/

    if (isset($_POST['submit'])){
        //try{
            require '../config/config.php';
            $email = $_POST['email'];
            $add = "INSERT INTO pdf (EmailID) VALUES (:EmailID)";
            $stmt = $connection->prepare($add);
            $stmt -> bindValue(":EmailID",$email);
            $stmt -> execute();
        /*}catch(PDOException $error){
            $error->getMessage();
        }*/
    }?>
<main>
<?php require "../templates/header.php"; ?>
 <form method="post"> 

    <label for="email">EmailID</label> 
    <select name="email">
    <?php foreach ($result as $row) : ?>
    <option value="<?php echo $row['EmailID'];?>"><?php echo $row['EmailID'];?></option>
    <?php endforeach; ?>
    </select>

    <input type="submit" name="submit" value="Submit" class="button--block"> 
 </form> 

 <a href="Database.php" class="button button--block button--secondary">Back to home</a>
</main>
<?php require "../templates/footer.php"; ?><?php

}else{
    header('Location: index.php');
}
?>


