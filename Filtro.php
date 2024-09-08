<?php
require_once ("Funciones.php");
$objfunciones = new filtro();

if (isset($_GET["Pais"]) && isset($_GET["fecha"])) {
    $Pais = $_GET["Pais"];
    $fecha = $_GET["fecha"];
    $resultado_filtro = $objfunciones->filtrardestino($Pais, $fecha);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Agencia de Viajes</title>
    <link rel="stylesheet" href="Estilos.css" />
</head>
<body>
    <div id="Titulo">
        <h1>Agencia de Viajes Futuro</h1>
    </div>
    <form action="Filtro.php" method="GET">
        <h2>Formulario de Registro</h2>
        <label>Selecciona el país al que deseas viajar:</label>
        <select required="true" name="Pais" id="Pais">
            <option value="Argentina">Argentina</option>
            <option value="Chile">Chile</option>
            <option value="Brasil">Brasil</option>
            <option value="Cuba">Cuba</option>
        </select><br>
        <label>Ingresa la fecha de viaje:</label>
        <input type="date" required="true" placeholder="fecha" name="fecha" id="fecha" /><br>

        <input type="submit" value="Filtrar" />

        <div class="recuadro-verde">
            <?php
            if (isset($resultado_filtro)) {
                if ($resultado_filtro == "Error") {
                    echo "No se encontraron registros";
                } else {
                    $arreglo = json_decode($resultado_filtro);
                    echo "Hotel encontrado: " . $arreglo->nombre;
                    echo "<br> País: " . $arreglo->ubicación;
                    echo "<br> Ciudad: " . $arreglo->destino;
                    echo "<br> Fecha de viaje: " . $arreglo->fecha;
                    echo "<br> <a href='Formulario_viaje.php' >Registrar</a>";
                }
            }

            ?>
        </div>

    </form>
</body>

</html>
<?php
$ofertaEspecialActiva = true;

if ($ofertaEspecialActiva) {
    echo '<script>
              window.onload = function() {
                  alert("¡Descubre nuestras ofertas especiales al reservar tu próximo viaje!");
              };
          </script>';
}
?>