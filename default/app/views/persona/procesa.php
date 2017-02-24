<?php
if(isset($_POST["NombProv"]))
	{
                //echo $_POST["idmarca"];
		$opciones = '<option value="0"> Elejir Localidad</option>';

		$conexion= new mysqli("localhost","root","","bdmatriculacion");
		$strConsulta = "select `id`, `Localidad` from `ciudad_nacimiento` where `Provincia` ='".$_POST["NombProv"]."'";
		$result = $conexion->query($strConsulta);
		

		while( $fila = $result->fetch_array() )
		{
			$opciones.='<option value="'.$fila["id"].'">'.$fila["Localidad"].'</option>';
		}

		echo $opciones;
	}
?>
