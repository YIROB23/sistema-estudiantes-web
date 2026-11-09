<?php

include("conexion.php");

$programasPermitidos = [
    "Ingeniería Informática",
    "Ingeniería Industrial",
    "Administración de Empresas"
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
    $nombre = trim($_POST["nombre"] ?? "");
    $correo = trim($_POST["correo"] ?? "");
    $telefono = trim($_POST["telefono"] ?? "");
    $edadRecibida = $_POST["edad"] ?? "";
    $programa = trim($_POST["programa"] ?? "");

    if ($id === false || $id === null) {
        die("Error: identificador no válido");
    }

    if ($nombre === "" || $correo === "" || $telefono === "" || $edadRecibida === "" || $programa === "") {
        die("Error: todos los campos son obligatorios");
    }

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        die("Error: el correo no es válido");
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

    if (!in_array($programa, $programasPermitidos, true)) {
        die("Error: el programa no es válido");
    }

    $consulta = $conexion->prepare(
        "SELECT id FROM usuarios WHERE correo = ? AND id != ?"
    );

    $consulta->bind_param("si", $correo, $id);
    $consulta->execute();
    $consulta->store_result();

    if ($consulta->num_rows > 0) {
        $consulta->close();
        $conexion->close();
        die("Error: el correo ya está registrado");
    }

    $consulta->close();

    $actualizar = $conexion->prepare(
        "UPDATE usuarios
         SET nombre = ?, correo = ?, telefono = ?, edad = ?, programa = ?
         WHERE id = ?"
    );

    $actualizar->bind_param(
        "sssisi",
        $nombre,
        $correo,
        $telefono,
        $edad,
        $programa,
        $id
    );

    if ($actualizar->execute()) {

        $actualizar->close();
        $conexion->close();

        echo "<h2>Registro actualizado correctamente</h2>";
        echo "<br>";
        echo "<a href='listar.php'>Volver a la lista</a>";

        exit;

    } else {

        die("Error al actualizar el registro");

    }
}

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if ($id === false || $id === null) {
    die("Error: identificador no válido");
}

$consulta = $conexion->prepare(
    "SELECT * FROM usuarios WHERE id = ?"
);

$consulta->bind_param("i", $id);
$consulta->execute();

$resultado = $consulta->get_result();
$estudiante = $resultado->fetch_assoc();

$consulta->close();

if (!$estudiante) {
    die("Error: el estudiante no existe");
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar estudiante</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 40px;
        }

        .contenedor {
            width: 450px;
            margin: auto;
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
        }

        h2 {
            text-align: center;
        }

        label {
            display: block;
            margin-top: 15px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            margin-top: 20px;
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            cursor: pointer;
        }

        .volver {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #333;
            text-decoration: none;
        }

    </style>

</head>

<body>

<div class="contenedor">

    <h2>Editar estudiante</h2>

    <form action="editar.php" method="POST">

        <input
            type="hidden"
            name="id"
            value="<?php echo $estudiante["id"]; ?>"
        >

        <label>Nombre:</label>

        <input
            type="text"
            name="nombre"
            value="<?php echo htmlspecialchars($estudiante["nombre"]); ?>"
            required
        >

        <label>Correo:</label>

        <input
            type="email"
            name="correo"
            value="<?php echo htmlspecialchars($estudiante["correo"]); ?>"
            required
        >

        <label>Teléfono:</label>

        <input
            type="text"
            name="telefono"
            value="<?php echo htmlspecialchars($estudiante["telefono"]); ?>"
            required
        >

        <label>Edad:</label>

        <input
            type="number"
            name="edad"
            min="1"
            max="100"
            value="<?php echo $estudiante["edad"]; ?>"
            required
        >

        <label>Programa:</label>

        <select name="programa" required>

            <option value="">Seleccione un programa</option>

            <?php foreach ($programasPermitidos as $programa) { ?>

                <option
                    value="<?php echo htmlspecialchars($programa); ?>"
                    <?php echo $estudiante["programa"] === $programa ? "selected" : ""; ?>
                >
                    <?php echo htmlspecialchars($programa); ?>
                </option>

            <?php } ?>

        </select>

        <button type="submit">
            Actualizar información
        </button>

    </form>

    <a class="volver" href="listar.php">
        Volver a la lista
    </a>

</div>

</body>

</html>

<?php

$conexion->close();

?>