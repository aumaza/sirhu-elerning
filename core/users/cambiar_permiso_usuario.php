<?php   session_start();
        include "../../connection/connection.php";
        include "lib_user.php";
        
        $oneUser = new User();
        
        if($conn){
            
            $id = mysqli_real_escape_string($conn,$_POST['bookId']);
            $role = mysqli_real_escape_string($conn,$_POST['permisos']);
                       
            if(($role == '') || ($id == '')){
                echo 3;
            }else{
                $oneUser->changeAllow($oneUser,$id,$role,$conn,$db_dbname);
            }
        }else{
            echo 13; // sin conexion
        }
        
?>
