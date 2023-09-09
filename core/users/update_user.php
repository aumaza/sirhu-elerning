<?php	include "../../connection/connection.php";
		include "lib_user.php";

		if($conn){

			$oneUser = new User();

			$id = mysqli_real_escape_string($conn,$_POST['id']);
			$task = mysqli_real_escape_string($conn,$_POST['tasks']);
			$file = basename($_FILES["my_file"]["name"]);

			if($id == ''){
				echo 5; // there are fields empty
			}else{
				$oneUser->updateUserInfo($oneUser,$id,$task,$file,$conn,$db_basename);
			}

		}else{
			echo 7; // connection failure
		}




?>