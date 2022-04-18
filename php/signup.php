<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "head_mutual.php" ?>
	<link rel="stylesheet" href="../scss-css/style.css">
	<title>Sign Up</title>
</head>
<body>	
	<?php include "connection.php" ?>
	<main>
		<div id="userInput">
			<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" id="formInput" >
				<input type="text" name="username" id="username" placeholder="Username" required>
				<input type="email" name="email" id="email" placeholder="E-Mail" maxlength=22 required>
				<input type="password" name="password" id="password" placeholder="Password" required>
				<input type="submit" value="Sign Up" name="submit" id="submit-btn">
				<p id="userError"><?php
					if(isset($_POST["submit"])){
						$username = $_POST["username"];
						$email = $_POST["email"];
						$password = $_POST["password"];
				
						if(!empty($username) && !empty($password) && !empty($email)){

							$salting = "SELECT randSalt FROM Users";
							$salting_query = mysqli_query($connection, $salting);
								
							$row = mysqli_fetch_assoc($salting_query);
							$salt = $row["randSalt"];

							$username = mysqli_real_escape_string($connection, $username);
							$email = mysqli_real_escape_string($connection, $email);
							$password = mysqli_real_escape_string($connection, $password);
							$time = date("Ymd");

							$enc_password = crypt($password, $salt);
							$register = "INSERT INTO Users(UserID, Username, UserEmail, Password, SignupTime) VALUES(NULL, '$username', '$email', '$enc_password', $time)";
							$register_query = mysqli_query($connection, $register);
							if(!$register_query){
								die(mysqli_error($connection) . mysqli_errno($connection));
								echo "Username already in use.";
							}
							echo "Registration successful.";
						}
					}
				?></p>
				<h3>Already have an account? <a href="login.php">Log in!</a></h3>
			</form>
		</div>
	</main>
	<script src="../javascript/animation.js"></script>
	<script src="../javascript/main.js"></script>
</body>
</html>
