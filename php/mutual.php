<?php include "connection.php" ?>
<?php include "functions.php" ?>

<?php
	if(isset($_GET["logout"])){
		$_SESSION["Username"] = null;
	} 
	if(isset($_SESSION["Username"])){
		$username = $_SESSION["Username"];
		$select_user = "SELECT * FROM Users WHERE Username='$username'";
		$select_user_query = mysqli_query($connection, $select_user);
		if(!$select_user_query){
			die("Query Failed".mysqli_error($connection));
		}
		while($row = mysqli_fetch_assoc($select_user_query)){
			$user_role = $row["UserRole"];
			$profile_pic = "../{$row["ProfilePicture"]}";
			$current_cart = $row["CurrentCart"];
		}

	} else {
		header("Location: login.php");
	}
?>
<div id="navBar">
	<ul>
		<li><a href="main.php" ><p>Home</p></a></li>
		<li><a href="products.php" ><p>Products</p></a></li>
		<li><a href="about.php" ><p>About</p></a></li>
		<li><a href="services.php" ><p>Services</p></a></li>
		<li><a href="social.php"><p>Social</p></a></li>
		<?php
			if($user_role === "admin"){
				echo "<li><a href='admin.php'><p>Admin</p></a></li>";
			}
		?>
		<li><a href=""><img id="profileImg" src="<?php echo $profile_pic?>"></a></li>

	</ul>
</div>
<div id="profileDropdown">
	<ul>
		<li><a href="account_settings.php">Account Settings</a></li>
		<li><a href="purchases.php">Ongoing Purchases</a></li>
		
		<?php 
			if($current_cart === NULL){
				echo '<li><a href="cart.php">View Cart</a></li>';
			} else{
				$products = explode(" ", $current_cart);
				$length = count($products) - 1;
				echo "<li><a href='cart.php'>View Cart <sup><span id='numOfProds'>{$length}</span></sup></a></li>";
			}
		?>
		
		<li><a href="points.php">Points</a></li>
		<li><a href="friends.php">Friends</a></li>
		<li><a href="main.php?logout=true">Log Out</a></li>
	<ul>
</div>
