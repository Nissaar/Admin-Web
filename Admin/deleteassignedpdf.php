<?php
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors',1);
require '../config/config.php';
require '../config/common.php';
if(isset($_SESSION['Username'])){
    //try{
        $pdfid = $_GET['PDFID'];
        $connection = new PDO($dsn, $username, $password, $options);
        $sql = "DELETE FROM pdf WHERE (PDFID = :PDFID)";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':PDFID', $pdfid);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    /*}catch(PDOException $error) {
        echo $error->getMessage();
    }*/
    header('Location: Database.php');
}
?>