<?php
include "modelo/conexion.php";
$id=$_GET["id"];
$sql=$conexion->query("SELECT * FROM usuarios WHERE id_usuario=$id");
?>

<!doctype html>
<html lang="es">

<head>
    <title>Panel Modificar Usuarios</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="imagenes/favicon.ico.png">

</head>

<body>
    <form class="col-4 p-3 m-auto" method="POST">
        <h3 class="text-center alert alert-secondary">Modificar Usuario</h3>
        <input type="hidden" name="id" value="<?=$_GET["id"]?>">
        <?php
        include "modificarUsuario.php";
        while($datos=$sql->fetch_object()) {?>
            <div class="mb-3">
                <label for="username" class="form-label">Usuario de la persona</label>
                <input type="text" class="form-control" name="usuario">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Nombre de la persona</label>
                <input type="text" class="form-control" name="nombre">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Apellidos de la persona</label>
                <input type="text" class="form-control" name="apellido">
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha de nacimiento</label>
                <input type="date" class="form-control" name="birthdate">
            </div>
            <div class="mb-3">
                <label for="mail" class="form-label">Correo</label>
                <input type="text" class="form-control" name="correo">
            </div>
            <div class="mb-3">
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" class="form-control" >
            </div>

        <?php }
        ?>
        <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Modificar usuario</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>