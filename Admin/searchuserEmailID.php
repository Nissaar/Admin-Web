<?php
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors',1);
if(isset($_SESSION['Username'])){
	require '../config/common.php';
	require '../config/config.php';
	//try{
		$connection = new PDO($dsn, $username, $password, $options);
		$EmailID = $_GET['searchEmailID'];
		$sql = "SELECT * FROM user WHERE EmailID = :EmailID";
		$stmt = $connection -> prepare($sql);
		$stmt -> bindValue(':EmailID',$EmailID);
		$stmt -> execute();
		$result = $stmt -> fetchAll();
	/*}catch(PDOException $error){
		echo $error->getMessage();
	}*/
	?>

	<main>
	<?php require "../templates/header.php"; ?>
	<?php if ($result && $stmt->rowCount() > 0){ ?>
	<h2><?php echo $_GET['searchEmailID']; ?></h2>
	<table>
		<thead>
			<tr>
				
				<th>EmailID</th>
				<th>Localité</th>
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
			<td><a href="update-user.php?ID=<?php echo ($row["ID"]); ?>" class = "button">Edit</a></td>
	  </tr>
	  <?php endforeach; ?>
	  </tbody>
	</table>
	<?php }else{echo "Pas de Resultat pour " . $_GET['searchEmailID'];}?>
	<a href="Database.php" class="button button--block button--secondary">Back to home</a>
	</main>
	<?php require "../templates/footer.php"; ?>
<?php }else{
	header('Location: index.php');
}
?>