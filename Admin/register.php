<?php 
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors',1);
//if(isset($_SESSION['Username'])){
	if (isset($_POST['submit'])) {
		require "../config/config.php";
		require "../config/common.php";
		//try  {
			$connection = new PDO($dsn, $username, $password, $options);
				$new_user = array(
				"Username"     => $_POST['Username'],
				"Password"  => $_POST['Password']

			);

			//try{
				$Username = $_POST['Username'];
				//if (filter_var($Username, FILTER_VALIDATE_EMAIL)) {
					if ($_POST['Password'] == $_POST['confirm_Password']){

			$sqld = sprintf(
					"INSERT INTO %s (%s) VALUES (%s) %s",
					"AdminCredential",
					implode(", ", array_keys($new_user)),
					//"'" . implode("', '", array_keys($new_user)) . "'",
					":" . implode(", :", array_keys($new_user)),
					";"
			);


			$statement = $connection->prepare($sqld);
			$statement->execute($new_user);

					}else{ 
						$passErr = "Password do not match";
						echo $passErr;
					}
			//}else{		
			//$emailErr = "Invalid email format";
			//echo $emailErr;
				//}

			/*}catch(PDOException $error) {
			echo $sql . "<br>" . $error->getMessage();
				}*/

		/*}catch(PDOException $error) {
	  echo $sql . "<br>" . $error->getMessage();
		}*/
	} 
	?>

	<?php require "../templates/header.php"; ?>

	<?php if (isset($_POST['submit']) && $statement) { ?>
		<blockquote><?php echo $_POST['Username']; ?> successfully added.</blockquote>
	<?php } ?>

	<h2>Add Admin</h2>

	<form method="post">

		<label for="Username">Username</label>
		<input type="text" name="Username" id="Username">
		<label for="Password">Password</label>
		<input type="Password" name="Password" id="Password">
		<label for="confirm_Password">Confirm Password</label>
		<input type="Password" name="confirm_Password" id="confirm_Password">
		<input type="submit" name="submit" value="Submit">
	</form>

	<a href="Database.php">Back to home</a>

	<?php require "../templates/footer.php"; ?>
<?php /*}else{
	header('Location: index.php');
}*/
?>