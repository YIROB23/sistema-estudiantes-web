document.addEventListener("DOMContentLoaded", function () {

    // ==========================================
    // 1. VALIDACIÓN DEL FORMULARIO DE REGISTRO
    // ==========================================

    const formulario = document.getElementById("formEstudiante");

    if (formulario) {

        const nombre = document.getElementById("nombre");
        const correo = document.getElementById("correo");
        const telefono = document.getElementById("telefono");
        const edad = document.getElementById("edad");
        const programa = document.getElementById("programa");

        const mensajeError = document.getElementById("mensajeError");

        formulario.addEventListener("submit", function (evento) {

            mensajeError.textContent = "";
            mensajeError.classList.add("d-none");

            const campos = [
                nombre,
                correo,
                telefono,
                edad,
                programa
            ];

            campos.forEach(function (campo) {
                campo.classList.remove("is-invalid");
            });

            const errores = [];

            if (nombre.value.trim() === "") {
                nombre.classList.add("is-invalid");
                errores.push("El nombre es obligatorio.");
            }

            if (
                correo.value.trim() === "" ||
                !correo.validity.valid
            ) {
                correo.classList.add("is-invalid");
                errores.push("Ingrese un correo electrónico válido.");
            }

            if (telefono.value.trim() === "") {
                telefono.classList.add("is-invalid");
                errores.push("El teléfono es obligatorio.");
            }

            const valorEdad = Number(edad.value);

            if (
                edad.value.trim() === "" ||
                !Number.isInteger(valorEdad) ||
                valorEdad < 1 ||
                valorEdad > 100
            ) {
                edad.classList.add("is-invalid");
                errores.push("La edad debe estar entre 1 y 100 años.");
            }

            if (programa.value === "") {
                programa.classList.add("is-invalid");
                errores.push("Seleccione un programa académico.");
            }

            if (errores.length > 0) {

                evento.preventDefault();

                mensajeError.textContent = errores.join(" ");
                mensajeError.classList.remove("d-none");

                return;
            }

        });

        // Quitar la marca de error cuando se modifica un campo
        [nombre, correo, telefono, edad, programa].forEach(
            function (campo) {

                campo.addEventListener("input", function () {
                    campo.classList.remove("is-invalid");
                });

                campo.addEventListener("change", function () {
                    campo.classList.remove("is-invalid");
                });

            }
        );

        // ==========================================
        // 2. CONTADOR DE CARACTERES DEL NOMBRE
        // ==========================================

        const contadorNombre =
            document.getElementById("contadorNombre");

        function actualizarContador() {

            contadorNombre.textContent =
                nombre.value.length + " / 100 caracteres";

        }

        if (contadorNombre) {
            nombre.addEventListener("input", actualizarContador);
            actualizarContador();
        }

    }

    // ==========================================
    // 3. CONFIRMACIÓN ANTES DE ELIMINAR
    // ==========================================

    const formulariosEliminar =
        document.querySelectorAll(".form-eliminar");

    formulariosEliminar.forEach(function (formularioEliminar) {

        formularioEliminar.addEventListener("submit", function (evento) {

            const confirmar = confirm(
                "¿Está seguro de eliminar este estudiante?"
            );

            if (!confirmar) {
                evento.preventDefault();
            }

        });

    });

    // ==========================================
    // 4. CARGAR ESTUDIANTES MEDIANTE FETCH
    // ==========================================

    const tabla = document.getElementById("tabla-estudiantes");

    if (tabla) {

        fetch("obtener_estudiantes.php")

            .then(function (respuesta) {

                if (!respuesta.ok) {
                    throw new Error(
                        "No fue posible consultar los estudiantes."
                    );
                }

                return respuesta.json();

            })

            .then(function (datos) {

                tabla.replaceChildren();

                if (!Array.isArray(datos)) {
                    throw new Error(
                        "La respuesta del servidor no contiene una lista válida."
                    );
                }

                if (datos.length === 0) {

                    const fila = document.createElement("tr");
                    const celda = document.createElement("td");

                    celda.colSpan = 7;
                    celda.textContent =
                        "No hay estudiantes registrados.";

                    fila.appendChild(celda);
                    tabla.appendChild(fila);

                    return;
                }

                datos.forEach(function (estudiante) {

                    const fila = document.createElement("tr");

                    const celdaId = document.createElement("td");
                    const celdaNombre = document.createElement("td");
                    const celdaCorreo = document.createElement("td");
                    const celdaTelefono = document.createElement("td");
                    const celdaEdad = document.createElement("td");
                    const celdaPrograma = document.createElement("td");
                    const celdaAcciones = document.createElement("td");

                    celdaId.textContent = estudiante.id;
                    celdaNombre.textContent = estudiante.nombre;
                    celdaCorreo.textContent = estudiante.correo;
                    celdaTelefono.textContent = estudiante.telefono;
                    celdaEdad.textContent = estudiante.edad;
                    celdaPrograma.textContent = estudiante.programa;

                    // Enlace para editar
                    const enlaceEditar = document.createElement("a");

                    enlaceEditar.textContent = "Editar";
                    enlaceEditar.href =
                        "editar.php?id=" +
                        encodeURIComponent(estudiante.id);

                    enlaceEditar.className = "editar";

                    // Formulario para eliminar
                    const formularioEliminar =
                        document.createElement("form");

                    formularioEliminar.action = "eliminar.php";
                    formularioEliminar.method = "POST";
                    formularioEliminar.className = "form-eliminar";
                    formularioEliminar.style.display = "inline";

                    const campoId = document.createElement("input");

                    campoId.type = "hidden";
                    campoId.name = "id";
                    campoId.value = estudiante.id;

                    const botonEliminar =
                        document.createElement("button");

                    botonEliminar.type = "submit";
                    botonEliminar.textContent = "Eliminar";
                    botonEliminar.className = "eliminar";

                    botonEliminar.style.background = "none";
                    botonEliminar.style.border = "none";
                    botonEliminar.style.cursor = "pointer";

                    formularioEliminar.appendChild(campoId);
                    formularioEliminar.appendChild(botonEliminar);

                    // Agregar acciones a la celda
                    celdaAcciones.appendChild(enlaceEditar);

                    celdaAcciones.appendChild(
                        document.createTextNode(" | ")
                    );

                    celdaAcciones.appendChild(formularioEliminar);

                    // Agregar celdas a la fila
                    fila.appendChild(celdaId);
                    fila.appendChild(celdaNombre);
                    fila.appendChild(celdaCorreo);
                    fila.appendChild(celdaTelefono);
                    fila.appendChild(celdaEdad);
                    fila.appendChild(celdaPrograma);
                    fila.appendChild(celdaAcciones);

                    // Agregar la fila a la tabla
                    tabla.appendChild(fila);

                });

            })

            .catch(function (error) {

                console.error(
                    "Error al cargar los estudiantes:",
                    error
                );

                tabla.replaceChildren();

                const fila = document.createElement("tr");
                const celda = document.createElement("td");

                celda.colSpan = 7;
                celda.textContent =
                    "No fue posible cargar los estudiantes. Intente nuevamente.";

                fila.appendChild(celda);
                tabla.appendChild(fila);

            });

    }

});