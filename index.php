```php
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registro de Estudiantes</title>

    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 40px;
        }

        .contenedor {
            width: 450px;
            max-width: 100%;
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

        button:hover {
            background-color: #555;
        }

        .boton {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #333;
        }

        #contadorNombre {
            display: block;
            text-align: right;
            color: #666;
            margin-top: 5px;
        }
    </style>
</head>

<body>

<div class="contenedor">

    <h2>Registro de Estudiantes</h2>

    <!-- Mensajes de validación -->
    <div
        id="mensajeError"
        class="alert alert-danger d-none"
        role="alert"
    ></div>

    <div
        id="mensajeExito"
        class="alert alert-success d-none"
        role="alert"
    ></div>

    <form action="procesar.php" method="POST" id="formEstudiante">

        <label for="nombre">Nombre:</label>
        <input
            type="text"
            name="nombre"
            id="nombre"
            maxlength="100"
            required
        >
        <div class="invalid-feedback">
            Debe ingresar el nombre del estudiante.
        </div>
        <small id="contadorNombre">0 / 100 caracteres</small>

        <label for="correo">Correo:</label>
        <input
            type="email"
            name="correo"
            id="correo"
            required
        >
        <div class="invalid-feedback">
            Ingrese un correo electrónico válido.
        </div>

        <label for="telefono">Teléfono:</label>
        <input
            type="text"
            name="telefono"
            id="telefono"
            required
        >
        <div class="invalid-feedback">
            Ingrese el teléfono del estudiante.
        </div>

        <label for="edad">Edad:</label>
        <input
            type="number"
            name="edad"
            id="edad"
            min="1"
            max="100"
            required
        >
        <div class="invalid-feedback">
            La edad debe estar entre 1 y 100 años.
        </div>

        <label for="programa">Programa:</label>
        <select name="programa" id="programa" required>
            <option value="">Seleccione un programa</option>
            <option value="Ingeniería Informática">Ingeniería Informática</option>
            <option value="Ingeniería Industrial">Ingeniería Industrial</option>
            <option value="Administración de Empresas">Administración de Empresas</option>
        </select>
        <div class="invalid-feedback">
            Seleccione un programa académico.
        </div>

        <button type="submit">Guardar información</button>

    </form>

    <a class="boton" href="listar.php">
        Ver estudiantes registrados
    </a>

</div>

<!-- Archivo JavaScript externo -->
<script src="app.js"></script>

</body>
</html>
```