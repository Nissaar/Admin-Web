<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors',1);
require '../config/config.php';
require '../config/common.php';
$connection = new PDO($dsn, $username, $password, $options);
$emailid = $_SESSION['Username'];
if (isset($_SESSION['Username'])) {
    if(isset($_POST['submit'])){
        $password = $_POST['Password'];
        $sql = "UPDATE user SET Password = :Password WHERE EmailID = :EmailID";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":EmailID",$emailid);
        $stmt->bindValue(":Password",$password);
        $stmt -> execute();
        $sqla = "UPDATE user SET LastLogin = CURRENT_TIMESTAMP WHERE EmailID = :EmailID";
        $stmta = $connection->prepare($sqla);
        $stmta->bindValue(":EmailID",$username);
        $stmta->execute();
        header('Location: ../index.php');
    }
}
?>

<?php require "../templates/header.php"; ?>


<h2>Reset Password<h2>

<form method="post">

	<label for="Password">Password</label>
    <input type="Password" name="Password" id="Password">
    <input type="submit" name="submit" value="Submit">

</form>

<a href="../index.php">Back to home</a>

<?php require "../templates/footer.php"; ?>
