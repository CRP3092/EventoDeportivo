<?php
include 'procesar.php';
$id = $_GET['id'] ?? null;
$organizador = $id ? obtenerOrganizadorPorId($id) : null;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <!-- Bootstrap CSS v5.2.1 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <title>Formulario Organizador</title>

</head>

<!--Fondo Negro Claro y Centrado-->
<body class="bg-dark-subtle">
    <h1 class="text-center alert alert-secondary"><?= $id ? 'Editar Organizador' : 'Añadir Organizador' ?></h1>
   
    <!--Datos Introducidos-->
    <form class="col-4 p-3 m-auto" action="procesar.php?accion=guardarOrganizador" method="POST">
        
        <input type="hidden" name="id" value="<?= $organizador['id'] ?? '' ?>">

        <div class="mb-3">
            <label for="username" class="form-label">Nombre del Organizador</label>
            <input type="text" class="form-control" name="nombre" placeholder="Nombre del Organizador" value="<?= $organizador['nombre'] ?? '' ?>" >
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo Electronico</label>
            <input type="text" class="form-control" name="email" placeholder="Correo Electronico" value="<?= $organizador['email'] ?? '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Telefono</label>
            <input type="text" class="form-control" name="telefono" placeholder="Telefono" value="<?= $organizador['telefono'] ?? '' ?>" required>
        </div>

        <!--Botón Actualizar o Guardar-->
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary" type="submit"><?= $id ? 'Actualizar' : 'Guardar' ?></button>
        </div>


    </form>




    <!-- Bootstrap JavaScript Libraries -->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>