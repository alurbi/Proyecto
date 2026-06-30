<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrador - Congreso 2026</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/stylesP.css">
    <link href="https://fonts.googleapis.com/css2?family=Krub:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <h1 class="titulo">Acceso <span>Administrativo</span></h1>
    </header>

    <main class="contenedor sombra contenedor-login">
        <form action="validar_login.php" method="POST" class="formulario" onsubmit="validarLogin(event)">
            <legend>Iniciar Sesión</legend>

            <?php if(isset($_GET['error'])): ?>
                <div class="alerta error" style="color: red; text-align: center; margin-bottom: 10px;">
                    Usuario o contraseña incorrectos
                </div>
            <?php endif; ?>

            <div class="campo">
                <label>Usuario</label>
                <input type="text" id="usuario" name="usuario" placeholder="Tu usuario" required>
            </div>

            <div class="campo">
                <label>Contraseña</label>
                <input type="password" id="password" name="password" placeholder="Tu contraseña" required>
            </div>

            <div class="enviar">
                <input class="boton w-100" type="submit" value="Ingresar">
            </div>

            <div class="regresar">
                <a href="HOME.html" class="enlace-negro">← Volver al Inicio</a>
            </div>
        </form>
    </main>

    <script>
        function validarLogin(event) {
            let valido = true;
            let mensajeError = "";

            //validar usuario no vacio
            let usuario = document.getElementById("usuario").value;
            if (usuario.trim() === "") {
                mensajeError += "El campo usuario no puede estar vacío.\n";
                valido = false;
            } else if (usuario.length < 3) {
                mensajeError += "El usuario debe tener al menos 3 caracteres.\n";
                valido = false;
            }

            //validar contraseña no vacía
            let password = document.getElementById("password").value;
            if (password.trim() === "") {
                mensajeError += "El campo contraseña no puede estar vacío.\n";
                valido = false;
            } else if (password.length < 4) {
                mensajeError += "La contraseña debe tener al menos 4 caracteres.\n";
                valido = false;
            }

            //mostrar errores si los hay
            if (!valido) {
                alert("Errores en el formulario:\n\n" + mensajeError);
                event.preventDefault();
                return false;
            }

            return true;
        }
    </script>

</body>
</html>