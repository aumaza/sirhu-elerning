<?php

class Password{

// PROPERTIES
	private $user = '';
	private $password = '';

// CONSTRUCTOR
	function __contruct(){
		$this->user = '';
		$this->password = '';
	}

// SETTERS
	private function setUser($var){
		$this->user = $var;
	}

	private function setPassword($var){
		$this->password = $var;
	}

// GETTERS
	private function getUser($var){
		return $this->user = $var;
	}

	private function getPassword($var){
		return $this->password = $var;
	}	

// METHODS


/*
** FORM FOR CHANGING THE PASSWORD
*/
	public function formResetPassword(){

		echo '<div class="container">
				  <div class="jumbotron">
				    <h1><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Reset Password</h1>      
				    <p>Por favor ingrese los datos que solicitaremos para blanquear su password</p><hr>
				    
				     <form id="fr_reset_password_ajax" method="POST">
				      <div class="form-group">
				        <label for="email">Email:</label>
				        <input type="email" class="form-control" id="user" name="user" placeholder="Por favor ingrese su email">
				      </div>
				      <div class="form-group">
				        <label for="pwd_1">Password:</label>
				        <input type="password" class="form-control" id="pwd_1" name="pwd_1" placeholder="Ingrese el password">
				      </div>
				      <div class="form-group">
				        <label for="pwd_2">Repita Password:</label>
				        <input type="password" class="form-control" id="pwd_2" name="pwd_2" placeholder="Ingrese el password nuevamente">
				      </div><br>
				      
				      <div class="alert alert-success">
				        <button type="submit" class="btn btn-default btn-block" id="reset_password" name="reset_password"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Actualizar</button>
				        <button type="reset" class="btn btn-default btn-block"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Limpiar Formulario</button>
				      </div>
				    </form><hr>
				    
				    <div id="messageUpdatePass"></div>

				  </div>
				      
				</div>';

	} // END OF FUNCTION


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
** FUNCTION FOR UPDATE PASSWORD ON THE DATABASE
*/
public function resetPassword($onePassword,$user,$password_1,$password_2,$conn,$dbname){

	mysqli_select_db($conn,$dbname);
	$sql = "select user from se_usuarios where user = $onePassword->getUser('$user')";
	$query = mysqli_query($conn,$sql);
	$rows = mysqli_num_rows($query);

	$validatePass = $onePassword->validatePassword($password_1,$password_2);

	if($rows == 1){

		if($validatePass == 0){

			$passHash = password_hash($password_1, PASSWORD_BCRYPT);

			$sql_1 = "update se_usuarios set password = $onePassword->setPassword('$passHash') where user = $onePassword->getUser('$user')";
			$query_1 = mysqli_query($conn,$sql_1);

			if($query_1){
				echo 1; // PASSWORD SUCCESSFULLY UPDATES
			}else{
				echo -1; // SOMETHING GO WRONG ON UPDATE PASSWORD
			}
		}

		if($validatePass == -1){
			echo 13; // PASSWORDS DON'T MATCH
		}

		if($validatePass == -2){
			echo 11; // PASSWORD WITH CANT OF CHARACTERS WRONG
		}
	}

	if($rows == 0){
		echo 6; // USER UNKNOWN
	}

} // END OF FUNCTION 

} // END OF CLASS



?>