<?php 
	if(isset($_GET["prom"])){
		$id = $_GET["prom"];
		$promote = "UPDATE Users ";
		$promote .= "SET UserRole='admin' ";
		$promote .= "WHERE UserID=$id";
		$promote_query = mysqli_query($connection, $promote);
		if(!$promote_query){
			die("Couldn't promote user $id: ".mysqli_errno($connection));
		}
		header("Location: admin.php?source=manage_users");
	} else if(isset($_GET["deprom"])){
		$promote = "UPDATE Users ";
		$promote .= "SET UserRole='user' ";
		$promote .= "WHERE UserID={$_GET["deprom"]}";
		$promote_query = mysqli_query($connection, $promote);
                if(!$promote_query){
                        die("Couldn't depromote user $id: ".mysqli_errno($connection));
                }
		header("Location: admin.php?source=manage_users");
	} else if(isset($_GET["del"])){
		$delete = "DELETE FROM Users ";
		$delete .= "WHERE UserID={$_GET["del"]}";
		$delete_query = mysqli_query($connection, $delete);
                if(!$delete_query){
                        die("Couldn't delete user $id: ".mysqli_errno($connection));
                }
		header("Location");
	}
?>

<!--User Management-->
<table id="users-table">
	<thead>
		<th><a href="admin.php?source=manage_users&sort=Username">Username</a></th>
		<th><a href="admin.php?source=manage_users&sort=UserEmail">Email</a></th>
		<th><a href="admin.php?source=manage_users&sort=UserID">UserID</a></th>
		<th><a href="admin.php?source=manage_users&sort=UserRole">Role</a></th>
		<th><a href="admin.php?source=manage_users&sort=SignupTime">Signup Time</a></th>
		<th><a href="">----</a></th>
		<th><a href="">----</a></th>
	</thead>
	<tbody>
		<?php 

			if(isset($_GET["sort"])){
				$sort = $_GET["sort"];
			} else{
				$sort = "UserID";
			}
			$get_users = "SELECT * FROM Users ";
			$get_users .= "ORDER BY $sort ASC";

			$get_users_query = mysqli_query($connection, $get_users);
			if(!$get_users_query){
				die("Failed to fetch users: ".mysqli_errno($connection));
			}

			while($row = mysqli_fetch_assoc($get_users_query)){
				$username = $row["Username"];
				$email = $row["UserEmail"];
				$userid = $row["UserID"] ;
				$userrole = $row["UserRole"];
				$signuptime = $row["SignupTime"];
				$message = "<tr> \n";
				$message .= "<td>{$username}</td> \n";
				$message .= "<td>{$email}</td> \n";
				$message .= "<td>{$userid}</td> \n";
				$message .= "<td>{$userrole}</td> \n";
				$message .= "<td>{$signuptime}</td> \n";
				switch($userrole){
					case "user":
						$message .= "<td><a href='admin.php?source=manage_users&prom=$userid'>Promote</a></td> \n";
						break;
					case "admin":
						$message .= "<td><a href='admin.php?source=manage_users&deprom=$userid'>Depromote</a></td> \n";
						break;
				}
				$message .= "<td><a href='admin.php?source=manage_users&del=$userid'>Delete</a></td> \n";
				$message .= "</tr>";

				echo $message;
			}
		?>		
	</tbody>
</table>
