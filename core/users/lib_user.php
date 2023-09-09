<?php

class User{
	
// PROPERTIES
	private $name = '';
	private $user = '';
	private $password = '';
	private $email = '';
	private $avatar = '';
	private $tasks = '';
	private $role = '';

// CONSTRUCTOR
	function __construct(){
		$this->name = '';
		$this->user = '';
		$this->password = '';
		$this->email = '';
		$this->avatar = '';
		$this->tasks = '';
		$this->role = '';
	}

// SETTERS
	private function setName($var){
		$this->name = $var;
	}

	private function setUser($var){
		$this->user = $var;
	}

	private function setPassword($var){
		$this->password = $var;
	}

	private function setEmail($var){
		$this->email = $var;
	}

	
	private function setTask($var){
		$this->tasks = $var;
	}

	private function setAvatar($var){
		$this->avatar = $var;
	}

	private function setRole($var){
		$this->role = $var;
	}

// GETTERS
	private function getName($var){
		return $this->name = $var;
	}

	private function getUser($var){
		return $this->user = $var;
	}

	private function getPassword($var){
		return $this->password = $var;
	}

	private function getEmail($var){
		return $this->email = $var;
	}

	
	private function getTask($var){
		return $this->tasks = $var;
	}

	private function getAvatar($var){
		return $this->avatar = $var;
	}

	private function getRole($var){
		return $this->role = $var;
	}		


// METHODS
	public function usersList($oneUser,$conn,$db_dbname){


		$enable = 'Habilitado';
        $disabled = 'Deshabilitado';
        
        if($conn)
        {
            $sql = "SELECT * FROM se_usuarios";
                mysqli_select_db($conn,$db_dbname);
                $resultado = mysqli_query($conn,$sql);
            //mostramos fila x fila
            $count = 0;
   echo '<div class="container-fluid">
	      <div class="jumbotron">
	      <h2>
	      <footer class="container-fluid text-left">
	      <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Usuarios</h2>
	      </footer>
	      <hr>';
          
   echo "<table class='table table-condensed table-hover' style='width:100%' id='usersTable'>";
   echo "<thead>
         <th class='text-nowrap text-center'><span class='label label-default'>Nombre</span></th>
         <th class='text-nowrap text-center'><span class='label label-default'>User</span></th>
         <th class='text-nowrap text-center'><span class='label label-default'>Email</span></th>
         <th class='text-nowrap text-center'><span class='label label-default'>Tareas</span></th>
         <th class='text-nowrap text-center'><span class='label label-default'>Permisos</span></th>
         <th class='text-nowrap text-center'><span class='label label-warning'>Acciones</span></th>
         </thead>";


            while($fila = mysqli_fetch_array($resultado)){
                    // Listado normal
                    echo "<tr>";
                    echo "<td align=center>".$oneUser->getName($fila['nombre'])."</td>";
                    echo "<td align=center>".$oneUser->getUser($fila['user'])."</td>";
                    echo "<td align=center><a href='mailto:".$oneUser->getEmail($fila['email'])."'>".$oneUser->getEmail($fila['email'])."</a></td>";
                    echo "<td align=center>".$oneUser->getTask($fila['functions'])."</td>";
                    if($oneUser->getRole($fila['role']) == 1){
                        echo "<td align=center><span class='label label-success'>".$enable."</span></td>";
                    }else if($oneUser->getRole($fila['role']) == 0){
                        echo "<td align=center><span class='label label-danger'>".$disabled."</span></td>";
                    }
                    echo "<td class='text-nowrap' align=center>";
                    if($oneUser->getUser($fila['nombre']) != 'Administrador'){
                            echo '<a data-toggle="modal" data-target="#modalUserAllow" href="#" data-id="'.$fila['id'].'" class="btn btn-default btn-sm">
                                    <span class="glyphicon glyphicon-link"></span> Cambiar Estado</a>';
                    }
                    echo "</td>";
                    $count++;
                }

                echo "</table>";
                echo "<hr>";
                echo '<footer class="container-fluid text-left"><span class="glyphicon glyphicon-option-vertical" aria-hidden="true"></span> <strong>Cantidad de Usuarios:</strong>  <span class="badge">'.$count.'</span></footer><hr>';
                echo '</div></div>';
                }else{
                echo 'Connection Failure...' .mysqli_error($conn);
                }

            mysqli_close($conn);


	} // END OF FUNCTION


	/*
	** FUNCTION UPDATE ALLOW USER ON DATABASE
	*/
	public function changeAllow($oneUser,$id,$role,$conn,$db_dbname){
    
    if($conn){
    
    mysqli_select_db($conn,$db_dbname);
    $sql = "update se_usuarios set
            role = $oneUser->setRole('$role')
            where id = '$id'";
    $query = mysqli_query($conn,$sql);
    
    if($query){
        echo 1;
    }else{
        echo -1;
    }
    }else{
        echo 7;
    }

} // END OF FUNCTION

	/*
	** FUNCTION MODAL FOR CHANGE ALLOW USERS
	*/
	public function modalChangeAllow(){
    
    echo '<div id="modalUserAllow" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">
                        <span class="glyphicon glyphicon-refresh"></span> Cambiar Permisos de Usuario</h4>
                </div>
                <div class="modal-body">
                    
                    <form id="frm_user_allow" method="POST">
                    <input type="hidden" class="form-control" name="bookId" id="bookId" value="bookId">
                        <div class="form-group">
                            <label for="permisos">Permisos:</label>
                            <select class="form-control" id="permisos" name="permisos">
                                <option value="" selected disabled>Seleccionar</option>
                                <option value="0">Deshabilitar</option>
                                <option value="1">Habilitar</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success" id="cambiar_permiso">
                            <span class="glyphicon glyphicon-ok"></span> Aceptar</button>
                    </form>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <span class="glyphicon glyphicon-remove-circle"></span> Cerrar</button>
                </div>
                </div>

            </div>
            </div>';

} // END OF FUNCTION


/*
** FORM USER INFO
*/
public function formUserInfo($oneUser,$user_id,$conn,$db_basename){

	mysqli_select_db($conn,$db_basename);
	$sql = "select * from se_usuarios where id = '$user_id'";
	$query = mysqli_query($conn,$sql);
	$row = mysqli_fetch_assoc($query);

	$find = 'c';
	$pos = strpos($row['avatar'], $find);

	switch($pos){

		case 3: $imagen = '..'.substr($row['avatar'], 7); break;

		case 6: $imagen = '..'.substr($row['avatar'], 10); break;
	}

	
	echo '<div class="container">
					<div class="jumbotron">
					<h2><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Formulario Edición de datos de Usuario</h2>
					<p>Puede modificar aquellos datos que no se encuentras bloqueados<hr>
					<form action="#" method="POST">
						<button type="submit" class="btn btn-warning btn-sm" name="change_password"> Cambiar Password</button>
					</form><hr>
  
				   <form id="fr_update_user_ajax" method="POST" enctype="multipart/form-data">
				   	<input type="hidden" id="id" name="id" value="'.$user_id.'">
				    
				    <div class="form-group">
				      <label for="name">Nombre y Apellido:</label>
				      <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese su Nombre y Apellido" value="'.$oneUser->getName($row['nombre']).'" readonly>
				    </div>

				    <div class="form-group">
				      <label for="email">Email:</label>
				      <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su Email" value="'.$oneUser->getEmail($row['email']).'" readonly>
				    </div>


				    <div class="alert alert-warning">
					  Tareas / Funciones actuales: <strong>'.$oneUser->getTask($row['functions']). '</strong>. Si cumplirá nuevas tareas, seleccione la correspondiente del listado.-<br>
					  Tenga en cuenta que las nuevas Tareas / Funciones que seleccione no quitarán las anteriores, sino que se sumarán a las existentes.-
					</div>

				     <div class="form-group">
					  <label for="tasks">Tareas / Funciones:</label>
					  <select class="form-control" id="tasks" name="tasks">
					    <option value="" selected disabled>Seleccionar</option>
					    <option value="1">Sys Admin</option>
					    <option value="2">Usuario</option>
					    <option value="3">Alumno</option>
					    <option value="4">Docente</option>
					  </select>
					</div>

					<div class="alert alert-info">
					  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><strong>Atención!</strong> Puede seleccionar una imagen a modo de Avatar. No es obligatorio realizarlo ahora, padrá agregarla más tarde.
					</div>

					<div class="well">';

						if($imagen != '..'){
							echo 'Su imágen actual es la siguiente: <img src="'.$imagen.'" lt="Avatar" class="avatar" > Si desea modificarla seleccione una nueva.';
						}else if($imagen == '..'){
							echo 'Aún no posee una imagen de Avatar. Si desea agregar una, selecciónela desde el botón aquí abajo.-';
						}
				
				echo '</div>

					<div class="form-group">
						<label for="my_file">Seleccione archivo:</label>
	  					<input type="file" id="my_file" name="my_file">
  					</div><br>
				    
				    <div class="alert alert-success">
					    <button type="submit" class="btn btn-default btn-block" id="update_user" name="update_user"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Actualizar</button>
					</div>

				  </form><hr>

				  <div id="messageUpdateUser"></div>
				  
				</div>
				</div>';

} // END OF FUNCTION


/*
** FUNCTION FORM FOR CHANGE PASSWORD
*/
public function changeUserPass($user_id){

	echo '<div class="container">
		  <div class="jumbotron">
		    <h1><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Cambiar Password</h1>      
		    <p>Recuerde no usar fechas de cumpleaños o datos filiatorios para generar sus passwords</p><hr>
		    
		     <form id="fr_change_password_ajax" method="POST">
		     <input type="hidden" id="id" name="id" value="'.$user_id.'">
		      <div class="form-group">
		        <label for="email">Ingrese Password Actual:</label>
		        <input type="password" class="form-control" id="password_actual" name="password_actual">
		      </div>
		      <div class="form-group">
		        <label for="pwd">Password Nuevo:</label>
		        <input type="password" class="form-control" id="pwd_1" name="pwd_1">
		      </div>
		      <div class="form-group">
		        <label for="pwd">Repita Password Nuevo:</label>
		        <input type="password" class="form-control" id="pwd_2" name="pwd_2">
		      </div><br>

		      <div class="alert alert-info">
		      	<button type="submit" class="btn btn-default btn-block" id="change_password"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Aceptar</button>
		      </div>
		    </form><hr>
		    
		    <div id="messageUpdatePassword"></div>

		  </div>        
		</div>';

}


// ====================================================================================================================================================== //
// PERSISTENCE //
// ====================================================================================================================================================== //

/*
** VALIDATE PASSWORD
** @ FIRST PARAMETER $PASSWORD_1
** @ SCOND PARAMETER $PASSWORD_2
** THIS FUNCTION EVALUATES WHAT PASSWORD ARE THE SAME AND GOT A MIN AND MAX CANT OF CHARACTERS
*/
public function validatePassword($password_1,$password_2){

	$limInf = 10;
	$limSup = 15;

	if(((strlen($password_1) >= $limInf) && (strlen($password_1) <= $limSup)) && ((strlen($password_2) >= $limInf) && (strlen($password_2) <= $limSup))){

			if((strcmp($password_2,$password_1) == 0)){
				return 0;
			}else{
				return -1; // THE PASSWORDS DON'T MATCH
			}

	}else{
		return -2; // THE PASSWORDS DON'T HAVE THE CANT OF CHARACTERS CORRECT
	}


} // END OF FUNCTION


/*
** FUNCTION UPDATE USER'S INFO
*/
public function updateUserInfo($oneUser,$id,$task,$file,$conn,$db_basename){

	if($file != ''){

        $targetDir = '../../core/avatars/';
		$fileName = $file;
		$targetFilePath = $targetDir . $fileName;

		$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

		// Allow certain file formats
		$allowTypes = array('png','jpg');
							    
		    if(in_array($fileType, $allowTypes)){
									    
		    // Upload file to server
		        if(move_uploaded_file($_FILES["my_file"]["tmp_name"], $targetFilePath)){

		        	mysqli_select_db($conn,$db_basename);
					$sql = "update se_usuarios set functions = CONCAT_WS(',',functions,$oneUser->setTask('$task')), avatar = $oneUser->setAvatar('$targetFilePath') where id = '$id'";

					$query = mysqli_query($conn,$sql);

						if($query){
							echo 1; // update successfully
						}else{
							echo -1; // update go wrong
						}
				}else{
				echo 3; // user don't have permission 
				}
			}else{
				echo 4; // wrong format
			}

	}

	if($file == ''){

		mysqli_select_db($conn,$db_basename);
		$sql = "update se_usuarios set functions = CONCAT_WS(',',functions,$oneUser->setTask('$task')) where id = '$id'";

		$query = mysqli_query($conn,$sql);

			if($query){
				echo 1; // update successfully
			}else{
				echo -1; // update go wrong
			}
			
	}

} // END OF FUNCTION



/*
** FUNCTION UPDATE USER'S PASS ON DATABASE
*/
public function updatePassword($oneUser,$id,$password_actual,$password_1,$password_2,$conn,$db_basename){

	//password_verify($pass,$hash);
	mysqli_select_db($conn,$db_basename);
	$sql = "select password from se_usuarios where id = '$id'";
	$query = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_array($query)){
		$hash = $row['password'];
	}

		if(password_verify($password_actual, $hash)){

				
				if($oneUser->validatePassword($password_1,$password_2) == 0){

					$passHash = password_hash($password_1, PASSWORD_BCRYPT);

					$sql_1 = "update se_usuarios set password = $oneUser->setPassword('$passHash') where id = '$id'";
					$query_1 = mysqli_query($conn,$sql_1);

						if($query_1){
							echo 1; // succesfully update
						}else{
							echo -1; // something go wrong
						}

				}

				if($oneUser->validatePassword($password_1,$password_2) == -1){
					echo 4; // passwords  don't match
				}

				if($oneUser->validatePassword($password_1,$password_2) == -2){
					echo 6; // passwords without enough characters
				}

		}else{
			echo 3; // ACTUAL PASS DOESN'T MATCH
		}


} // END OF FUNCTION


} // END OF CLASS






?>