<?php

include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Método de solicitud no permitido");
}

$nombre = trim($_POST["nombre"] ?? "");
$correo = trim($_POST["correo"] ?? "");
$telefono = trim($_POST["telefono"] ?? "");
$edadRecibida = $_POST["edad"] ?? "";
$programa = trim($_POST["programa"] ?? "");

if ($nombre === "" || $correo === "" || $telefono === "" || $edadRecibida === "" || $programa === "") {
    die("Error: todos los campos son obligatorios");
}

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    die("Error: el correo electrónico no tiene un formato válido");
}

$edad = filter_var(
    $edadRecibida,
    FILTER_VALIDATE_INT,
    [
        "options" => [
            "min_range" => 1,
            "max_range" => 100
        ]
    ]
);

if ($edad === false) {
    die("Error: la edad debe ser un número entre 1 y 100");
}

$programasPermitidos = [
    "Ingeniería Informática",
    "Ingeniería Industrial",
    "Administración de Empresas"
];

if (!in_array($programa, $programasPermitidos, true)) {
    die("Error: el programa seleccionado no es válido");
}

$consulta = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ?");
$consulta->bind_param("s", $correo);
$consulta->execute();
$consulta->store_result();

if ($consulta->num_rows > 0) {
    $consulta->close();
    $conexion->close();
    die("Error: el correo ya está registrado");
}

$consulta->close();

$insertar = $conexion->prepare(
    "INSERT INTO usuarios (nombre, correo, telefono, edad, programa)
     VALUES (?, ?, ?, ?, ?)"
);

$insertar->bind_param(
    "sssis",
    $nombre,
    $correo,
    $telefono,
    $edad,
    $programa
);

if ($insertar->execute()) {
    echo "<h2>Registro guardado correctamente</h2>";
    echo "<br>";
    echo "<a href='index.php'>Volver al formulario</a>";
    echo "<br><br>";
    echo "<a href='listar.php'>Ver estudiantes registrados</a>";
} else {
    echo "No fue posible guardar el registro";
}

$insertar->close();
$conexion->close();

?>