<?php/*
//if (isset($_POST['submit'])) {
error_reporting(E_ALL);
ini_set('display_errors',1);
	try{
		require '../config/config.php';
		$connection = new PDO($dsn, $username, $password, $options);
		$sql = "SELECT * FROM user WHERE Location = :Location";
		$location = $_GET['searchLocation'];
		$stmt = $connection->prepare($sql);
		$stmt->bindParam(':Location', $location, PDO::PARAM_STR);
		$stmt -> execute();
		$result = $stmt->fetchAll();
	}catch (PDOException $error){
		echo $error->getMessage();
	}
//}*/
?>

<?php //require "../templates/header.php"; ?>

<?php
//if (isset($_POST['submit'])) {
	//if ($result && $stmt->rowCount() > 0){ ?>
<!--	<h2><?php //echo $location ?></h2>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>EmailID</th>
				<th>Localité</th>
				<th>Name</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?php //foreach ($result as $row) : ?>
			<tr>
				<td><?php// echo ($row["ID"]); ?></td>
				<td><?php// echo ($row["EmailID"]); ?></td>
				<td><?php// echo ($row["Location"]); ?></td>
				<td><?php// echo ($row["Name"]); ?></td>
				<td><?php// echo ($row["Status"]); ?></td>
			</tr>
			<?php// endforeach; ?>
		</tbody>
	</table>
<?php// }else{echo "Pas de resulta pour" . $location;}?> -->
<?php //} ?>
<!--
<h2>Recherché par Localité</h2>

<form method="post">
  <label for="location">Localité</label>
  <input type="text" id="Location" name="Location">
  <input type="submit" name="submit" value="View Results">
</form>
<a href="../Database.php">Back to home</a>
-->
<?php// require "../templates/footer.php"; ?>


<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors',1);
if(isset($_SESSION['Username'])){
	require '../config/common.php';
	require '../config/config.php';
	//try{
		$connection = new PDO($dsn, $username, $password, $options);
		$Location = $_GET['searchLocation'];
		$sql = "SELECT * FROM user WHERE Location = :Location";
		$stmt = $connection -> prepare($sql);
		$stmt -> bindValue(':Location',$Location);
		$stmt -> execute();
		$result = $stmt -> fetchAll();
	/*}catch(PDOException $error){
		echo $error->getMessage();
	}*/
	?>


	<?php require "../templates/header.php"; ?>
	<?php if ($result && $stmt->rowCount() > 0){ ?>
	<h2><?php echo $_GET['searchLocation']; ?></h2>
	<table>
		<thead>
			<tr>
				
				<th>EmailID</th>
				<th>Location</th>
				<th>Name</th>
				<th>Status</th>
				<th>Password</th>
			</tr>
		</thead>
		<tbody>
	<?php foreach ($result as $row) : ?>
		<tr>
			
			<td><?php echo ($row["EmailID"]); ?></td>
			<td><?php echo ($row["Location"]); ?></td>
			<td><?php echo ($row["Name"]); ?></td>
			<td><?php echo ($row["Status"]); ?></td>
			<td><?php echo ($row["Password"]); ?></td>
			<td><a href="update-user.php?ID=<?php echo ($row["EmailID"]); ?>" class = "button">Edit</a></td>
	</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	<?php }}else{echo "No Result For " . $_GET['searchLocation'];}?>
	<a href="Database.php">Back to home</a>
	<?php require "../templates/footer.php"; ?>
