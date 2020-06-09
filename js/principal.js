$(document).ready(function(){
//    $(".fecha").datepicker();
//    $(".fecha").datepicker('option', 'dateFormat','dd/mm/yy');
//    $(".fecha").datepicker('option', 'monthNames', ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"]);
//    $(".fecha").datepicker('option', 'dayNamesMin', ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"]);
    
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
            var seña          = $("#señaN").val();
            var idtp          = $("#idtpN").val();
            var idtipo        = $("#idtipoN").val();
            var observaciones = $("#observacionesN").val();

            $.ajax({
                method: 'GET',
                url: 'ABMTrabajos.php',
                data: {fechaEntrega: fechaEntrega, idtipo: idtipo, idempleado: idempleado, idcliente: idcliente, precio: precio, seña: seña, idtp: idtp, observaciones: observaciones, tipo: 1},
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
        var seña          = $("#seña"+id).val();
        var idtp          = $("#idtp"+id).val();
        var idtipo        = $("#idtipo"+id).val();
        var idestado      = $("#idestado"+id).val();
        var observaciones = $("#observaciones"+id).val();
        
        $.ajax({
            method: 'GET',
            url: 'ABMTrabajos.php',
            data: {idtrabajo: id, fechaEntrega: fechaEntrega, idtipo: idtipo, idestado: idestado, idempleado: idempleado, idcliente: idcliente, precio: precio, seña: seña, idtp: idtp, observaciones: observaciones, tipo: 2},
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
    
    $(".observ").on('click', function(e) {
        e.preventDefault();
        
        $(".observ").prop('disabled',true);
        var id    = $(this).data('id');
        var valor = $("#observaciones"+id).val();
        
        $('<textarea class="form-control" style="z-index:10000" id="observ'+id+'" title="Observaciones #'+id+'" name="observ'+id+'">'+valor+'</textarea>').dialog({
            autoOpen: true,
            position:['middle',20],
            modal: true,
            closeOnEscape: true,
            close: function() {$(".observ").prop('disabled',false);},
                buttons: {
                    'Aceptar': function () {
                        var nueva = $('#observ'+id).val();
                        $("#observaciones"+id).val(nueva);
                        $(".observ").prop('disabled',false);
                        $(this).dialog('close');
                    },
                    'Cancelar': function () {
                        $(".observ").prop('disabled',false);
                        $(this).dialog('close');
                    }
                }
        });
    });
    /*TRABAJOS*/
    /*CUOTAS*/
    $("#altaCuotas").on('click', function() {
        
        var idtrabajo     = $("#idtrabajoN").val();
        var fechaVenc     = $("#fechaVencN").val();
        var cuotas        = $("#cuotasN").val();
        var interes       = $("#interesN").val();
        var precioInteres = parseFloat($("#preciofinalN").val());
        
        //var precioInteres = precio * parseFloat("1."+interes); 
        var precioCuota   = precioInteres / cuotas;
        
        var r = confirm("Va a generar un nuevo Plan de "+cuotas+" cuotas ($"+precioCuota.toFixed(2)+" cada una) por un total de $"+precioInteres.toFixed(2)+" ¿Esta seguro?");
        
        if (r == true) {

            $.ajax({
                method: 'GET',
                url: 'ABMCuotas.php',
                data: {idtrabajo: idtrabajo, fechaVenc: fechaVenc, cuotas: cuotas, precio: precioInteres, interes: interes, tipo: 1},
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
    
    $("#modificarPlan").on('click', function() {
        
        var i = $("#modPlan").val();
        window.open('cuotas.php?i='+i, '_blank');
        
    });
    
    $("#modPlan").on('change', function() {
        
        var i = $(this).val();
        if(i.trim() === ''){
            $("#modificarPlan").prop('disabled',true);
        }else{
            if(parseInt(i) <= 0){
                $("#modificarPlan").prop('disabled',true);
            }else{
                $("#modificarPlan").prop('disabled',false);
            }
        }
    });
    
    $(".pagCuota").on('click', function() {
        
        var idcuota   = $(this).data('id');
        var idtrabajo = $("#idt").val();
        
        $.ajax({
            method: 'GET',
            url: 'ABMCuotas.php',
            data: {idtrabajo: idtrabajo, idcuota: idcuota, tipo: 4},
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
    
    $(".guaCuota").on('click', function() {
        
        var idcuota   = $(this).data('id');
        var idtrabajo = $("#idt").val();
        var precio    = $("#precio"+id).val();
        
        $.ajax({
            method: 'GET',
            url: 'ABMCuotas.php',
            data: {idtrabajo: idtrabajo, idcuota: idcuota, precio: precio, tipo: 2},
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
    
    $("#idtrabajoN").on('change', function() {
        
        var precio  = $(this).find(':selected').data('precio');
        var interes = $("#interesN").val();
        var cuotas  = $("#cuotasN").val();
                
        var precioInteres = precio * parseFloat("1."+interes);
        var precioCuota = precioInteres / cuotas;
        
        $("#precioN").val(precioInteres.toFixed(2));
        $("#preciocuotaN").val(precioCuota.toFixed(2));
        
    });
    
    $("#interesN").on('change', function() {
        
        var interes = $(this).val();
        var precio  = $("#idtrabajoN").find(':selected').data('precio');
        var cuotas  = $("#cuotasN").val();
        
        var precioInteres = precio * parseFloat("1."+interes); 
        var precioCuota   = precioInteres / cuotas;
        
        $("#preciofinalN").val(precioInteres.toFixed(2));
        $("#preciocuotaN").val(precioCuota.toFixed(2));
    });
    
    $("#cuotasN").on('change', function() {
        
        var cuotas  = $(this).val();
        var precio  = $("#idtrabajoN").find(':selected').data('precio');
        var interes = $("#interesN").val();
        
        var precioInteres = precio * parseFloat("1."+interes); 
        var precioCuota   = precioInteres / cuotas;
        
        $("#preciofinalN").val(precioInteres.toFixed(2));
        $("#preciocuotaN").val(precioCuota.toFixed(2));
    });
    
    $("#simPlan").on('click', function() {
        var fecha = $("#fechaVencN").val();
        if(fecha.trim() === ''){
            alert('Debe seleccionar el vencimiento de la primera cuota.');
            return;
        }
        var cuotas  = $("#cuotasN").val();
        var precio  = $("#idtrabajoN").find(':selected').data('precio');
        var interes = $("#interesN").val();
        
        var precioInteres = precio * parseFloat("1."+interes); 
        var precioCuota   = precioInteres / cuotas;
        
        var html = "<table style='width:50%;' id='simTabla' class='table table-striped table-bordered centered'><thead><tr style='text-align:center;'><th># CUOTA</th><th>VENCIMIENTO</th><th>PRECIO</th></tr></thead><tbody>";
        var fecha = $("#fechaVencN").val();
       
        for(var i = 1; i<= cuotas; i++){
            
            var e = new Date(invFecha(fecha,'/','-'));
            e.setMonth(e.getMonth() + (i - 1));
            e.setDate(e.getDate() + 1);
            var nuevafecha = e.getDate() +"/"+ (e.getMonth() + 1) +"/"+ e.getFullYear();
            //alert(nuevafecha);
            html += "<tr style='text-align:center;'><td><b>" + i + "</b></td><td>" + nuevafecha + "</td><td>$" + precioCuota.toFixed(2) + "</td></tr>";
        }
        html += "</tbody></table>";
        $("#simDiv").html(html);
    });
    /*CUOTAS*/
    /*INDEX*/
    $(".recordatorio").on('click', function() {
        //alert('hola');
        var mail   = $(this).data('correo');
        var id     = $(this).data('id');
        var idt    = $(this).data('idt');
        var fecha  = $(this).data('f');
        var precio = $(this).data('p');
        
        var r = confirm("Enviará un recordatorio por mail ¿Esta seguro?");
        
        if (r == true) {

            $.ajax({
                method: 'GET',
                url: 'ABMCorreos.php',
                data: {mail: mail, id: id, idt: idt, fecha: fecha, precio: precio, tipo: 1},
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
    /*INDEX*/
    
});

function invFecha(fecha,sepIni,sepRes){
   return fecha.split(sepIni).reverse().join(sepRes);
}