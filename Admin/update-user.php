<?php
session_start();
if(isset($_SESSION['Username'])){
	//error_reporting(E_ALL);
	//ini_set('display_errors',1);
	require '../config/common.php';
	if (isset($_POST['submit'])) {
		//try{
			require '../config/config.php';
			$connection = new PDO($dsn, $username, $password, $options);
			$user = [
				"EmailID"        => $_POST['EmailID'],
				"Location"       => $_POST['Location'],
				"Name"            => $_POST['Name'],
				"Status"         => $_POST['Status'],
				"Password"             => $_POST['Password']
			];
			$sql = "UPDATE user SET EmailID = :EmailID, Location = :Location, Name = :Name, Status = :Status, Password = :Password WHERE EmailID = :EmailID";
			$stmt = $connection -> prepare($sql);
			$stmt -> execute($user);
		/*}catch(PDOException $error){
			echo $error->getMessage();
		}*/
	}

	if (isset($_GET['EmailID'])){
		//try{
			require '../config/config.php';
			$connection = new PDO($dsn, $username, $password, $options);
			$id = $_GET['EmailID'];
			$sqla = "SELECT * FROM user WHERE EmailID = :EmailID";
			$stmt = $connection -> prepare($sqla);
			$stmt -> bindValue('EmailID',$id);
			$stmt -> execute();
			$test = $stmt -> fetch(PDO::FETCH_ASSOC);
		/*}catch(PDOException $error){
			echo $error->getMessage();
		}*/
	}else{
		echo "Something went wrong!";
		exit;
	}
	?>

	<?php require "../templates/header.php"; ?>

	<?php if (isset($_POST['submit']) && $stmt) : ?>
	<?php echo escape($_POST['Name']); ?> successfully updated.
	<?php endif; ?>

	<h2>Edit a user</h2>
	<form method="post">
		<?php foreach ($test as $key => $value) : ?>
		  <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
		  <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'EmailID' ? 'readonly' : null); ?>>
		<?php endforeach; ?>
		<label for="Status">Status</label>
			<select name="Status">
					<option value="Pas-Répondu">Pas-Répondu</option>
					<option value="Répondu">Répondu</option>
			</select>
		<input type="submit" name="submit" value="Submit">
	</form>
	<a href="Database.php">Back to home</a>
	<?php require "../templates/footer.php"; ?>
<?php }else{
	header('Location: index.php');
}
?>
