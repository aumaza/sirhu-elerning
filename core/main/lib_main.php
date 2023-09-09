<?php

function mainNavBar($nombre,$avatar){
	

	echo '<nav class="navbar navbar-inverse">
			  <div class="container-fluid">
			    <div class="navbar-header">
			    <form action="#" method="POST">
			      <button class="btn btn-default btn-sm navbar-btn" type="submit" name="home"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> SIRHU E-lerning</button>
			    </form>
			    </div>

			    <ul class="nav navbar-nav">
			      
			      <button type="button" class="btn btn-default btn-sm navbar-btn" data-toggle="modal" data-target="#myModalAbout">
			      	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> A cerca de..</button>
			      
			      <button type="button" class="btn btn-default btn-sm navbar-btn" data-toggle="modal" data-target="#myModalDocumentation">
			      	<span class="glyphicon glyphicon-book" aria-hidden="true"></span> Documentación</button>
			    </ul>
			    
			    <ul class="nav navbar-nav navbar-right">
			      
			      <div class="dropdown">
				    <button class="btn btn-primary dropdown-toggle navbar-btn" type="button" data-toggle="dropdown" data-toggle="tooltip" title="Menú"><img src="'.$avatar.'" alt="Avatar" class="avatar" /> '.$nombre.'</button>
				    <ul class="dropdown-menu">
				    <form action="#" method="POST">
				      <li class="dropdown-header">Menú del Usuario</li>
				      
				      <li><button type="submit" name="user_bio" class="btn btn-default btn-sm btn-block">
				      	<span class="glyphicon glyphicon-star-empty" aria-hidden="true"></span> Mis Datos</button></li>

				      <li><button type="submit" name="mis_actividades" class="btn btn-default btn-sm btn-block">
				      	<span class="glyphicon glyphicon-blackboard" aria-hidden="true"></span> Mis Actividades</button></li>
				      
				      <li><button type="submit" name="actividades" class="btn btn-default btn-sm btn-block">
				      	<span class="glyphicon glyphicon-blackboard" aria-hidden="true"></span> Actividades</button></li>
				      
				      
				      <li class="divider"></li>
				      <li class="dropdown-header">Menú del sistema</li>';

				      if($nombre == 'Administrador'){
				      	echo '<li><button type="submit" name="users" class="btn btn-default btn-sm btn-block">
				      		<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Usuarios</button></li>';
				      }
				      
				echo '<li><button class="btn btn-danger btn-sm btn-block" type="submit" name="exit">
				      	<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Salir</button></li>
				     </form>
				    </ul>
				  </div>

			</div>
			      
			      
			    </ul>
			  </div>
			</nav>';

}


function modalAbout(){

	echo '<div class="modal fade" id="myModalAbout" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">A Cerca de...</h4>
		        </div>
		        <div class="modal-body">
		          <p>Some text in the modal.</p>
		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
		        </div>
		      </div>
		      
		    </div>
		  </div>';
}


function modalDocumentation(){

	echo '<div class="modal fade" id="myModalDocumentation" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Documentación</h4>
		        </div>
		        <div class="modal-body">
		          <p>Some text in the modal.</p>
		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
		        </div>
		      </div>
		      
		    </div>
		  </div>';

}




?>