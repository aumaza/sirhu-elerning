<?php	include "../connection/connection.php";
		include "../core/lib/lib_system.php";
		include "lib_password.php";

		if($conn){

			$onePassword = new Password();

			$user = mysqli_real_escape_string($conn,$_POST['user']);
			$password_1 = mysqli_real_escape_string($conn,$_POST['pwd_1']);
			$password_2 = mysqli_real_escape_string($conn,$_POST['pwd_2']);

				if(($user == '') ||
					($password_1 == '') ||
						($password_2 == '')){
					echo 5; // THERE'S FIELDS EMPTY
				}else{
					$onePassword->resetPassword($onePassword,$user,$password_1,$password_2,$conn,$dbname);
				}

		}else{
			echo 7; // without connection to database
		}



?>