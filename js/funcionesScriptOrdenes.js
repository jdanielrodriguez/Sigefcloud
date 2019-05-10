/**
 * Created by JDR
 * For more information www.facebook.com/DEANIELL6195
 * Unique creator
 */
function abrirOrdenes(codprov, pais, codpais, contador) {
    params = 'width=' + screen.width;
    params += ', height=' + screen.height;
    params += ', top=0, left=0'
    params += ', fullscreen=yes';
    params += ', location=yes';
    params += ', Scrollbars=YES';
    ultimo = __('ultimoCont').innerHTML;
    pag = __('ultimoPag').innerHTML;
    if (pag > 1) {
        ultimo = 99;
    }
    pag = window.open("../php/ordenes/paginaOrdenes.php?codigo=" + codprov + "&pais=" + pais + "&cod=" + codpais + "&con=" + contador + "&ul=" + ultimo, "Ordenes", params);
    pag.focus();
    /*$.ajax({
				url:'../php/notificaciones/paginaNotificacion.php',
				type:'POST',
				data:'codigo='+codprov,
				success: function(resp)
				{							
					$('#NotificacionVentana').html(resp);
				}
			});	
	ventana('NotificacionVentana',screen.height,screen.width) ;*/


}

function cambiarOrden(tipo, num, pais, codigo, ul) {
    if (tipo == 1) {
        num++;
    }
    if (tipo == 2) {
        num--;
    }
    numOrd = window.opener.$('#numOrd' + num).html();
    window.location = "paginaOrdenes.php?codigo=" + numOrd + "&pais=" + pais + "&cod=" + codigo + "&con=" + num + "&ul=" + ul + "";
}

function envioDeDataOrdenes(es) {
    var pais = "";
    var codi = "";
    cadVariables = location.search.substring(1, location.search.length);
    arrVariables = cadVariables.split("&");
    for (i = 0; i < arrVariables.length; i++) {
        arrVariableActual = arrVariables[i].split("=");
        if (isNaN(parseFloat(arrVariableActual[1])))
            eval(arrVariableActual[0] + "='" + unescape(arrVariableActual[1]) + "';");
        else
            eval(arrVariableActual[0] + "=" + arrVariableActual[1] + ";");

        if (i == 0) {
            codi = arrVariableActual[1];
        }
        if (i == 1) {
            pais = arrVariableActual[1];
        }
        if (i == 2) {
            codpais = arrVariableActual[1];
        }
    }


    {
        llenarDatosOrdenes(codi, pais, cod);
    }


}

function llenarDatosOrdenes(codigo, pais, cod) {
    $.ajax({
        url: '../ordenes/buscarOrden.php',
        type: 'POST',
        data: 'codigo=' + codigo + '&pais=' + pais + '&codpais=' + cod + '&tipo=1',
        success: function(resp) {
            $('#resultado1').html(resp);
        }
    });
}

function llenarTablaOrdenes(codigo, pais, cod) {

    $.ajax({
        url: '../ordenes/buscarOrden.php',
        type: 'POST',
        data: 'codigo=' + codigo + '&pais=' + pais + '&codpais=' + cod + '&tipo=2',
        success: function(resp) {
            $('#ordenesCont').html(resp);
        }
    });
}

function llenarTablaCargosOrdenes(codigo, pais, cod) {

    $.ajax({
        url: '../ordenes/buscarOrden.php',
        type: 'POST',
        data: 'codigo=' + codigo + '&pais=' + pais + '&codpais=' + cod + '&tipo=3',
        success: function(resp) {
            $('#cargosOrden').html(resp);
        }
    });
}

function ingresoOrdenes() {

    var codigo = limpiarCaracteresEspeciales(document.getElementById('codigo').value);
    var notifica = limpiarCaracteresEspeciales(document.getElementById('notifica').value);
    var destino = limpiarCaracteresEspeciales(document.getElementById('destino').value);
    var condicion = limpiarCaracteresEspeciales(document.getElementById('condicion').value);
    var estatus = limpiarCaracteresEspeciales(document.getElementById('estado').value);
    var fechaini = limpiarCaracteresEspeciales(document.getElementById('fechaini').value);
    var fechafin = limpiarCaracteresEspeciales(document.getElementById('fechafin').value);
    /*var combo = (document.getElementById('pais'));
    var pais = combo.options[combo.selectedIndex].text;*/
    //alert(2);


    datos = 'codigo=' + codigo + '&notifica=' + notifica + '&destino=' + destino + '&condicion=' + condicion + '&estatus=' + estatus + '&fechaini=' + fechaini + '&fechafin=' + fechafin;

    $.ajax({
        url: '../notificaciones/ingresoNotificacion.php',
        type: 'POST',
        data: datos,
        success: function(resp) {
            $('#resultado').html(resp);
        }
    });

}