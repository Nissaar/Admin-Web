<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors',1);
require '../config/config.php';
require '../config/common.php';
$connection = new PDO($dsn, $username, $password, $options);
if (isset($_SESSION['Username'])) {
    //echo ($_SESSION['Username']);
    try {
        $sql = "SELECT PDFName FROM pdf WHERE EmailID = :EmailID";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue(":EmailID",$_SESSION['Username']);
        $stmt->execute();
        $result = $stmt->fetchAll();
    } catch (PDOException $error) {
        echo $error->getMessage();
    }
?>

<?php require "../templates/header.php"; ?>

<table>
    <thead>
        <tr>
            <th>Row 1</th>
            <!-- <th>Row 2</th>
            <th>Row 3</th>
            <th>Row 4</th>
            <th>Row 5</th> -->
        </tr>
    </thead>
    <tbody>
        <?php foreach ($result as $row) : ?>
            <tr>
                <td><?php echo ($row["PDFName"]);?></td>
                <td><a href="editpdf.php?PDFName=<?php echo ($row["PDFName"]); ?>" class = "button">Edit</a></td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>

<?php } else {
    header("Location: ../index.php");
    //echo("Error");
}

?>