<?php session_start() ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "head_mutual.php" ?>
	<link rel="stylesheet" href="../scss-css/style.css?v=<?php echo time() ?>">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,300;0,400;1,200;1,300&display=swap" rel="stylesheet">
        <title>Log In</title>
</head>
<body>
	<?php include "connection.php" ?>
        <main>
                <div id="userInput">
                        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" id="formInput" >
                                <input type="text" name="username" id="username" placeholder="Username" required>
				<input type="email" name="email" id="email" placeholder="E-Mail" required>
				<input type="password" name="password" id="password" placeholder="Password" required>
                                <input type="submit" value="Log In" name="submit" id="submit-btn">
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

							$get_users = "SELECT * FROM Users WHERE Username='$username'";
							$get_users_query = mysqli_query($connection, $get_users);
							while($row = mysqli_fetch_assoc($get_users_query)){
								$user_id = $row["UserID"];
								$user_username = $row["Username"];
								$user_email = $row["UserEmail"];
								$user_password = $row["Password"];
							}
							if($username === $user_username && $email === $user_email && crypt($password, $salt) === $user_password){
								$_SESSION["Username"] = $username;
								header("Location: main.php");
							} else{
								echo "Invalid username or password";
							}
						}
                                        }
					?></p>
			</form>
                        <h3>Don't have an account? <a href="signup.php">Sign up!</a></h3>
                </div>
        </main>
        <script src="../javascript/animation.js"></script>
        <script src="../javascript/main.js"></script>
</body>
</html>
