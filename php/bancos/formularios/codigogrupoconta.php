<?php

require_once('../../coneccion.php');
session_start();
$codigo=$_POST['combo'];

	$sql="select codigo from cat_nomenclatura where que_es='".$codigo."' order by codigo desc limit 1";
	
		$ejecutar=mysqli_query(conexion($_SESSION['pais']),$sql);

			if($ejecutar->num_rows>0)
			{
					if($row=mysqli_fetch_array($ejecutar,MYSQLI_ASSOC))
					{
						echo intval($row['codigo']);
					}

			}


?>