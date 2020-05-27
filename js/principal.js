$(document).ready(function() {
    $(".fecha").datepicker();
    $(".fecha").datepicker('option', 'dateFormat','dd/mm/yy');
    $(".fecha").datepicker('option', 'monthNames', ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"]);
    $(".fecha").datepicker('option', 'dayNamesMin', ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"]);
    
    /*EMPLEADOS*/
    $("#altaEmpleado").on('click', function() {
        
        var r = confirm("Va a agregar un empleado ¿Esta seguro?");
        
        if (r == true) {

            var apeynom = $("#apeynomN").val();

            $.ajax({
                method: 'GET',
                url: 'ABMEmpleados.php',
                data: {apeynom: apeynom, tipo: 1},
                success: function (data) {
                    var html = jQuery.parseJSON(data);
                    if(html.cod == 0){
                        alert(html.leyenda);
                        location.reload();
                    }else{
                        alert('ERROR\n' + html.leyenda);
                    }
                }
            });
        }
    });
    
    $(".guaEmpleado").on('click', function() {
        
        var id = $(this).data('id');
        
        var apeynom = $("#apeynom"+id).val();
        
        $.ajax({
            method: 'GET',
            url: 'ABMEmpleados.php',
            data: {idempleado: id, apeynom: apeynom, tipo: 2},
            success: function (data) {
                var html = jQuery.parseJSON(data);
                if(html.cod == 0){
                    alert(html.leyenda);
                }else{
                    alert('ERROR\n' + html.leyenda);
                }
            }
        });
    });
    
    $(".eliEmpleado").on('click', function() {
        
        var r = confirm("Va a eliminar un empleado ¿Esta seguro?");
        
        if (r == true) {
            var id = $(this).data('id');
        
            $.ajax({
                method: 'GET',
                url: 'ABMEmpleados.php',
                data: {idempleado: id, tipo: 3},
                success: function (data) {
                    var html = jQuery.parseJSON(data);
                    if(html.cod == 0){
                        alert(html.leyenda);
                        location.reload();
                    }else{
                        alert('ERROR\n' + html.leyenda);
                    }
                }
            });
        }
    });
    /*EMPLEADOS*/
    
    /*CLIENTES*/
    $("#altaCliente").on('click', function() {
        
        var r = confirm("Va a agregar un cliente ¿Esta seguro?");
        
        if (r == true) {

            var nombre = $("#nombreN").val();
            var correo = $("#correoN").val();
            var tel    = $("#telN").val();

            $.ajax({
                method: 'GET',
                url: 'ABMClientes.php',
                data: {nombre: nombre, correo: correo, tel: tel, tipo: 1},
                success: function (data) {
                    var html = jQuery.parseJSON(data);
                    if(html.cod == 0){
                        alert(html.leyenda);
                        location.reload();
                    }else{
                        alert('ERROR\n' + html.leyenda);
                    }
                }
            });
        }
    });
    
    $(".guaCliente").on('click', function() {
        
        var id = $(this).data('id');
        
        var nombre = $("#nombre"+id).val();
        var correo = $("#correo"+id).val();
        var tel    = $("#tel"+id).val();
        
        $.ajax({
            method: 'GET',
            url: 'ABMClientes.php',
            data: {idcliente: id, nombre: nombre, correo: correo, tel: tel, tipo: 2},
            success: function (data) {
                var html = jQuery.parseJSON(data);
                if(html.cod == 0){
                    alert(html.leyenda);
                }else{
                    alert('ERROR\n' + html.leyenda);
                }
            }
        });
    });
    
    $(".eliCliente").on('click', function() {
        
        var r = confirm("Va a eliminar un cliente ¿Esta seguro?");
        
        if (r == true) {
            var id = $(this).data('id');
        
            $.ajax({
                method: 'GET',
                url: 'ABMClientes.php',
                data: {idempleado: id, tipo: 3},
                success: function (data) {
                    var html = jQuery.parseJSON(data);
                    if(html.cod == 0){
                        alert(html.leyenda);
                        location.reload();
                    }else{
                        alert('ERROR\n' + html.leyenda);
                    }
                }
            });
        }
    });
    /*CLIENTES*/

    /*TRABAJOS*/
    $("#altaTrabajo").on('click', function() {
        
        var r = confirm("Va a agregar un trabajo nuevo ¿Esta seguro?");
        
        if (r == true) {

            var fechaEntrega  = $("#fechaEntregaN").val();
            var idempleado    = $("#idempleadoN").val();
            var idcliente     = $("#idclienteN").val();
            var precio        = $("#precioN").val();
            var idtp          = $("#idtpN").val();
            var idtipo        = $("#idtipoN").val();
            var observaciones = $("#observacionesN").val();

            $.ajax({
                method: 'GET',
                url: 'ABMTrabajos.php',
                data: {fechaEntrega: fechaEntrega, idtipo: idtipo, idempleado: idempleado, idcliente: idcliente, precio: precio, idtp: idtp, observaciones: observaciones, tipo: 1},
                success: function (data) {
                    var html = jQuery.parseJSON(data);
                    if(html.cod == 0){
                        alert(html.leyenda);
                        location.reload();
                    }else{
                        alert('ERROR\n' + html.leyenda);
                    }
                }
            });
        }
    });
    
    $(".guaTrabajo").on('click', function() {
        
        var id = $(this).data('id');
        
        var fechaEntrega  = $("#fechaEntrega"+id).val();
        var idempleado    = $("#idempleado"+id).val();
        var idcliente     = $("#idcliente"+id).val();
        var precio        = $("#precio"+id).val();
        var idtp          = $("#idtp"+id).val();
        var idtipo        = $("#idtipo"+id).val();
        var idestado      = $("#idestado"+id).val();
        var observaciones = $("#observaciones"+id).val();
        
        $.ajax({
            method: 'GET',
            url: 'ABMTrabajos.php',
            data: {idtrabajo: id, fechaEntrega: fechaEntrega, idtipo: idtipo, idestado: idestado, idempleado: idempleado, idcliente: idcliente, precio: precio, idtp: idtp, observaciones: observaciones, tipo: 2},
            success: function (data) {
                var html = jQuery.parseJSON(data);
                if(html.cod == 0){
                    alert(html.leyenda);
                }else{
                    alert('ERROR\n' + html.leyenda);
                }
            }
        });
    });
    
    $(".eliTrabajo").on('click', function() {
        
        var r = confirm("Va a eliminar un trabajo ¿Esta seguro?");
        
        if (r == true) {
            var id = $(this).data('id');
        
            $.ajax({
                method: 'GET',
                url: 'ABMTrabajos.php',
                data: {idtrabajo: id, tipo: 3},
                success: function (data) {
                    var html = jQuery.parseJSON(data);
                    if(html.cod == 0){
                        alert(html.leyenda);
                        location.reload();
                    }else{
                        alert('ERROR\n' + html.leyenda);
                    }
                }
            });
        }
    });
    /*TRABAJOS*/
});
