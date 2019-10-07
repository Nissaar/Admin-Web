<?php
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors',1);
if(isset($_SESSION['Username'])){
	if (isset($_POST['submit'])){
		require '../config/config.php';
		require '../config/common.php';
		//try{
			$connection = new PDO($dsn, $username, $password, $options);
			//try{
				$EmailID = $_POST['EmailID'];
				$new_user = array(
					"EmailID" => $_POST['EmailID'],
					"Name" => $_POST['Name'],
					"Location" => $_POST['Location'],
					//"Status" => $_POST['Status'],
					//"Password" => $_POST['Password']
				);
				if (filter_var($_POST['EmailID'], FILTER_VALIDATE_EMAIL)) {
					$sql = sprintf(
					"INSERT INTO %s (%s) VALUES (%s) %s",
					"user",
					implode(", ", array_keys($new_user)),
					//"'" . implode("', '", array_keys($new_user)) . "'",
					":" . implode(", :", array_keys($new_user)),
					";");
					$stmt = $connection->prepare($sql);
					$stmt->execute($new_user);

					$sqlz = "INSERT INTO pdf (EmailID) VALUES (:EmailID)";
					$stmt = $connection -> prepare($sqlz);
					$stmt->execute(array(':EmailID' => $_POST['EmailID']));
				}else{
					echo "Invalid Email Address. Please Re-Enter Email Address";
				}
				header("Location: Database.php");
			/*}catch(PDOException $error){
				$error->getMessage();
			}*/
		/*}catch(PDOException $error){
			$error->getMessage();
		}*/
	}

	?>
	<?php require "../templates/header.php"; ?>

	<h2>Add a user</h2>

	<form method="post">

		<label for="EmailID">Email Address</label>
		<input type="text" name="EmailID" id="EmailID">
		<label for="Location">Location</label>
		<input type="text" name="Location" id="Location">
		<label for="Name">Name</label>
		<input type="text" name="Name" id="Name">
		<!-- <label for="Password">Password</label>
		<input type="text" name="Password" id="Password"> 
	   <label for="Status">Status</label>
	   <select name="Status">
	  <option value="Pas-Répondu">Pas-Répondu</option>
	  <option value="Répondu">Répondu</option>
	   </select> -->
		<input type="submit" name="submit" value="Submit">
	</form>

	<a href="Database.php">Back to home</a>

	<?php require "../templates/footer.php"; ?>
<?php }else{
	header('Location: index.php');
}
?>