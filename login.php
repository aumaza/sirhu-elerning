<?php	session_start();

		include "connection/connection.php";
		include "core/lib/lib_system.php";


		if($conn){

			$user = mysqli_real_escape_string($conn,$_POST['user']);
			$pass = mysqli_real_escape_string($conn,$_POST['pwd']);

				if(($user == '') ||
						($pass == '')){
					echo 5; // MUST BE FILL DE FIELDS
				}else{
					logIn($user,$pass,$conn,$db_basename);
				}

		}else{
			echo 7; // CONNECTION FAILURE
		}



?>