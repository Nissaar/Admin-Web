<?php
session_start();
if(isset($_SESSION['Username'])){
	//try{
		require '../config/config.php';
		$connection = new PDO($dsn, $username, $password, $options);
		$sql = "SELECT * FROM user WHERE Status = 'Repondu'";
		$stmt = $connection->prepare($sql);
		$stmt -> execute();
		$result = $stmt->fetchAll();
	/*}catch(PDOException $error){
		echo $error->getMessage();
	}*/
	?>


	<?php require "../templates/header.php"; ?>
	<?php if ($result && $stmt->rowCount() > 0){ ?>
	<h2>Répondu</h2>
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
	  </tr>
	  <?php endforeach; ?>
	  </tbody>
	</table>
	<?php }else{echo "Pas de Resultat pour 'Repondu'";}?>
	<a href="Database.php">Back to home</a>
	<?php require "../templates/footer.php"; ?>
<?php }else{
	header('Location: index.php');
}
?>