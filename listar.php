<?php

include("conexion.php");

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Estudiantes registrados</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 30px;
        }

        .contenedor {
            width: 95%;
            margin: auto;
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
            overflow-x: auto;
        }

        h2 {
            text-align: center;
        }

        .editar {
            color: blue;
            text-decoration: none;
        }

        .eliminar {
            color: red;
        }

        .nuevo {
            display: inline-block;
            margin-top: 20px;
            color: black;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="contenedor">

    <h2>Estudiantes registrados</h2>

    <table class="table table-striped table-hover table-bordered text-center">

        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Edad</th>
                <th>Programa</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody id="tabla-estudiantes">
            <tr>
                <td colspan="7">Cargando estudiantes...</td>
            </tr>
        </tbody>

    </table>

    <a class="nuevo" href="index.php">
        + Registrar nuevo estudiante
    </a>

</div>

<script src="app.js"></script>

</body>
</html>

<?php

$conexion->close();

?>