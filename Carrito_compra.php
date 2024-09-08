<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
class carrito_compra
{private $acumulativo = [];
    public function anadir_carrito($hotel, $pais, $ciudad, $fecha_viaje, $duracion) {
            $nuevo_item = [
                'hotel' => $hotel,
                'pais' => $pais,
                'ciudad' => $ciudad,
                'fecha_viaje' => $fecha_viaje,
                'duracion' => $duracion
            ];
   
    $this->acumulativo[] = $nuevo_item;

    $_SESSION["carrito"]= $this->acumulativo;

    //Se llama al metodo que guardara en la base de datos el registros 
    	
	}
    public function actualizar_carrito($hotel, $pais, $ciudad, $fecha_viaje, $duracion)
	{
		
	}
    public function eliminar_carrito()
	{
        $_SESSION["carrito"]="";	
	}

}
?>