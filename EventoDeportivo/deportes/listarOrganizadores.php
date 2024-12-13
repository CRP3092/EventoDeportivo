<?php
include 'procesar.php';
$busqueda = $_GET['busqueda'] ?? null;
$organizadores = obtenerOrganizadores($busqueda);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eventos Deportivos</title>
    <!--Bootstrap y Fontawesome-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/47d7c4b9a5.js" crossorigin="anonymous"></script>
</head>

<!--Fondo Negro y Centrado-->
<body class="bg-dark">
    <div class="container d-flex justify-content-center">
        <h2 class="text-white">Organizadores</h2>
    </div>
    <div class="container d-flex justify-content-center">

        <!--Listado Tabla-->
        <div class="col-9">
        <div class="col-10">
            <div class="container d-flex justify-content-center my-3">
                <form action="listarOrganizadores.php" method="GET" class="d-flex">
                    <input type="text" name="busqueda" class="form-control me-2" placeholder="Buscar Evento...">
                    <button type="submit" class="btn btn-secondary">Buscar</button>
                </form>
            </div>
            <table class="table table-striped table-hover table-dark">
            <!--Datos Base-->
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>

            <!--Datos Mostrados de la BBDD-->
            <?php foreach ($organizadores as $organizador): ?>
                <tr>
                    <td><?= $organizador['nombre'] ?></td>
                    <td><?= $organizador['email'] ?></td>
                    <td><?= $organizador['telefono'] ?></td>

                    <!--Botón Modificar y Botón Eliminar-->
                    <td>
                        <a class="btn btn-warning" href="formulario_organizador.php?id=<?= $organizador['id'] ?>"><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i></a>
                        <a onclick="return eliminar()" class="btn btn-danger" href="procesar.php?accion=eliminarOrganizador&id=<?= $organizador['id'] ?>"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </table>

            <!--Botón Organizador y Botón Añadir-->
            <div class="d-flex justify-content-between">
            <div class="text-start">
                    <a class="btn btn-primary" href="listarEventos.php"><i class="fa-solid fa-list"></i>     Eventos</a>
                </div>
                <div class="text-end">
                 <a class="btn btn-success" href="formulario_organizador.php"><i class="fa-solid fa-user-plus" style="color: #ffffff;"></i></a>
                </div>
                
            </div>
            
        </div>

    </div>

    <script>
        function eliminar() {
            let respuesta = confirm("Estas seguro que deseas eliminar?");
            return respuesta
        }
    </script>
    

    
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