<?php
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors',1);
	require '../config/config.php';
	if(isset($_POST['submit'])) {
		//try{
		$connection = new PDO($dsn, $username, $password, $options);
			$username = $_POST['Username'];
			$Password = $_POST['Password'];
			if ($username == ''){
				echo('Please Enter Username');
			}elseif ($Password == ''){
				echo('Please Input Password');
			}else{
				//try{
					$stmt = $connection->prepare('SELECT Username,Password FROM admincredential WHERE Username = :Username');
					$stmt->execute(array(
					':Username' => $username
					));
					$data = $stmt->fetch(PDO::FETCH_ASSOC);
					if($data['Password'] == $Password){
						$_SESSION['Username'] = $data['Username'];
						$_SESSION['Password'] = $data['Password'];
						header('Location: Database.php');
						//exit;
						echo $data['Username'];
						echo $data['Password'];
						echo $_SESSION['Username'];
						echo $_SESSION['Password'];
					}else{
						echo('Wrong Username or Password');
					}					
				//}catch(PDOException $error){
				//	echo $error->getMessage();
				//}
			//}
		//}catch(PDOException $error) {
				//echo $error->getMessage();
		}
	}
?>





<main>
<?php require "../templates/header.php"; ?>


<h2>Login</h2>

<form method="post">

    <label for="Username">Username</label>
    <input class="input--block" type="text" name="Username" id="Username">
	<label for="Password">Password</label>
    <input class="input--block" type="Password" name="Password" id="Password">
    <input type="submit" name="submit" value="Submit" class="button--block">
</form>

<a href="../index.php" class="button button--block button--secondary">Back to home</a>
</main>
<?php require "../templates/footer.php"; ?>