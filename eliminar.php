<?php

include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Método de solicitud no permitido");
}

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

if ($id === false || $id === null) {
    die("Error: identificador no válido");
}

$eliminar = $conexion->prepare(
    "DELETE FROM usuarios WHERE id = ?"
);

$eliminar->bind_param("i", $id);

if ($eliminar->execute()) {

    if ($eliminar->affected_rows > 0) {
        echo "<h2>Registro eliminado correctamente</h2>";
    } else {
        echo "<h2>El registro no existe o ya fue eliminado</h2>";
    }

} else {

    echo "Error al eliminar el registro";

}

echo "<br>";
echo "<a href='listar.php'>Volver a la lista</a>";

$eliminar->close();
$conexion->close();

?>