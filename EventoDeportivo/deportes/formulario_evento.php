<?php
include 'procesar.php';
$id = $_GET['id'] ?? null;
$evento = $id ? obtenerEventoPorId($id) : null;
$organizadores = obtenerOrganizadores();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <!-- Bootstrap CSS v5.2.1 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <title>Formulario Evento</title>

</head>


<!--Fondo Negro Claro y Centrado-->
<body class="bg-dark-subtle">
    <h1 class="text-center alert alert-secondary"><?= $id ? 'Editar Evento' : 'Añadir Evento' ?></h1>
    
     <!--Datos Introducidos-->
    <form class="col-4 p-3 m-auto" action="procesar.php?accion=guardarEvento" method="POST">
        <input type="hidden" name="id" value="<?= $evento['id'] ?? '' ?>">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Evento</label>
            <input type="text" class="form-control" name="nombre_evento" placeholder="Nombre del Evento" value="<?= $evento['nombre_evento'] ?? '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="tipoDeporte" class="form-label">Tipo de Deporte</label>
            <input type="text" class="form-control" name="tipo_deporte" placeholder="Tipo de Deporte" value="<?= $evento['tipo_deporte'] ?? '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" name="fecha" value="<?= $evento['fecha'] ?? '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="hora" class="form-label">Hora</label>
            <input type="time" class="form-control" name="hora" value="<?= $evento['hora'] ?? '' ?>" required>
        </div>
        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación</label>
            <input type="text" class="form-control" name="ubicacion" placeholder="Ubicación" value="<?= $evento['ubicacion'] ?? '' ?>" required>
        </div>
        <p>Organizador</p>
        <select class="mb-3 form-select" name="id_organizador" required>
            <?php foreach ($organizadores as $organizador): ?>
                <option value="<?= $organizador['id'] ?>" <?= $evento && $evento['id_organizador'] == $organizador['id'] ? 'selected' : '' ?>>
                    <?= $organizador['nombre'] ?>
                </option>
            <?php endforeach; ?>
        </select>

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