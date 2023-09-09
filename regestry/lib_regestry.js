// INSERTAR NUEVO REGISTRO DE USUARIO
$(document).ready(function(){
    $('#new_user').click(function(){
        
        const form = document.querySelector('#fr_new_user_ajax');
        
        const name = document.querySelector('#name');
        const email = document.querySelector('#email');
        const task = document.querySelector('#tasks');
        const password_1 = document.querySelector('#pwd_1');
        const password_2 = document.querySelector('#pwd_2');
        const file = document.querySelector('#my_file');
        
        const formData = new FormData(form);
        const values = [...formData.entries()];
        console.log(values);
        
        formData.append('name', name.value);
        formData.append('email', email.value);
        formData.append('task', task.value);
        formData.append('password_1', password_1.value);
        formData.append('password_2', password_2.value);
        formData.append('file', file.value[0]);
        
               
         jQuery.ajax({
            type:"POST",
            method:"POST",
            url:"new_regestry.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success:function(r){
                if(r == 1){
                    var mensaje = '<br><div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Alta Realizada Exitosamente</p></div>';
                    document.getElementById('messageNewUser').innerHTML = mensaje;
                     $('#name').val('');
                     $('#email').val('');
                     $('#tasks').val('');
                     $('#pwd_1').val('');
                     $('#pwd_2').val('');
                     $('#my_file').val('');
                     $('#name').focus();
                    console.log(values);
                    setTimeout(function() { $(".close").click(); }, 4000);
                    }else if(r == -1){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Ocurrió un problema al intentar agregar el registro</p></div>';
                        document.getElementById('messageNewUser').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }
                    else if(r == 2){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Solo se ha subido el archivo de imagen sin impactar en la base de datos</p></div>';
                        document.getElementById('messageNewUser').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }
                    else if(r == 3){
                        var mensaje = '<br><div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> El directorio de destino no posee permisos de escritura [ CONTACTE AL ADMINISTRADOR ]</p></div>';
                        document.getElementById('messageNewUser').innerHTML = mensaje;
                        console.log(values);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }
                    else if(r == 4){
                        var mensaje = '<br><div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Sólo se permiten archivos PNG y JPG</p></div>';
                        document.getElementById('messageNewUser').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }
                    else if(r == 6){
                        var mensaje = '<br><div class="alert alert-warning alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Usuario Existente</p></div>';
                        document.getElementById('messageNewUser').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }
                    else if((r == 7) || (r == 5)){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Sin conexion a la base de datos</p></div>';
                        document.getElementById('messageNewUser').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }
                    else if(r == 15){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Hay campos sin completar</p></div>';
                        document.getElementById('messageNewUser').innerHTML = mensaje;
                        console.log(values);
                        setTimeout(function() { $(".close").click(); }, 5000);
                    }
                    else if(r == 13){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Los Passwords no coinciden</p></div>';
                        document.getElementById('messageNewUser').innerHTML = mensaje;
                        console.log(values);
                        setTimeout(function() { $(".close").click(); }, 5000);
                    }
                    else if(r == 11){
                        var mensaje = '<br><div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><p align=center><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> El Password no puede tener menos de 10 y más de 15 caracteres</p></div>';
                        document.getElementById('messageNewUser').innerHTML = mensaje;
                        console.log(values);
                        setTimeout(function() { $(".close").click(); }, 5000);
                    }
                    
                    
                    else if(r == ''){
                        //console.log(formData);
                    }
            },
            
        });

        return false;
    });
});