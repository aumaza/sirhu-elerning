// ESTRUCTURA TABLE USUARIOS

 $(document).ready(function(){
      
      $('#usersTable').DataTable({
        "order": [[0, "asc"]],
        "responsive":     true,
        "scrollY":        "300px",
        "scrollX":        true,
        "scrollCollapse": true,
        "paging":         true,
        "deferRender": true,
        "dom":  "Bfrtip",
        buttons: [
            
            {
                extend: 'excel',
                text: '<span class="glyphicon glyphicon-save-file" aria-hidden="true"></span> Exportar Excel',
                messageTop: 'Listado de Usuarios',
                exportOptions: { columns: ':visible',}
            },
            {
                extend: 'csv',
                text: '<span class="glyphicon glyphicon-save-file" aria-hidden="true"></span> Exportar CSV',
                messageTop: 'Listado de Usuarios',
                exportOptions: { columns: ':visible',}
            },
            {
                extend: 'pdf',
                text: '<span class="glyphicon glyphicon-save-file" aria-hidden="true"></span> Exportar PDF',
                messageTop: 'Listado de Usuarios',
                exportOptions: { columns: ':visible',}
            },
            {
                extend: 'print', 
                text: '<span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir',
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '8pt' );
                                                
 
                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' );
                },
                messageTop: 'Listado de Usuarios',
                autoPrint: false,
                exportOptions: {
                    columns: ':visible',
                }
                
            },
            
              'colvis'
        ],
        columnDefs: [ {
            targets: -1,
            visible: true
        } ],
        "fixedColumns": true,
        "language":{
        "info": "Mostrando pagina _PAGE_ de _PAGES_",
        "infoEmpty": "No hay registros disponibles",
        "infoFiltered": "(filtrada de _MAX_ registros)",
        "loadingRecords": "Cargando...",
        "processing":     "Procesando...",
        "search": "Buscar:",
        "zeroRecords":    "No se encontraron registros coincidentes",
        "paginate": {
          "next":       "Siguiente",
          "previous":   "Anterior"
        },
      }
    });
         
    });


 /*
 * * CAMBIAR PERMISOS DE USUARIOS
 */
$(document).ready(function(){
    $('#cambiar_permiso').click(function(){
        var datos=$('#frm_user_allow').serialize();
        $.ajax({
            type:"POST",
            url:"../users/cambiar_permiso_usuario.php",
            data:datos,
            success:function(r){
                if(r==1){
                    alert("Permiso de Usuario Cambiado Exitosamente!!");
                    
                    var form = $('<form action="#" method="post">' +
                          '<input type="hidden" name="users" />' +
                          '</form>');
                        $('body').append(form);
                        form.submit();

                }else if(r==-1){
                    alert("Hubo un problema al intentar cambiar el Permiso de Usuario");
                }
            }
        });

        return false;
    });
});


/*
** CALL MODAL CHANGE ALLOW USER
*/

$(document).ready(function(e) {
  $('#modalUserAllow').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data().id;
    $(e.currentTarget).find('#bookId').val(id);
  });
});


// UPDATE USUARIO
$(document).ready(function(){
    $('#update_user').click(function(){
        
        const form = document.querySelector('#fr_update_user_ajax');
        
        const id = document.querySelector('#id');
        const task = document.querySelector('#tasks');
        const file = document.querySelector('#my_file');
        
        const formData = new FormData(form);
        const values = [...formData.entries()];
        console.log(values);
        
        formData.append('id', id.value);
        formData.append('task', task.value);
        formData.append('file', file.value[0]);
        
               
         jQuery.ajax({
            type:"POST",
            method:"POST",
            url:"../users/update_user.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success:function(r){
                if(r == 1){
                    var mensaje = `<br><div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <p align=center><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Actualización Realizada Exitosamente</p></div>`;
                    document.getElementById('messageUpdateUser').innerHTML = mensaje;
                    console.log(values);
                    setTimeout(function() { $(".close").click(); }, 4000);
                    }else if(r == -1){
                        var mensaje = `<br><div class="alert alert-danger alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <p align=center><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Ocurrió un problema al intentar actualizar el registro</p></div>`;
                        document.getElementById('messageUpdateUser').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }
                    else if(r == 3){
                        var mensaje = `<br><div class="alert alert-warning alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <p align=center><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> El directorio de destino no posee permisos de escritura [ CONTACTE AL ADMINISTRADOR ]</p></div>`;
                        document.getElementById('messageUpdateUser').innerHTML = mensaje;
                        console.log(values);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }
                    else if(r == 4){
                        var mensaje = `<br><div class="alert alert-warning alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <p align=center><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Sólo se permiten archivos PNG y JPG</p></div>`;
                        document.getElementById('messageUpdateUser').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }
                    else if(r == 5){
                        var mensaje = `<br><div class="alert alert-warning alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <p align=center><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Verifique los campos sin completar</p></div>`;
                        document.getElementById('messageUpdateUser').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }
                    else if(r == 7){
                        var mensaje = `<br><div class="alert alert-danger alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Sin conexion a la base de datos</p></div>`;
                        document.getElementById('messageUpdateUser').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }
                    
            },
            
        });

        return false;
    });
});


// UPDATE PASSWORD
$(document).ready(function(){
    $('#change_password').click(function(){
        
        const form = document.querySelector('#fr_change_password_ajax');
        
        const id = document.querySelector('#id');
        const password_actual = document.querySelector('#password_actual');
        const password_1 = document.querySelector('#pwd_1');
        const password_2 = document.querySelector('#pwd_2');
        
        const formData = new FormData(form);
        const values = [...formData.entries()];
        console.log(values);
        
        formData.append('id', id.value);
        formData.append('password_actual', password_actual.value);
        formData.append('password_1', password_1.value);
        formData.append('password_2', password_2.value);
        
               
         jQuery.ajax({
            type:"POST",
            method:"POST",
            url:"../users/update_password.php",
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success:function(r){
                if(r == 1){
                    var mensaje = `<br><div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <p align=center><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Actualización Realizada Exitosamente. Aguarde un Instante. El sistema le pedirá que ingrese nuevamente.-</p></div>`;
                    document.getElementById('messageUpdatePassword').innerHTML = mensaje;
                    console.log(values);
                     $('#password_actual').val('');
                     $('#pwd_1').val('');
                     $('#pwd_2').val('');
                     $('#password_actual').focus();
                    setTimeout(function() { location.href="../../logout.php"; }, 4000);
                    }else if(r == -1){
                        var mensaje = `<br><div class="alert alert-danger alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <p align=center><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> Ocurrió un problema al intentar actualizar el registro</p></div>`;
                        document.getElementById('messageUpdatePassword').innerHTML = mensaje;
                        console.log(formData);
                        $('#password_actual').val('');
                        $('#pwd_1').val('');
                        $('#pwd_2').val('');
                        $('#password_actual').focus();
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }
                    else if(r == 3){
                        var mensaje = `<br><div class="alert alert-warning alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <p align=center><span class="glyphicon glyphicon-alert" aria-hidden="true"></span> El password ingresado no coincide con el actual</p></div>`;
                        document.getElementById('messageUpdatePassword').innerHTML = mensaje;
                        console.log(values);
                        $('#password_actual').val('');
                        $('#pwd_1').val('');
                        $('#pwd_2').val('');
                        $('#password_actual').focus();
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }
                    else if(r == 4){
                        var mensaje = `<br><div class="alert alert-warning alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <p align=center><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Los Passwords no Coinciden</p></div>`;
                        document.getElementById('messageUpdatePassword').innerHTML = mensaje;
                        console.log(formData);
                        $('#pwd_1').val('');
                        $('#pwd_2').val('');
                        $('#pwd_1').focus();
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }
                    else if(r == 4){
                        var mensaje = `<br><div class="alert alert-warning alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <p align=center><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Los Passwords deden tener entra 10 y 15 caracteres</p></div>`;
                        document.getElementById('messageUpdatePassword').innerHTML = mensaje;
                        console.log(formData);
                        $('#pwd_1').val('');
                        $('#pwd_2').val('');
                        $('#password_actual').focus();
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }
                    else if(r == 5){
                        var mensaje = `<br><div class="alert alert-warning alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <p align=center><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Verifique los campos sin completar</p></div>`;
                        document.getElementById('messageUpdatePassword').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }
                    else if(r == 7){
                        var mensaje = `<br><div class="alert alert-danger alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <p align=center><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Sin conexion a la base de datos</p></div>`;
                        document.getElementById('messageUpdatePassword').innerHTML = mensaje;
                        console.log(formData);
                        setTimeout(function() { $(".close").click(); }, 4000);
                    }
                    
            },
            
        });

        return false;
    });
});