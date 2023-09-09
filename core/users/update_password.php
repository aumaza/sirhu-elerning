<?php	include "../../connection/connection.php";
		include "lib_user.php";


		if($conn){

			$oneUser = new User();

			$id = mysqli_real_escape_string($conn,$_POST['id']);
			$password_actual = mysqli_real_escape_string($conn,$_POST['password_actual']);
			$password_1 = mysqli_real_escape_string($conn,$_POST['pwd_1']);
			$password_2 = mysqli_real_escape_string($conn,$_POST['pwd_2']);

				if(($id == '') ||
					($password_actual == '') ||
						($password_1 == '') ||
							($password_2 == '')){
					echo 5; //there are empty fields
				}else{
					$oneUser->updatePassword($oneUser,$id,$password_actual,$password_1,$password_2,$conn,$db_basename);
				}


		}else{
			echo 7; // connection failure
		}





?>