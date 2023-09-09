<?php	include "../connection/connection.php";
		include "../core/lib/lib_system.php";
		include "lib_regestry.php";

		if($conn){

			$oneRegestry = new Regestry();

			$name = mysqli_real_escape_string($conn,$_POST['name']);
			$email = mysqli_real_escape_string($conn,$_POST['email']);
			$task = mysqli_real_escape_string($conn,$_POST['tasks']);
			$file = basename($_FILES["my_file"]["name"]);
			$password_1 = mysqli_real_escape_string($conn,$_POST['pwd_1']);
			$password_2 = mysqli_real_escape_string($conn,$_POST['pwd_2']);

				if(($name == '') ||
					($email == '') ||
						($task == '') ||
								($password_1 == '') ||
									($password_2 == '')){
					echo 15; // HAY CAMPOS SIN COMPLETAR
				}else{
					$oneRegestry->addRegestry($oneRegestry,$name,$email,$password_1,$password_2,$file,$task,$dbname,$conn);
				}

		}else{
			echo 5; // CONECTION FAILURE
		}



?>