<?php/*
error_reporting(E_ALL);
ini_set('display_errors',1);
if(isset($_SESSION['Username'])){
	$target_dir = "../uploads/";
$filename = basename($_FILES['myfile']['name']);
$target_file = $target_dir . $filename;
if(isset($_POST['btn'])){
	require '../config/confing.php';
	require '../config/common.php';
	try{
		if (file_exists($target_file)){
			echo "File already exists";
		}else{
			$Num = $_GET['PDFID'];
			if(move_uploaded_file($_FILES['myfile']['tmp_name'],$target_file)){
				try{
					$connection = new PDO($dsn, $username, $password, $options);
					$sql = "UPDATE pdf SET PDFName =:PDFName WHERE PDFID = :PDFID";
					$stmt = $connection->prepare($sql);
					$stmt -> bindParam(":PDFName",$filename, PDO::PARAM_LOB);
					$stmt -> bindParam(":PDFID",$Num, PDO::PARAM_LOB);
					$stmt -> execute();
				}catch(PDOException $error){
					echo "Error!";
				}
			}
		}
	}catch(PDOException $error){
		echo "Error!";
	}
}else{
	echo "Upload Failed";}
}*/?>

<?php/*
error_reporting(E_ALL);
ini_set('display_errors',1);
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["myfile"]["name"]);
$uploadOk = 1;
$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Allow certain file formats
if($FileType != "pdf") {
    echo "Sorry, only PDFF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["myfile"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
*/?>



<?php
//error_reporting(E_ALL);
//ini_set('display_errors',1);
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["myfile"]["name"]);
$filename = basename($_FILES["myfile"]["name"]);
$uploadOk = 1;
$FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$PDFID = $_GET['PDFID'];

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Allow certain file formats
if($FileType != "pdf") {
    echo "Sorry, only PDF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $target_file)) {
		echo "The file ". basename( $_FILES["myfile"]["name"]). " has been uploaded.";
		require '../config/config.php';
		//try{
			$connection = new PDO($dsn, $username, $password, $options);
			$sql = "UPDATE pdf SET PDFName = :PDFName WHERE PDFID = :PDFID";
			//$sql = "INSERT INTO pdf (PDFName) VALUES (:PDFName) WHERE PDFID = :PDFID";
			$stmt = $connection->prepare($sql);
			$stmt -> bindValue(":PDFName",$filename);
			$stmt -> bindValue(":PDFID",$PDFID);
			$stmt -> execute();
		/*}catch(PDOException $error){
			$error->getMessage();
			echo $error;
		}*/
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

