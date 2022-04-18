<?php ob_start() ?>
<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "head_mutual.php" ?>
	<link rel="stylesheet" href="../scss-css/style_account.css?v=<?php echo time(); ?>">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;1,100;1,300;1
,400&display=swap" rel="stylesheet">
        <script src="../engine/jquery-3.6.0.min.js"></script>
	<title>Account Settings</title>

</head>
<body>
	<?php include "mutual.php" ?>

	<?php 
		$getuser = "SELECT * FROM Users WHERE Username='$username'";
		$getuser_query = mysqli_query($connection, $getuser);
		checkQuery($getuser_query, "fetching user");

		while($row = mysqli_fetch_assoc($getuser_query)){
			$profile_pic = $row["ProfilePicture"];
			$profile_description = $row["UserDescription"];
			$nickname = $row["UserNickname"];
		}
	?>

	<h1 id="settings-label">Account Settings</h1>
	<div id="settings-form">
		<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
			<label for="profile-pic">Profile Picture: </label>
			<input type="file" name="profile-pic" id="profile-pic" value="<?php echo $profile_pic ?>">
			<br>
			<label for="profile-desc">Profile Description: </label>
			<textarea name="profile-desc" id="profile-desc" cols=5 rows=3 value="<?php echo $profile_description ?>">
			</textarea>
			<br>
			<label for="profile-nick">Nickname: </label>
			<input type="text" name="profile-nick" id="profile-nick" maxlength=15 value="<?php echo $nickname ?>">
			<br>
			<input type="submit" name="submit">
		</form>
	</div>

	<?php 
		if(isset($_POST["submit"])){
			if($_FILES["profile-pic"]){
				$image = $_FILES["profile-pic"]["name"];
				$tmp_image = $_FILES["profile-pic"]["tmp_name"];

				$target_dir = "/opt/lampp/htdocs/ecomm/images/";
				$target_file = $target_dir.$image;

				$image_ext = pathinfo($image, PATHINFO_EXTENSION);

				if($image_ext === "jpg" or $image_ext === "png" or $image_ext === "jpeg"){
					if(!file_exists($target_file)){
						move_uploaded_file($tmp_image, $target_file);
					}
				}

				$change_image = "UPDATE Users ";
				$change_image .= "SET ProfilePicture='images/{$image}' ";
				$change_image .= "WHERE Username='{$username}'";
				$change_image_query = mysqli_query($connection, $change_image);
				checkQuery($change_image_query, "changing image property on {$username}");
			}
		}
		if(isset($_POST["profile-desc"])){
			$profile_desc = mysqli_real_escape_string($connection, $_POST["profile-desc"]);
			$change_desc = "UPDATE Users ";
			$change_desc .= "SET UserDescription='{$profile_desc}' ";
			$change_desc .= "WHERE Username='{$username}'";
			$change_desc_query = mysqli_query($connection, $change_desc);
			checkQuery($change_desc_query, "changing description property on {$username}");
		}
		if(isset($_POST["profile-nick"])){
			$profile_nickname = mysqli_real_escape_string($connection, $_POST["profile-nick"]);
			$change_nick = "UPDATE Users ";
			$change_nick .= "SET UserNickname='{$profile_nickname}' ";
			$change_nick .= "WHERE Username='{$username}'";
			$change_nick_query = mysqli_query($connection, $change_nick);
			checkQuery($change_nick_query, "changing nickname property on {$username}");
		}
	?>

	<script src="../javascript/animation.js"></script>
	<script src="../javascript/dropdown.js"></script>
</body>
</html>
