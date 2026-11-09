<?php

header("Content-Type: application/json; charset=UTF-8");

include("conexion.php");

$sql = "SELECT id, nombre, correo, telefono, edad, programa
        FROM usuarios
        ORDER BY id DESC";

$resultado = $conexion->query($sql);

if (!$resultado) {

    http_response_code(500);

    echo json_encode([
        "error" => "No fue posible consultar los estudiantes."
    ]);

    $conexion->close();
    exit;
}

$estudiantes = [];

while ($fila = $resultado->fetch_assoc()) {
    $estudiantes[] = $fila;
}

echo json_encode(
    $estudiantes,
    JSON_UNESCAPED_UNICODE
);

$conexion->close();

?>