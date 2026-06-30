<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Congreso 2026</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/stylesP.css">
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <h1 class="titulo">Registro al <span>Congreso</span></h1>
    </header>

    <main class="contenedor sombra">
        <h2>Formulario de Inscripción</h2>

        <form action="procesar_registro.php" method="POST" enctype="multipart/form-data" class="formulario"
            onsubmit="validarRegistro(event)">
            <fieldset>
                <legend>Datos Personales</legend>

                <div class="campo">
                    <label>Nombre Completo</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Tu Nombre" required>
                </div>

                <div class="campo">
                    <label>Correo Electrónico</label>
                    <input type="email" id="correo" name="correo" placeholder="tu@correo.com" required>
                </div>

                <div class="campo">
                    <label>Teléfono</label>
                    <input type="tel" id="telefono" name="telefono" placeholder="Tu Teléfono" required>
                </div>

                <div class="campo">
                    <label>Institución</label>
                    <input type="text" id="institucion" name="institucion" placeholder="Universidad o Empresa" required>
                </div>
            </fieldset>

            <fieldset>
                <legend>Tipo de Participación</legend>
                <div class="campo">
                    <label>Inscribirse como:</label>
                    <select name="tipo_usuario" id="tipo_usuario" onchange="alternarCamposPonente()" required>
                        <option value="" disabled selected>-- Seleccione --</option>
                        <option value="participante">Participante ($500 MXN)</option>
                        <option value="ponente">Ponente ($800 MXN)</option>
                    </select>
                </div>

                <div id="campos-ponente" style="display: none;">
                    <div class="campo">
                        <label>Categoría</label>
                        <select name="categoria_archivo" id="categoria_archivo">
                            <option value="ponencia">Ponencia</option>
                            <option value="memoria">Memoria</option>
                        </select>
                    </div>

                    <div class="campo">
                        <label>Subir Archivo (PDF/Word)</label>
                        <input type="file" id="archivo_ponencia" name="archivo_ponencia">
                    </div>
                </div>
            </fieldset>

            <div class="alinear-derecha flex">
                <input class="boton w-sm-100" type="submit" value="Continuar al Pago">
            </div>
        </form>
    </main>


    <!--Parte del java script para validaciones-->
    <script>
        function validarRegistro(event) {
            let valido = true;
            let mensajeError = "";

            // 1- validar nombre (solo letras y espacios, min 3 caracteres)
            let nombre = document.getElementById("nombre").value;
            let regexNombre = /^[a-zA-ZáéíóúñÑ\s]{3,50}$/;
            if (!regexNombre.test(nombre)) {
                mensajeError += "El nombre debe tener al menos 3 letras y solo caracteres válidos.\n";
                valido = false;
            }

            // 2- validar correo
            let correo = document.getElementById("correo").value;
            let regexCorreo = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!regexCorreo.test(correo)) {
                mensajeError += "Ingrese un correo electrónico válido.\n";
                valido = false;
            }

            // 3-validar tel (10 digitos)
            let telefono = document.getElementById("telefono").value;
            let regexTelefono = /^\d{10}$/;
            if (!regexTelefono.test(telefono)) {
                mensajeError += "El teléfono debe tener 10 dígitos (solo números).\n";
                valido = false;
            }

            // 4-Validar institucion (no vacio, min 3 caracteres)
            let institucion = document.getElementById("institucion").value;
            if (institucion.length < 3) {
                mensajeError += "La institución debe tener al menos 3 caracteres.\n";
                valido = false;
            }

            //5- validar tipo de usuario (no opcion por defecto)
            let tipoUsuario = document.getElementById("tipo_usuario").value;
            if (tipoUsuario === "") {
                mensajeError += "Seleccione un tipo de participación.\n";
                valido = false;
            }

            //6- si es ponente, validar que tenga archivo y cat
            if (tipoUsuario === "ponente") {
                let archivo = document.getElementById("archivo_ponencia").files.length;
                if (archivo === 0) {
                    mensajeError += "Debe subir un archivo (PDF o Word).\n";
                    valido = false;
                }

                let categoria = document.getElementById("categoria_archivo").value;
                if (categoria === "") {
                    mensajeError += "Seleccione una categoría para su archivo.\n";
                    valido = false;
                }
            }

            //Mostrar errores si los hay
            if (!valido) {
                alert("Errores en el formulario:\n\n" + mensajeError);
                event.preventDefault();
                return false;
            }

            return true;
        }
    </script>
</body>

<script>
    function alternarCamposPonente() {
        const tipoUsuario = document.getElementById('tipo_usuario').value;
        const camposPonente = document.getElementById('campos-ponente');

        if (tipoUsuario === 'ponente') {
            camposPonente.style.display = 'block'; //muestra los campos
        } else {
            camposPonente.style.display = 'none';  //oculta los campos
        }
    }
</script>

<!--Uso de los 3 DOM, se utilizan para hacer notificaciones-->
<script>
    // Nos aseguramos de que el HTML cargue antes de ejecutar el DOM puro
    document.addEventListener("DOMContentLoaded", function () {

        // 1. PRIMER USO DE DOM: Crear un nuevo elemento HTML (createElement)
        const barraNotificacion = document.createElement("div");

        // --- JS LIBRE: Lógica para un saludo dinámico según la hora local ---
        const hora = new Date().getHours();
        let textoSaludo = "";

        if (hora < 12) {
            textoSaludo = "¡Buenos días!";
        } else if (hora < 19) {
            textoSaludo = "¡Buenas tardes!";
        } else {
            textoSaludo = "¡Buenas noches!";
        }

        // 2. SEGUNDO USO DE DOM: Modificar el contenido y los estilos del elemento (textContent / style)
        barraNotificacion.textContent = textoSaludo + " Aún estás a tiempo de registrar tus ponencias para el Congreso 2026.";
        barraNotificacion.style.backgroundColor = "var(--secundario, #6200ee)";
        barraNotificacion.style.color = "white";
        barraNotificacion.style.textAlign = "center";
        barraNotificacion.style.padding = "1.5rem";
        barraNotificacion.style.fontWeight = "bold";
        barraNotificacion.style.fontSize = "1.8rem";

        // 3. TERCER USO DE DOM: Seleccionar un elemento existente y añadir el nuevo al documento (querySelector / insertBefore)
        const contenedorMain = document.querySelector("main");
        document.body.insertBefore(barraNotificacion, contenedorMain);
    });
</script>

</html>