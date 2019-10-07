<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors',1);
require '../config/config.php';
require '../config/common.php';
if(isset($_SESSION['Username'])){
    $connection = new PDO($dsn, $username, $password, $options);
	//try{
        $emailID = $_GET['EmailID'];
		$sql = "SELECT Status FROM user WHERE EmailID = :EmailID";
        $statement = $connection->prepare($sql);
        $statement -> bindValue(":EmailID",$emailID);
		$statement->execute();
        //$result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $result = $statement->fetchColumn();
	/*}catch(PDOException $error) {
	  echo $error->getMessage();
    }*/
    //echo $result[0];
    //echo $result;
    if( $result == "Répondu"){
        //echo "Bon la";
        //try {
            $sqla = "UPDATE user SET Status = 'Pas-Répondu' WHERE EmailID = :EmailID";
            $stmt = $connection->prepare($sqla);
            $stmt -> bindValue(":EmailID",$emailID);
            $stmt->execute();
        /*} catch (PDOException $error) {
            echo $error->getMessage();
        }*/
    }elseif ($result == "Pas-Répondu") {
        //echo "Pas-Bon la";
        //try {
            $sqlb = "UPDATE user SET Status = 'Répondu' WHERE EmailID = :EmailID";
            $stmt = $connection->prepare($sqlb);
            $stmt -> bindValue(":EmailID",$emailID);
            $stmt->execute();
        /*} catch (PDOException $error) {
            echo $error->getMessage();
        }*/
    }
    header("Location: Database.php");
}
?>