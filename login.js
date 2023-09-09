// INSERTAR NUEVO REGISTRO DE USUARIO
$(document).ready(function(){
    $('#login').click(function(){
        
        const form = document.querySelector('#fr_login_ajax');
        
        const user = document.querySelector('#user');
        const password = document.querySelector('#pwd');
        
        const formData = new FormData(form);
        const values = [...formData.entries()];
        //console.log(values);
        
        formData.append('user', user.value);
        formData.append('password', password.value);
        
               
         jQuery.ajax({
            type:"POST",
            method:"POST",
            url:"login.php",
            data: formData,
            cache: true,
            processData: false,
            contentType: false,
            success:function(r){
                if(r == 1){
                    var mensaje = `<br><div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <p align=center><img src="core/img/sand-clock-dribbble.gif"  class="img-reponsive img-rounded" style="width:10%"> Bienvenido, aguarde un instante...</p></div>`;
                    document.getElementById('messageLogIn').innerHTML = mensaje;
                     $('#user').val('');
                     $('#pwd').val('');
                    //console.log(values);
                    setTimeout(function() { location.href="core/main/main.php" }, 4000);
                    }else if(r == -1){
                        var mensaje = `<br><div class="alert alert-danger alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <p align=center><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Usuario Inhabilitado. Contacte al Administrador</p></div>`;
                        document.getElementById('messageLogIn').innerHTML = mensaje;
                        //console.log(formData);
                         $('#user').val('');
                         $('#pwd').val('');
                         $('#user').focus();
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }
                    else if(r == 2){
                        var mensaje = `<br><div class="alert alert-danger alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <p align=center><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Usuario o contraseña Incorrectos</p></div>`;
                        document.getElementById('messageLogIn').innerHTML = mensaje;
                        //console.log(formData);
                         $('#user').val('');
                         $('#pwd').val('');
                         $('#user').focus();
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }
                    else if(r == 7){
                        var mensaje = `<br><div class="alert alert-danger alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Sin conexion a la base de datos</p></div>`;
                        document.getElementById('messageLogIn').innerHTML = mensaje;
                        //console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }
                    else if(r == 5){
                        var mensaje = `<br><div class="alert alert-danger alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <p align=center><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Debe ingresar Datos</p></div>`;
                        document.getElementById('messageLogIn').innerHTML = mensaje;
                        //console.log(values);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }
                    
            },
            
        });

        return false;
    });
});