// ACTUALIZAR PASSWORD DE USUARIO
$(document).ready(function(){
    $('#reset_password').click(function(){
        
        const form = document.querySelector('#fr_reset_password_ajax');
        
        const user = document.querySelector('#user');
        const password_1 = document.querySelector('#pwd_1');
        const password_2 = document.querySelector('#pwd_2');
        
        const formData = new FormData(form);
        const values = [...formData.entries()];
        console.log(values);
        
        formData.append('user', user.value);
        formData.append('password_1', password_1.value);
        formData.append('password_2', password_2.value);
        
               
         jQuery.ajax({
            type:"POST",
            method:"POST",
            url:"update_password.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success:function(r){
                if(r == 1){
                    var mensaje = '<br><div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Actualización Realizada Exitosamente</p></div>';
                    document.getElementById('messageUpdatePass').innerHTML = mensaje;
                     $('#user').val('');
                     $('#pwd_1').val('');
                     $('#pwd_2').val('');
                     $('#user').focus();
                    console.log(values);
                    setTimeout(function() { $(".close").click(); }, 4000);
                    }else if(r == -1){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Ocurrió un problema al intentar actualizar el registro</p></div>';
                        document.getElementById('messageUpdatePass').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }
                    else if(r == 6){
                        var mensaje = '<br><div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Usuario Inexistente. Registrate <a href="../regestry/regestry.php">aquí</a></p></div>';
                        document.getElementById('messageUpdatePass').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }
                    else if(r == 7){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Sin conexion a la base de datos</p></div>';
                        document.getElementById('messageUpdatePass').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }
                    else if(r == 5){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Hay campos sin completar</p></div>';
                        document.getElementById('messageUpdatePass').innerHTML = mensaje;
                        console.log(values);
                        setTimeout(function() { $(".close").click(); }, 5000);
                    }
                    else if(r == 13){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Los Passwords no coinciden</p></div>';
                        document.getElementById('messageUpdatePass').innerHTML = mensaje;
                        $('#pwd_1').val('');
                        $('#pwd_2').val('');
                        $('#pwd_1').focus();
                        console.log(values);
                        setTimeout(function() { $(".close").click(); }, 5000);
                    }
                    else if(r == 11){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> El Password no puede tener menos de 10 y más de 15 caracteres</p></div>';
                        document.getElementById('messageUpdatePass').innerHTML = mensaje;
                        $('#pwd_1').val('');
                        $('#pwd_2').val('');
                        $('#pwd_1').focus();
                        console.log(values);
                        setTimeout(function() { $(".close").click(); }, 5000);
                    }
                    
                    
            },
            
        });

        return false;
    });
});