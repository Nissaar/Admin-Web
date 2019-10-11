<?php
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors',1);
	require 'config/config.php';
	if(isset($_POST['submit'])) {
        //try {
            $connection = new PDO($dsn, $username, $password, $options);
			$username = $_POST['Username'];
			$Password = $_POST['Password'];
			if ($username == ''){
				echo('Please Enter Username');
			}elseif ($Password == ''){
				echo('Please Input Password');
			}else{
                //try {
                    $sql = "SELECT Username,Password FROM admincredential WHERE Username = :Username";
                    $stmt = $connection->prepare($sql);
                    $stmt -> bindValue(":Username",$username);
                    $stmt -> execute();
                    $result = $stmt-> fetch(PDO::FETCH_ASSOC);
                    if ($result['Password'] == $Password) {
                        $_SESSION['Username'] = $result['Username'];
                        $_SESSION['Password'] = $result['Password'];
                        header('Location: admin/Database.php');
                    } else {
                        $sqla = "SELECT EmailID,Password FROM user WHERE EmailID = :EmailID";
						$stmta = $connection->prepare($sqla);
						$stmta->bindValue(":EmailID",$username);
						$stmta -> execute();
						$data = $stmta->fetch(PDO::FETCH_ASSOC);
						if($data['Password'] == $Password){
							$_SESSION['Username'] = $data['EmailID'];
                            $_SESSION['Password'] = $data['Password'];
                            $sqlb = "SELECT LastLogin FROM user WHERE EmailID = :EmailID";
                            $stmtb = $connection->prepare($sqlb);
                            $stmtb->bindValue(":EmailID",$username);
                            $stmtb->execute();
                            $resulta = $stmtb->fetchColumn();
                            if ($resulta == "0000-00-00 00:00:00") {
                                //echo ("Bon");
                                
                                header("Location: User/resetpassword.php?=".$username);
                            } else {
                                header('Location: User/Database.php');;
                            }
                            
                        }else {
                            echo "WRONG USERNAME OR PASSWORD PLEASE TRY AGAIN";
                        }
                    }
                    
                /*} catch (PDOException $error) {
                    echo $error->getMessage();
                }
            }
        } catch (PDOException $error) {
            echo $error->getMessage();*/
        }
    }
?>

<?php require "templates/header.php"; ?>




        <div class="container">
            <div class="row">
                <div class="col-3 offset-4">
                    <h2>Login<h2>
                </div>
            </div>
            <div class="row">
                <div class="col-4 offset-4">
                    <form method="post">
                        <div class="form-group">
                            <label for="Username">Username</label>
                            <input type="email" class="form-control" id="Username" name="Username" placeholder="Enter username">
                        </div>
                        <div class="form-group">
                            <label for="Password">Password</label>
                            <input type="password" name="Password" class="form-control" id="Password" placeholder="Password">
                        </div>
                        <button type="submit"  name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <div class="row">
               <div class="col-3 offset-4">
                    <a href="index.php">Back to home</a>
               </div>
            </div>
        </div>



<?php require "templates/footer.php"; ?>
