<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once ('Carrito_compra.php');
$objcarrito_compra = new carrito_compra();

if (isset($_GET["Hotel"]) && isset($_GET["Pais"]) && isset($_GET["Ciudad"]) && isset($_GET["Fecha"]) && isset($_GET["dias_viaje"])) {
    $Pais = $_GET["Pais"];
    $Ciudad = $_GET["Ciudad"];
    $fecha = $_GET["Fecha"];
    $dias_viaje = $_GET["dias_viaje"];
    $Hotel = $_GET["Hotel"];
    $objcarrito_compra->anadir_carrito($Hotel, $Pais, $Ciudad, $fecha, $dias_viaje);
}

if (isset($_SESSION["carrito"])) {
    if ($_SESSION["carrito"] != "") {
        $contadorcarrito = "(1)";
        $json = $_SESSION["carrito"];
        $data = $json;
        $hotel = $data[0]['hotel'];
        $pais = $data[0]['pais'];
        $ciudad = $data[0]['ciudad'];
        $fecha_viaje = $data[0]['fecha_viaje'];
        $duracion = $data[0]['duracion'];
    } else
        $contadorcarrito = "";
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agencia de Viajes</title>
    <link rel="stylesheet" href="Estilos.css" />
</head>

<body>

    <div with="100%" style="text-align: right;">
        <img src="Carrito.png" alt="Carrito de Compras" style="width: 50px;">
        <?php if (isset($contadorcarrito)) {
            echo $contadorcarrito;
        } ?>
        <form action="Formulario_viaje.php" method="post">
            <input type="submit" name="actualizar" value="Actualizar">
            <input type="submit" name="eliminar" value="Eliminar">
        </form>
    </div>

    <div>
        <div id="Titulo">
            <h1>Agencia de Viajes Futuro</h1>
        </div>

        <form action="" method="GET">
            <h2>Formulario de viaje</h2>

            <label>Seleccione el nombre del hotel:</label>
            <select required="true" name="Hotel" id="Hotel">
                <option value="">Seleccione hotel...</option>
                <option value="Hyatt">Hyatt</option>
                <option value="Mandarin Oriental">Mandarin Oriental</option>
                <option value="Rosa Agustina">Rosa Agustina</option>
                <option value="Marriott">Marriott</option>
                <option value="Iberostar">Iberostar</option>
            </select><br>

            <label>Selecciona el país al que deseas viajar:</label>
            <select required="true" name="Pais" id="Pais">
                <option value="">Seleccione pais...</option>
                <option value="Argentina">Argentina</option>
                <option value="Chile">Chile</option>
                <option value="Brasil">Brasil</option>
                <option value="República Dominicana">República Dominicana</option>
                <option value="Cuba">Cuba</option>
            </select><br>

            <label>Selecciona la ciudad a la que deseas viajar:</label>
            <select required="true" name="Ciudad" id="Ciudad">
                <option value="">Seleccione ciudad...</option>
                <option value="Buenos Aires">Buenos Aires</option>
                <option value="Chillán">Chillán</option>
                <option value="Río de Janeiro">Río de Janeiro</option>
                <option value="Punta Cana">Punta Cana</option>
                <option value="Varadero">Varadero</option>
            </select><br>

            <label>Ingresa la fecha de viaje:</label>
            <input type="date" required="true" placeholder="fecha" name="Fecha" id="fecha" /><br>

            <label>Ingresa los días que durará tu viaje:</label>
            <input type="number" required="true" placeholder="dias_viaje" maxlength="3" name="dias_viaje"
                id="dias_viaje" /><br>

            <input type="submit" value="Registrar" />

            <div class="recuadro-verde">
                <?php
                //echo "Su registro ha sido guardado exitosamente";
                ?>
            </div>
</body>

</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["eliminar"])) {
        if ($_POST["eliminar"] == "Eliminar") {
            $objcarrito_compra->eliminar_carrito();

        }
    }
    if (isset($_POST["actualizar"])) {
        if ($_POST["actualizar"] == "Actualizar") {
            echo "<script>";
            echo "var Datos = " . json_encode($_SESSION["carrito"]) . "; ";
            echo "document.getElementById('Hotel').value = '" . $hotel . "'; ";
            echo "document.getElementById('Pais').value = '" . $pais . "'; ";
            echo "document.getElementById('Ciudad').value = '" . $ciudad . "'; ";
            echo "document.getElementById('fecha').value = '" . $fecha_viaje . "'; ";
            echo "document.getElementById('dias_viaje').value = '" . $duracion . "'; ";
            echo "</script>";
            $objcarrito_compra->eliminar_carrito();

        }
    }
}

?>