<?php
require_once('../coneccion.php');
require_once('../fecha.php');
$idioma=idioma();
include('../idiomas/'.$idioma.'.php');

## usuario y clave pasados por el formulario
$nombre= ucwords(strtolower($_POST['nombre']));
$pais= $_POST['pais'];
$codpais= $_POST['codpais'];
$filtro= $_POST['filtro'];
//$fecha=getdate();
session_start();
$fecha = date('Y-m-d');


if($filtro=='2')
{
	$nuevafecha = strtotime ( '-24 hour' , strtotime ( $fecha ) ) ;
}
else
if($filtro=='13')
{
	$nuevafecha = strtotime ( '-10000 year' , strtotime ( $fecha ) ) ;
}
else
{
	$nuevafecha = strtotime ( '-'.$filtro.' day' , strtotime ( $fecha ) ) ;
}

$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
$nuevafecha2 = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
$fecha = date ( 'Y-m-d' , $nuevafecha2 );
if($nombre==NULL)
{
	$squery="select orderid, timoford, (grandtotal), orderunits, ordsou, tranum,shicar,estatus,codorden from tra_ord_enc where (timoford <= '".$fecha."' and timoford >= '".$nuevafecha."') and codprov='".$_SESSION['codprov']."' order by timoford desc";
}
else
{
	$squery="select orderid, timoford, (grandtotal), orderunits, ordsou, tranum,shicar,estatus,codorden from tra_ord_enc where (orderid like '%$nombre%' or timoford like '%$nombre%' or grandtotal like '%$nombre%' or orderunits like '%$nombre%' or ordsou like '%$nombre%' or tranum like '%$nombre%') and (timoford <= '".$fecha."' and timoford >='".$nuevafecha."') and codprov='".$_SESSION['codprov']."' order by timoford desc";
}


## ejecución de la sentencia sql

echo encabezado().
		 tabla($squery,$pais,$codpais);
		
function tabla($squer,$pais,$codpais)
{
	require_once('../fecha.php');
$idioma=idioma();
include('../idiomas/'.$idioma.'.php');
	$retornar="";
	$total=0;
	$contador=0;
	$pag=0;
	$retornar=$retornar."<tbody>";
	$ejecutar=mysqli_query(conexion($pais),$squer);
				if($ejecutar)
				{
					if($ejecutar->num_rows>0)
					{
					
					while($row=mysqli_fetch_array($ejecutar,MYSQLI_NUM))
					{
						if($contador==100)
						{
							$contador=0;
							$pag++;
						}
						
						if(file_exists('../../images/iconosSeller/Channel_'.$row['4'].'.png'))
						{
							$canal='<img src="../images/iconosSeller/Channel_'.$row['4'].'.png" style="width:20px; height:20px;"/>';
						}
						else
						{
							$canal=$row['4'];
						}
						if(strtoupper($row['6'])=="USPS")
						{
							$link="https://tools.usps.com/go/TrackConfirmAction.action?tRef=fullpage&tLc=1&text28777=&tLabels=".$row['5']."' target='_blank'";
						}
						else
						if(strtoupper($row['6'])=="FEDEX")
						{
							$link="https://www.fedex.com/apps/fedextrack/?action=track&cntry_code=us&tracknumber_list=".$row['5']."&language=english' target='_blank'";
						}
						else
						if(strtoupper($row['6'])=="UPS")
						{
							$link="https://wwwapps.ups.com/WebTracking/processRequest?tracknums_displayed=1&TypeOfInquiryNumber=T&InquiryNumber1=".$row['5']."' target='_blank'";
						}
						else
						{
							$link="#'";
						}
					
					if(strtoupper($row['5'])!="")
						{
							$click="onClick=\"abrirOrdenes('".strtoupper($row['0'])."','".$pais."','".$codpais."','".$contador."');\"";
						}
						else
						{
							$click="";
						}
						
						
						
						
						setlocale(LC_MONETARY, 'en_US');
						$retornar=$retornar."<tr >
								<td><input type=\"checkbox\" id=\"".strtoupper($row['0'])."\"  onClick=\"mostrarDetalleOrden('".strtoupper($row['0'])."','".$pais."','".$codpais."','".strtoupper($row['8'])."')\"  value=\"".strtoupper($row['0'])."\" /></td>
								<td hidden=\"hidden\">".($row['0'])."</td>
								<td id=\"numOrd".$contador."\" onMouseOver=\"this.style.cssText='background-color: #afafaf'\" onMouseOut=\"this.style.cssText='background-color: none'\" ".$click.">".($row['0'])."</td>
								<td>".($row['1'])."</td>
								<td>".toMoney(round($row['2'],5,2))."</td>
								<td><center>".number_format($row['3'])."</center></td>
								<td><center>".($canal)."</center></td>
								<td><a href='".$link.">".($row['5'])."</a></td>
								<td><center>".(strtoupper($row['7']))."</center></td>
								<td id=\"".strtoupper($row['0'])."Detail\" class='DivInternoOculto'> </td>
								
							  </tr>";
					$total=$total+round($row['2'],5,2);
					$contador++;
					}
						}
						mysqli_close(conexion($pais));
					
				}
				else
				{	
					$retornar="Error de llenado de tabla";
				}
					$retornar=$retornar."</tbody></table></div>
			</center><br>
			
			<script   type=\"text/javascript\">

           $(document).ready(function(){
    
   $('#tablas').DataTable( {
        \"scrollY\": \"300px\",
        \"scrollX\": true,
        \"paging\":  true,
        \"info\":     false,
		\"pageLength\": 100,
        \"oLanguage\": {
      \"sLengthMenu\": \" _MENU_ \",
    }
        
         
         
    } );
    
  ejecutarpie();
  
	document.getElementById('tablas_length').style.display='none';
     
});
	document.getElementById('totalGrid').innerHTML='".toMoney($total)."';
           </script>";
				
				$retornar=$retornar."<div id='ultimoCont' style='display:none;'>".($contador-1)."</div>";
				$retornar=$retornar."<div id='ultimoPag' style='display:none;'>".($pag+1)."</div>";	
				return $retornar;
}

function encabezado()
{
	require_once('../fecha.php');
$idioma=idioma();
include('../idiomas/'.$idioma.'.php');
	return "<center>
			<div>
        	<table id=\"tablas\" border=\"0\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" class=\"hover tablas table\">
			
            	
				<thead>
				<tr  class=\"titulo\">
                	<th class=\"check\"><img src=\"../images/yes.jpg\"  style=\"width:50px;height:50px;\"/></th>
					<th hidden=\"hidden\">".$lang[$idioma]['Codigo']."</th>
					<th >".$lang[$idioma]['orderid']."</th>
					<th>".$lang[$idioma]['timoford']."</th>
                    <th>".$lang[$idioma]['grandtotal']."</th>
                    <th>".$lang[$idioma]['orderunits']."</th>
					<th>".$lang[$idioma]['ordsou']."</th>
					<th>".$lang[$idioma]['tranum']."</th>
					<th>".$lang[$idioma]['estatus']."</th>
					<th hidden=\"hidden\"></th>
					
                </tr> </thead>
                
			
            ";
}

				
				
?>
