<?php
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors',1);
require '../config/config.php';
require '../config/common.php';
if(isset($_SESSION['Username'])){
	echo "<main>";
	require "../templates/header.php"; ?>
	<ul class="nav-wrapper">	
		<li class="list--unformat"><a href="create.php" class="button">Add a new user</a></li>
		<!-- <a href="delete.php" class="button">Delete a User </a> -->
		<li class="list--unformat"><a href="Statusrepondu.php" class="button"> Filtrer par Status Repondu </a></li>
		<li class="list--unformat"><a href="Statuspasrepondu.php" class="button"> Filtrer par Status Pas-Repondu </a></li>
	</ul>
	<ul>	
		<form  method="GET" action="Location.php?>"  id="searchform"> 
			<input  type="text" name="searchLocation"> 
			<input  type="submit" name="submit" value="Search by Location"> 
		</form> 
			<form  method="GET" action="searchuserEmailID.php?>"  id="searchform"> 
			<input  type="text" name="searchEmailID"> 
			<input  type="submit" name="submit" value="Search by EmailID"> 
		</form> 
		<form  method="GET" action="searchusername.php?>"  id="searchform"> 
			<input  type="text" name="searchname"> 
			<input  type="submit" name="submit" value="Search by Name"> 
		</form>
	</ul>
	<?php
	require '../config/config.php';
	//try{
		$connection = new PDO($dsn, $username, $password, $options);
		$sql = "SELECT * FROM user";
		$statement = $connection->prepare($sql);
		$statement->execute();
		$result = $statement->fetchAll();
	/*}catch(PDOException $error) {
	  echo $error->getMessage();
	}*/
	?>

	 <table>
	  <thead>
		<tr>
			
			<th>EmailID</th>
			<th>Location</th>
			<th>Name</th>
			<th>Status</th>
			<th>Password</th>
			<th>Last Login</th>
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
			<td><?php echo ($row["LastLogin"]); ?></td>
			<td><a href="update-user.php?EmailID=<?php echo ($row["EmailID"]); ?>" class = "button">Edit</a></td>
			<td><a href="changestatus.php?EmailID=<?php echo ($row["EmailID"]); ?>" class = "button">Change Status</a></td>
		</tr>
	  <?php endforeach; ?>
	  </tbody>
	</table>


	<?php
	//try{
		$sqla = "SELECT * FROM pdf";
		$stmt = $connection -> prepare($sqla);
		$stmt -> execute();
		$result = $stmt -> fetchAll();
	/*}catch(PDOException $error){
		echo $error->getMessage();
	}*/
	?>
	<!-- <a href="AddUser.php" class = "button">Add User</a> -->

	<form method="post"> 

	<label for="email">EmailID</label> 
	<select name="email">
	<?php foreach ($result as $row) : ?>
	<option value="<?php echo $row['EmailID'];?>"><?php echo $row['EmailID'];?></option>
	<?php endforeach; ?>
	</select>

	<input type="submit" name="adduser" value="Add User"> 
	</form> 

	<?php
	if (isset($_POST['adduser'])){
        //try{
            require '../config/config.php';
            $email = $_POST['email'];
            $add = "INSERT INTO pdf (EmailID) VALUES (:EmailID)";
            $stmt = $connection->prepare($add);
            $stmt -> bindValue(":EmailID",$email);
            $stmt -> execute();
        /*}catch(PDOException $error){
            $error->getMessage();
		}*/
		header('Location: Database.php');
    }?>

  	<table>
	  <thead>
		<tr>
			<th>PDFID</th>
			<th>EmailID</th>
			<th>PDFName</th>
		</tr>
	  </thead>
	  <tbody>
	  <?php foreach ($result as $row) : ?>
		<tr>
			<td><?php echo ($row["PDFID"]); ?></td>
			<td><?php echo ($row["EmailID"]); ?></td>
			<td><?php echo ($row["PDFName"]); ?></td>
			<td><a href="deleteassignedpdf.php?PDFID=<?php echo ($row["PDFID"]); ?>" class = "button">Delete</a></td>
			<td><a href="MET Name KI BISIN LA?EmailID=<?php echo escape($row["EmailID"]); ?>" class = "button">Edit PDF</a></td>
			<td>
			<form action="upload.php?PDFID=<?php echo escape ($row["PDFID"]); ?>" method="POST" enctype="multipart/form-data">
				Select PDF File to Upload:
				<input type="file" name="myfile">
				<button name="btn">Upload</button>
			</form>
			</td>
	  </tr>
	  <?php endforeach; ?>
	  </tbody>
	</table>

	<a href="logout.php" class="button">Logout</a>
</main>
	<?php require "../templates/footer.php"; ?>
<?php }else{
	header('Location: index.php');
}
?>