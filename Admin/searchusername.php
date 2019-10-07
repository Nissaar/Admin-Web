<?php
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors',1);
if(isset($_SESSION['Username'])){
	require '../config/common.php';
	require '../config/config.php';
	//try{
		$connection = new PDO($dsn, $username, $password, $options);
		$Name = $_GET['searchname'];
		$sql = "SELECT * FROM user WHERE Name = :Name";
		$stmt = $connection -> prepare($sql);
		$stmt -> bindValue('Name',$Name);
		$stmt -> execute();
		$result = $stmt -> fetchAll();
	/*}catch(PDOException $error){
		echo $error->getMessage();
	}*/
	?>


	<?php require "../templates/header.php"; ?>
	<?php if ($result && $stmt->rowCount() > 0){ ?>
	<h2><?php echo $_GET['searchname']; ?></h2>
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
	<?php }else{echo "Pas de Resultat pour " . $_GET['searchname'];}?>
	<a href="Database.php">Back to home</a>
	<?php require "../templates/footer.php"; ?>
	
<?php }else{
	header('Location: index.php');
}
?>