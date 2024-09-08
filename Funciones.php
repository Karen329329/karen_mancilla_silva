<?php
//Hola mundo

class filtro
{
	public function __construct()
	{
		require_once "datos.php";
	}
	public function filtrardestino($pais, $fecha)
	{
		$objDatos = new Hotel_Vuelo();
		$retorno = $objDatos->mostrarHoteles($pais, $fecha);
		return $retorno;
	}
	public function guardar_registro($hotel, $pais, $ciudad, $fecha_viaje, $duracion)
	{

	}
}
?>