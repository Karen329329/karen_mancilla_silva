<?php
class Hotel_Vuelo
{
    private $conn;

    // Constructor que establece la conexión a la base de datos
    public function __construct()
    {
        require_once ('conexion.php'); // Archivo de conexión
        $this->conn = $conn;
    }

    // Método para mostrar todos los hoteles
    public function mostrarHoteles($pais, $fecha)
    {
        $sql = "SELECT * ";
        $sql = $sql . "FROM HOTEL H INNER JOIN VUELO V ON H.UBICACIÓN = V.UBICACION ";
        $sql = $sql . "WHERE H.UBICACIÓN = '$pais' ";
        $sql = $sql . "AND V.FECHA = '$fecha'";

        $resultado = $this->conn->query($sql);

        if ($resultado->rowCount() > 0) {
            return json_encode($resultado->fetch(PDO::FETCH_ASSOC));
            /*while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
                echo "ID Hotel: " . $fila["id_hotel"] . " - Nombre: " . $fila["nombre"] . " - Ubicación: " . $fila["ubicación"] . " - Habitaciones disponibles: " . $fila["habitaciones_disponibles"] . " - Tarifa por noche: $" . number_format($fila["tarifa_noche"], 2) . "<br>";
            }*/
        } else {
            echo "No se encontraron hoteles";
        }
    }

    // Método para mostrar todos los vuelos
    public function GuardaRegistro($parm1, $parm2, $param)  
    {
        $sql = "insert into ";
        $resultado = $this->conn->query($sql);

        if ($resultado->rowCount() > 0) {
            while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
                echo "ID Vuelo: " . $fila["id_vuelo"] . " - Origen: " . $fila["origen"] . " - Destino: " . $fila["destino"] . " - Fecha: " . $fila["fecha"] . " - Plazas disponibles: " . $fila["plazas_disponibles"] . " - Precio: $" . number_format($fila["precio"], 2) . "<br>";
            }
        } else {
            echo "No se encontraron vuelos";
        }
    }

    
    public function cerrarConexion()
    {
        $this->conn = null;
    }

    function insertarHotel($id_hotel, $nombre, $ubicacion, $habitaciones_disponibles, $tarifa_noche) {
    
        try {
           
            $sql = "INSERT INTO hotel (id_hotel, nombre, ubicacion, habitaciones_disponibles, tarifa_noche)
                    VALUES (:id_hotel, :nombre, :ubicacion, :habitaciones_disponibles, :tarifa_noche)";
    
           
            $stmt = $this->conn->prepare($sql);
    
         
            $stmt->bindParam(':id_hotel', $id_hotel, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':ubicacion', $ubicacion, PDO::PARAM_STR);
            $stmt->bindParam(':habitaciones_disponibles', $habitaciones_disponibles, PDO::PARAM_INT);
            $stmt->bindParam(':tarifa_noche', $tarifa_noche, PDO::PARAM_INT);
    
          
            $stmt->execute();
    
            echo "Nuevo hotel insertado correctamente.<br>";
        } catch(PDOException $e) {
            echo "Error al insertar el hotel: " . $e->getMessage() . "<br>";
        }
    }
    function actualizarHotel($id_hotel, $nombre, $ubicacion, $habitaciones_disponibles, $tarifa_noche) {
        try {
          
            $sql = "UPDATE hotel 
                    SET nombre = :nombre,
                        ubicacion = :ubicacion,
                        habitaciones_disponibles = :habitaciones_disponibles,
                        tarifa_noche = :tarifa_noche
                    WHERE id_hotel = :id_hotel";
    
            $stmt = $this->conn->prepare($sql);
    
            
            $stmt->bindParam(':id_hotel', $id_hotel, PDO::PARAM_INT);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':ubicacion', $ubicacion, PDO::PARAM_STR);
            $stmt->bindParam(':habitaciones_disponibles', $habitaciones_disponibles, PDO::PARAM_INT);
            $stmt->bindParam(':tarifa_noche', $tarifa_noche, PDO::PARAM_INT);
    
            
            $stmt->execute();
    
            echo "Hotel actualizado correctamente.<br>";
        } catch(PDOException $e) {
            echo "Error al actualizar el hotel: " . $e->getMessage() . "<br>";
        }
    }
   
    function eliminarHotel($id_hotel) {
        try {
            
            $sql = "DELETE FROM hotel 
                    WHERE id_hotel = :id_hotel";
    
            
            $stmt = $this->conn->prepare($sql);
    
            
            $stmt->bindParam(':id_hotel', $id_hotel, PDO::PARAM_INT);
    
           
            $stmt->execute();
    
            echo "Hotel eliminado correctamente.<br>";
        } catch(PDOException $e) {
            echo "Error al eliminar el hotel: " . $e->getMessage() . "<br>";
        }
    }
    
    function insertarVuelo($id_vuelo, $origen, $destino, $fecha, $plazas_disponibles, $precio, $ubicacion) {
        global $conn; 
    
        try {
            
            $sql = "INSERT INTO vuelo.hotel (id_vuelo, origen, destino, fecha, plazas_disponibles, precio, ubicacion)
                    VALUES (:id_vuelo, :origen, :destino, :fecha, :plazas_disponibles, :precio, :ubicacion)";
    
            
            $stmt = $conn->prepare($sql);
    
            
            $stmt->bindParam(':id_vuelo', $id_vuelo, PDO::PARAM_INT);
            $stmt->bindParam(':origen', $origen, PDO::PARAM_STR);
            $stmt->bindParam(':destino', $destino, PDO::PARAM_STR);
            $stmt->bindParam(':fecha', $fecha); 
            $stmt->bindParam(':plazas_disponibles', $plazas_disponibles, PDO::PARAM_INT);
            $stmt->bindParam(':precio', $precio, PDO::PARAM_INT);
            $stmt->bindParam(':ubicacion', $ubicacion, PDO::PARAM_STR);
    
           
            $stmt->execute();
    
            echo "Nuevo vuelo insertado correctamente.<br>";
        } catch(PDOException $e) {
            echo "Error al insertar el vuelo: " . $e->getMessage() . "<br>";
        }
    }

    function actualizarVuelo($id_vuelo, $origen, $destino, $fecha, $plazas_disponibles, $precio, $ubicacion) {
        global $conn; 
    
        try {
            
            $sql = "UPDATE vuelo.hotel 
                    SET origen = :origen,
                        destino = :destino,
                        fecha = :fecha,
                        plazas_disponibles = :plazas_disponibles,
                        precio = :precio,
                        ubicacion = :ubicacion
                    WHERE id_vuelo = :id_vuelo";
    
            $stmt = $conn->prepare($sql);
    
            $stmt->bindParam(':id_vuelo', $id_vuelo, PDO::PARAM_INT);
            $stmt->bindParam(':origen', $origen, PDO::PARAM_STR);
            $stmt->bindParam(':destino', $destino, PDO::PARAM_STR);
            $stmt->bindParam(':fecha', $fecha); 
            $stmt->bindParam(':plazas_disponibles', $plazas_disponibles, PDO::PARAM_INT);
            $stmt->bindParam(':precio', $precio, PDO::PARAM_INT);
            $stmt->bindParam(':ubicacion', $ubicacion, PDO::PARAM_STR);
    
          
            $stmt->execute();
    
            echo "Vuelo actualizado correctamente.<br>";
        } catch(PDOException $e) {
            echo "Error al actualizar el vuelo: " . $e->getMessage() . "<br>";
        }
    }

    function eliminarVuelo($id_vuelo) {
        global $conn; 
    
        try {
       
            $sql = "DELETE FROM vuelo.hotel 
                    WHERE id_vuelo = :id_vuelo";
    
            $stmt = $conn->prepare($sql);
    
            $stmt->bindParam(':id_vuelo', $id_vuelo, PDO::PARAM_INT);
    
            $stmt->execute();
    
            echo "Vuelo eliminado correctamente.<br>";
        } catch(PDOException $e) {
            echo "Error al eliminar el vuelo: " . $e->getMessage() . "<br>";
        }
    }
    
    
}