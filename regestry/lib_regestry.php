<?php

class Regestry{

// PROPERTIES
	private $name = '';
	private $email = '';
	private $user = '';
	private $password = '';
	private $avatar = '';
	private $task = '';
	private $role = '';

// CONSTRUCTOR
	function __construct(){
		$this->name = '';
		$this->email = '';
		$this->user = '';
		$this->password = '';
		$this->avatar = '';
		$this->task = '';
		$this->role = '';
	}

// SETTERS
	private function setName($var){
		$this->name = $var;
	}

	private function setEmail($var){
		$this->email = $var;
	}

	private function setUser($var){
		$this->user = $var;
	}

	private function setPassword($var){
		$this->password = $var;
	}

	private function setAvatar($var){
		$this->avatar = $var;
	}

	private function setTask($var){
		$this->task = $var;
	}

	private function setRole($var){
		$this->role = $var;
	}

// GETTERS
	private function getName($var){
		return $this->name = $var;
	}

	private function getEmail($var){
		return $this->email = $var;
	}

	private function getUser($var){
		return $this->celular = $var;
	}

	private function getPassword($var){
		return $this->password = $var;
	}

	private function getAvatar($var){
		return $this->avatar = $var;
	}

	private function getTask($var){
		return $this->task = $var;
	}

	private function getRole($var){
		return $this->role = $var;
	}

/*
** FORM FOR A NEW USER REGISTRATION
*/


public function formRegestry(){

		echo '<div class="container">
					<div class="jumbotron">
					<h2><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Formulario de Registro de Usuario</h2>
					<p>Por favor complete los datos que le solicitamos para poder generar su usuario<hr>
  
				   <form id="fr_new_user_ajax" method="POST" enctype="multipart/form-data">
				    
				    <div class="form-group">
				      <label for="name">Nombre y Apellido:</label>
				      <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese su Nombre y Apellido">
				    </div>

				    <div class="form-group">
				      <label for="email">Email:</label>
				      <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su Email">
				    </div>


				     <div class="form-group">
					  <label for="tasks">Tareas / Funciones:</label>
					  <select class="form-control" id="tasks" name="tasks">
					    <option value="" selected disabled>Seleccionar</option>
					    <option value="1">Sys Admin</option>
					    <option value="2">Usuario</option>
					    <option value="3">Docente</option>
					    <option value="4">Alumno</option>
					  </select>
					</div>

					<div class="alert alert-info">
					  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><strong>Atención!</strong> Puede seleccionar una imagen a modo de Avatar. No es obligatorio realizarlo ahora, padrá agregarla más tarde.
					</div>

					<div class="form-group">
						<label for="my_file">Seleccione archivo:</label>
	  					<input type="file" id="my_file" name="my_file">
  					</div>

  					<div class="alert alert-info">
					  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><strong>Atención!</strong> Para generar su password no utilice fechas de cumpleaños, ni datos filiatorios.
					</div>

				    <div class="form-group">
				      <label for="pwd">Password:</label>
				      <input type="password" class="form-control" id="pwd_1" name="pwd_1" placeholder="Ingrese su password">
				    </div>

				    <div class="form-group">
				      <label for="pwd">Repita Password:</label>
				      <input type="password" class="form-control" id="pwd_2" name="pwd_2" placeholder="Repita su password">
				    </div><br>
				    
				    <div class="alert alert-success">
					    <button type="submit" class="btn btn-default btn-block" id="new_user" name="new_user"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Registrarme</button>
					    <button type="reset" class="btn btn-default btn-block"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Limpiar</button>
				    </div>

				  </form><hr>

				  <div id="messageNewUser"></div>
				  
				</div>
				</div>';

}


/*
** FUNCTION FOR ADD NEW REGESTRY TO DATABASE 
*/
public function addRegestry($oneRegestry,$name,$email,$password_1,$password_2,$file,$task,$dbname,$conn){

	$role = 1;

	if($conn){

		if(((strlen($password_1) >= 10) && (strlen($password_1) <= 15)) && ((strlen($password_2) >= 10) && (strlen($password_2) <= 15))){

			if((strcmp($password_2,$password_1) == 0)){

				mysqli_select_db($conn,$dbname);
                $sql = "select * from se_usuarios where email = '$email' or nombre = '$name'";
                $query = mysqli_query($conn,$sql);
                $rows = mysqli_num_rows($query);

                	if($rows == 0){

                		// se encripta el password
                    	$passHash = password_hash($password_1, PASSWORD_BCRYPT);

                    	if($file != ''){

                    			$targetDir = '../core/avatars/';
								$fileName = $file;
								$targetFilePath = $targetDir . $fileName;

								$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

									   // Allow certain file formats
									    $allowTypes = array('png','jpg');
									    
									    if(in_array($fileType, $allowTypes)){
									    
									       // Upload file to server
									        if(move_uploaded_file($_FILES["my_file"]["tmp_name"], $targetFilePath)){
									        
									        
									        $sql_1 = "INSERT INTO se_usuarios ".
									                "(nombre,
									                  user,
									                  password,
									                  email,
									                  functions,
									                  avatar,
									                  role)".
									                "VALUES ".
									                  "($oneRegestry->setName('$name'),
									            	    $oneRegestry->setEmail('$email'),
									            		$oneRegestry->setPassword('$passHash'),
									            		$oneRegestry->setEmail('$email'),
									            		$oneRegestry->setTask('$task'),
									            		$oneRegestry->setAvatar('$targetFilePath'),
									            		$oneRegestry->setRole('$role'))";
									        
									        mysqli_select_db($conn,$dbname);
									        $query_1 = mysqli_query($conn,$sql_1);

									         
									            if($query_1){
									            

												    echo 1; // sea actualizo la base  y subio bien el archivo
									        
									                       
									            }else{
											  
												   echo 2; // solo se subio el archivo
									            
									            }
									            }else{
												              
									              echo 3; // verificar permisos del directorio
									              
									            }
									            }else{
									    
												  echo 4; // solo archivos png, jpg
									            }
									            

		                    	}if($file == ''){

		                    		$sql_2 = "INSERT INTO se_usuarios ".
									                "(nombre,
									                  user,
									                  password,
									                  email,
									                  functions,
									                  role)".
									                "VALUES ".
									                  "($oneRegestry->setName('$name'),
									            	    $oneRegestry->setEmail('$email'),
									            		$oneRegestry->setPassword('$passHash'),
									            		$oneRegestry->setEmail('$email'),
									            		$oneRegestry->setTask('$task'),
									            		$oneRegestry->setRole('$role'))";
									        
									        mysqli_select_db($conn,$dbname);
									        $query_2 = mysqli_query($conn,$sql_2);

									         
									            if($query_2){
									            

												    echo 1; // registro insertado correctamente
									        
									                       
									            }else{
											  
												   echo -1; // hubo un problema al insertar el registro
									            
									            }
		                    	}

                	}if($rows > 0){
                		echo 6; // USUARIO EXISTENTE
                	}

			}else{
				echo 13; // LOS PASSWORD NO COINCIDEN
			}


		}else{
			echo 11; // LOS PASSWORD DEBEN TENER ENTRE 10 Y 15 CARACTERES
		}
	
	}else{
		echo 7; // NO CONECTION TO DATABASE
	}

} // END OF FUNCTION

} // END OF CLASS

?>