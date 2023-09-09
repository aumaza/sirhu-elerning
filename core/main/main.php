<?php session_start(); 
      
      error_reporting(E_ALL ^ E_NOTICE);
      ini_set('display_errors', 1);



      include "../../connection/connection.php";
      include "../lib/lib_system.php";
      include "lib_main.php";
      include "../users/lib_user.php";

      $varsession = $_SESSION['user'];
      
      if($conn){

        $sql = "select id, nombre, avatar from se_usuarios where user = '$varsession'";
        mysqli_select_db($conn,$db_basename);
        $query = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($query)){
          $nombre = $row['nombre'];
          $user_id = $row['id'];
          $avatar = '..'.substr($row['avatar'], 7);
                  
        }
      }else{
        echo 'CONNECTION FAILURE';
      }
  

  if($varsession == null || $varsession == ''){
        echo '<!DOCTYPE html>
                <html lang="es">
                <head>
                <title>BPlanner - Main</title>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">';
                skeleton();
                echo '</head><body style = "background: #839192;">';
                echo '<br><div class="container">
                        <div class="alert alert-danger" role="alert">';
                echo '<p align="center"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Su sesión ha caducado. Por favor, inicie sesión nuevamente</p>';
                echo '<a href="../../logout.php"><hr><button type="buton" class="btn btn-default btn-block"><span class="glyphicon glyphicon-send" aria-hidden="true"></span> Iniciar</button></a>';  
                echo "</div></div>";
                die();
                echo '</body></html>';
  }


?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>SIRHU Elerning - Menú Principal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php skeleton(); ?>
</head>


<body onload="nobackbutton();">

<?php mainNavBar($nombre,$avatar); ?>

  
<div class="container-fluid">
 
  <?php

    if($conn){
       
        // MODALES
        modalAbout();
        modalDocumentation();

        // SALIR DEL SISTEMA
        if(isset($_POST['exit'])){
          logOut($nombre);
        }

        // HOME
        if(isset($_POST['home'])){
          home();
        }


        // USER SPACE
        $oneUser = New User();

        if(isset($_POST['users'])){
          $oneUser->usersList($oneUser,$conn,$db_basename);
        }
        if(isset($_POST['user_bio'])){
          $oneUser->formUserInfo($oneUser,$user_id,$conn,$db_basename);
        }
        if(isset($_POST['change_password'])){
          $oneUser->changeUserPass($user_id);
        }

        $oneUser->modalChangeAllow();


    }else{
      flyerConnFailure();
    }


  ?>


</div>

<script type="text/javascript" src="lib_main.js"></script>
<script type="text/javascript" src="../users/lib_user.js"></script>

</body>
</html>
