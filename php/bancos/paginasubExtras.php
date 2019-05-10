<?php 

require_once('../fecha.php');
$idioma=idioma();
include('../idiomas/'.$idioma.'.php');
session_start();
?>
<!doctype html>
<html>  
<head>
<meta charset="utf-8">
<title><?php echo "".$lang[ $idioma ]['Inicio']." ".$_SESSION['nomProv']." | ".$_SESSION['pais']; ?></title>

<link href="../../images/<?php echo limpiar_caracteres_especiales($_SESSION['pais']); ?>.ico" type="image/x-icon" rel="shortcut icon" />
<link href="../../css/estiloPrincipal.css" rel="stylesheet" type="text/css">
<link href="../../css/grid.css" rel="stylesheet" type="text/css">
<link href="../menu/css/encabezado.css" rel="stylesheet" type="text/css">
<link href="../../css/verificar.css" rel="stylesheet" type="text/css">
<link href="../../css/estiloForms.css" rel="stylesheet" type="text/css">
<link href="../../css/botones.css" rel="stylesheet" type="text/css">
<link href="../../css/tabla.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../../css/jquery-ui.min.css" type="text/css" />
<link href="../../css/datatables.min.css" rel="stylesheet" type="text/css">
<link href="css/estilo.css" rel="stylesheet" type="text/css">
<link href="css/estiloMovimientosCuenta.css" rel="stylesheet" type="text/css">


<script  src="../../js/jquery.js"></script>
<script type="text/javascript" src="../../js/jquery-1.3.2.js"></script>
<script type="text/javascript" src="../../js/jquery-2.2.3.min.js"></script>
<script  src="../../js/Jqueryvalidation.js" type="text/javascript"></script>
<script  src="../../js/jquery-ui.min.js" type="text/javascript"></script>
<script  src="../../js/funcionesScriptUsuarios.js" type="text/javascript"></script>
<script  src="../../js/funcionesScriptUsuarioLogiado.js" type="text/javascript"></script>
<script  src="js/funcionesScriptBancos.js" type="text/javascript"></script>
<script  src="js/funcionesScripCuentasConta.js" type="text/javascript"></script>
<script  src="js/funcionesScripConciliaciones.js" type="text/javascript"></script>
<script  src="js/funcionesScripMovimientoCuenta.js" type="text/javascript"></script>
<script  src="../../js/datatables.min.js" type="text/javascript"></script>
<script src="js/paraimagenes.js"></script>

</head>

<body onLoad="javascript:envioDeDataExtras1();inna();">

<div class="pagina">
	<div id="cuerpo">
    <header>
            <?php ayuda("../../images/header.png","","../../images/sigef_logo.png");?>
            <ul id="elementoLogin">
              <strong><?php echo ucwords(strtolower($_SESSION['nom']))." ".ucwords(strtolower($_SESSION['apel']))."<br>".ucwords(strtolower($_SESSION['nomEmpresa']))."<br>".ucwords(strtolower($_SESSION['nomProv']));?></strong>
            	<a onClick="window.close();">
                <li>
                <?php echo $lang[ $idioma ]['Salir']; ?>
                </li>
                </a>
             </ul>
    	</header>
    
            
   	 <div id="formulario">
   	</div>
	</div>
      <footer >
    <?php footer(); ?>
    </footer>
</div>

</body>
</html>
