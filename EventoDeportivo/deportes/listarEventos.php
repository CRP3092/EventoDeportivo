<?php
include 'procesar.php';
$orden = $_GET["orden"] ?? "nombre_evento";
$direccion = $_GET["direccion"] ?? "ASC";
$busqueda = $_GET['busqueda'] ?? null; // Captura la búsqueda del formulario (si existe)
$limite = 3; // Número de eventos por página
$pagina = $_GET['pagina'] ?? 1; // Página actual
$totalEventos = contarEventos($busqueda);
$totalPaginas = ceil($totalEventos / $limite);
$eventos = obtenerEventos($busqueda, $orden, $direccion, $limite, $pagina);
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
        <h1 class="text-white">Lista de Eventos Deportivos</h1>
    </div>
    <div class="container d-flex justify-content-center">

        
        <!--Listado Tabla-->
        <div class="col-10">
            <div class="container d-flex justify-content-center my-3">
                <form action="listarEventos.php" method="GET" class="d-flex">
                    <input type="text" name="busqueda" class="form-control me-2" placeholder="Buscar evento...">
                    <button type="submit" class="btn btn-secondary">Buscar</button>
                </form>
            </div>
            <table class="table table-striped table-hover table-dark">
                <!--Datos Base-->
                <tr>
                    <th>
                        <a href="?orden=nombre_evento&direccion=<?= alternarDireccion('nombre_evento', $orden, $direccion) ?>" class="text-decoration-none text-white">
                            Nombre Evento <?= $orden === 'nombre_evento' ? ($direccion === 'ASC' ? '▲' : '▼') : '' ?>
                        </a>
                    </th>
                    <th>
                        <a href="?orden=tipo_deporte&direccion=<?= alternarDireccion('tipo_deporte', $orden, $direccion) ?>" class="text-decoration-none text-white">
                            Tipo Deporte <?= $orden === 'tipo_deporte' ? ($direccion === 'ASC' ? '▲' : '▼') : '' ?>
                        </a>
                    </th>
                    <th>
                        <a href="?orden=fecha&direccion=<?= alternarDireccion('fecha', $orden, $direccion) ?>" class="text-decoration-none text-white">
                            Fecha <?= $orden === 'fecha' ? ($direccion === 'ASC' ? '▲' : '▼') : '' ?>
                        </a>
                    </th>
                    <th>
                        <a href="?orden=hora&direccion=<?= alternarDireccion('hora', $orden, $direccion) ?>" class="text-decoration-none text-white">
                            Hora <?= $orden === 'hora' ? ($direccion === 'ASC' ? '▲' : '▼') : '' ?>
                        </a>
                    </th>
                    <th>
                        <a href="?orden=ubicacion&direccion=<?= alternarDireccion('ubicacion', $orden, $direccion) ?>" class="text-decoration-none text-white">
                            Ubicación <?= $orden === 'ubicacion' ? ($direccion === 'ASC' ? '▲' : '▼') : '' ?>
                        </a>
                    </th>
                    <th>
                        <a href="?orden=id_organizador&direccion=<?= alternarDireccion('id_organizador', $orden, $direccion) ?>" class="text-decoration-none text-white">
                            Organizador <?= $orden === 'id_organizador' ? ($direccion === 'ASC' ? '▲' : '▼') : '' ?>
                        </a>
                    </th>
                    <th>Acciones</th>
                </tr>
                <!--Datos Mostrados de la BBDD-->
                <?php foreach ($eventos as $evento): ?>
                    <tr>
                        <td><?= $evento['nombre_evento'] ?></td>
                        <td><?= $evento['tipo_deporte'] ?></td>
                        <td><?= $evento['fecha'] ?></td>
                        <td><?= $evento['hora'] ?></td>
                        <td><?= $evento['ubicacion'] ?></td>
                        <td><?= $evento['organizador_nombre'] ?></td>

                        <!--Botón Modificar y Botón Eliminar-->
                        <td>
                            <a class="btn btn-warning" href="formulario_evento.php?id=<?= $evento['id'] ?>"><i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i></a>
                            <a onclick="return eliminar()" class="btn btn-danger" href="procesar.php?accion=eliminarEvento&id=<?= $evento['id'] ?> "><i class="fa-solid fa-trash" style="color: #ffffff;"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <nav aria-label="Paginación">
                        <ul class="pagination">
                            <li class="page-item <?= $pagina <= 1 ? 'disabled' : '' ?>">
                                <a class="page-link" href="?pagina=<?= $pagina - 1 ?>&busqueda=<?= $busqueda ?>&orden=<?= $orden ?>&direccion=<?= $direccion ?>">Anterior</a>
                            </li>
                            <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                                <li class="page-item <?= $pagina == $i ? 'active' : '' ?>">
                                    <a class="page-link" href="?pagina=<?= $i ?>&busqueda=<?= $busqueda ?>&orden=<?= $orden ?>&direccion=<?= $direccion ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            <li class="page-item <?= $pagina >= $totalPaginas ? 'disabled' : '' ?>">
                                <a class="page-link" href="?pagina=<?= $pagina + 1 ?>&busqueda=<?= $busqueda ?>&orden=<?= $orden ?>&direccion=<?= $direccion ?>">Siguiente</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            
            <!--Botón Organizador y Botón Añadir-->
            <div class="d-flex justify-content-between">
                <div class="text-start">
                    <a class="btn btn-primary" href="listarOrganizadores.php"><i class="fa-solid fa-list"></i>      Organizadores </a>
                </div>
                <div class="text-end">
                    <a class="btn btn-success" href="formulario_evento.php"><i class="fa-solid fa-calendar-plus fa-lg" style="color: #ffffff;"></i></a>
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