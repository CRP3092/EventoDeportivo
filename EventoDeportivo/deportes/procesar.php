<?php
include 'conn.php';

if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];

    if ($accion == 'guardarEvento') {
        guardarEvento($_POST);
    } elseif ($accion == 'eliminarEvento') {
        eliminarEvento($_GET['id']);
    } elseif ($accion == 'guardarOrganizador') {
        guardarOrganizador($_POST);
    } elseif ($accion == 'eliminarOrganizador') {
        eliminarOrganizador($_GET['id']);
    }
}

//Funcion para Guardar Eventos
function guardarEvento($data)
{
    //Datos de la base de datos que lo añadimos en el formulario
    $conexion = conn();
    $id = $data['id'] ?? null;
    $nombre_evento = $data['nombre_evento'];
    $tipo_deporte = $data['tipo_deporte'];
    $fecha = $data['fecha'];
    $hora = $data['hora'];
    $ubicacion = $data['ubicacion'];
    $id_organizador = $data['id_organizador'];

    if ($id) { // Editar
        $query = "UPDATE eventos SET nombre_evento='$nombre_evento', tipo_deporte='$tipo_deporte', fecha='$fecha', hora='$hora', ubicacion='$ubicacion', id_organizador=$id_organizador WHERE id=$id";
    } else { // Crear
        $query = "INSERT INTO eventos (nombre_evento, tipo_deporte, fecha, hora, ubicacion, id_organizador) VALUES ('$nombre_evento', '$tipo_deporte', '$fecha', '$hora', '$ubicacion', $id_organizador)";
    }
    mysqli_query($conexion, $query);
    mysqli_close($conexion);
    echo '<script>';
    echo 'window.location.href = "listarEventos.php";';
    echo 'alert("Evento Creado Correctamente")'; //Mensaje de alerta cuando se completa el evento
    echo '</script>';
}

//funcion eliminar Eventos
function eliminarEvento($id)
{
    $conexion = conn();
    mysqli_query($conexion, "DELETE FROM eventos WHERE id=$id");
    mysqli_close($conexion);
    echo '<script>';
    echo 'window.location.href = "listarEventos.php";';
    echo '</script>';
}

//Funcion Guardar organizador
function guardarOrganizador($data)
{
     //Datos de la base de datos que lo añadimos en el formulario
    $conexion = conn();
    $id = $data['id'] ?? null;
    $nombre = $data['nombre'];
    $email = $data['email'];
    $telefono = $data['telefono'];

    if ($id) { // Editar
        $query = "UPDATE organizadores SET nombre='$nombre', email='$email', telefono='$telefono' WHERE id=$id";
    } else { // Crear
        $query = "INSERT INTO organizadores (nombre, email, telefono) VALUES ('$nombre', '$email', '$telefono')";
    }
    mysqli_query($conexion, $query);
    mysqli_close($conexion);
    echo '<script>';
    echo 'window.location.href = "listarOrganizadores.php";';
    echo 'alert("Organizador Creado Correctamente")';
    echo '</script>';

}

//Funcion eliminar organizador 
function eliminarOrganizador($id)
{
    $conexion = conn();
    $result = mysqli_query($conexion, "SELECT COUNT(*) AS conteo FROM eventos WHERE id_organizador = $id");
    $organizadorAsociado = mysqli_fetch_assoc($result);


    if ($organizadorAsociado['conteo'] > 0) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>';
        echo 'document.addEventListener("DOMContentLoaded", () => {';
        echo '  Swal.fire("Error", "El organizador tiene eventos asociados.", "error").then(() => {';
        echo '    window.location.href = "listarOrganizadores.php";';
        echo '  });';
        echo '});';
        echo '</script>';
        return;
    } else{
        echo '<script>';
        echo 'window.location.href = "listarOrganizadores.php";';
        echo '</script>';
    }

    mysqli_query($conexion, "DELETE FROM organizadores WHERE id=$id");
    mysqli_close($conexion);
}

//funcion mostrar eventos, ademas de paginacion y ordenacion. Maximo 4 paginas de datos se mostrará
function obtenerEventos($busqueda = null, $orden = 'nombre_evento', $direccion = 'ASC', $limite = 4, $pagina = 1) {
    $conexion = conn();

    // Calcular límites para la paginación
    $offset = ($pagina - 1) * $limite;

    // Construir consulta SQL
    $sql = "SELECT eventos.*, organizadores.nombre AS organizador_nombre 
            FROM eventos 
            JOIN organizadores ON eventos.id_organizador = organizadores.id";


    // Agregar filtro de búsqueda
    if ($busqueda) {
        $busqueda = mysqli_real_escape_string($conexion, $busqueda);
        $sql .= " WHERE eventos.nombre_evento LIKE '%$busqueda%' 
                  OR eventos.tipo_deporte LIKE '%$busqueda%' 
                  OR eventos.ubicacion LIKE '%$busqueda%' 
                  OR organizadores.nombre LIKE '%$busqueda%'";
    }

    // Agregar ordenación
    $orden = mysqli_real_escape_string($conexion, $orden);
    $direccion = strtoupper($direccion) === 'DESC' ? 'DESC' : 'ASC'; // Validar dirección
    
    $columnasValidas = ['nombre_evento', 'tipo_deporte', 'fecha', 'hora', 'ubicacion', 'organizador_nombre'];
    if (!in_array($orden, $columnasValidas)) {
        $orden = 'nombre_evento'; 
    }
    function alternarDireccion($columnaActual, $columnaOrdenada, $direccionActual) {
        if ($columnaActual === $columnaOrdenada) {
            return $direccionActual === 'ASC' ? 'DESC' : 'ASC';
        }
        return 'ASC'; // Comenzar Ascendente
    }

    // Agregar ordenación y límites
    $sql .= " ORDER BY $orden $direccion LIMIT $limite OFFSET $offset"; // Ordenar solo por columna válida


    $result = mysqli_query($conexion, $sql);
    $eventos = [];
    while ($fila = mysqli_fetch_assoc($result)) {
        $eventos[] = $fila;
    }

    mysqli_close($conexion);
    
    return $eventos;
    
}

function contarEventos($busqueda = null) {
    $conexion = conn();
    $sql = "SELECT COUNT(*) AS total FROM eventos 
            JOIN organizadores ON eventos.id_organizador = organizadores.id";

    if ($busqueda) {
        $busqueda = mysqli_real_escape_string($conexion, $busqueda);
        $sql .= " WHERE eventos.nombre_evento LIKE '%$busqueda%' 
                  OR eventos.tipo_deporte LIKE '%$busqueda%' 
                  OR eventos.ubicacion LIKE '%$busqueda%' 
                  OR organizadores.nombre LIKE '%$busqueda%'";
    }

    $result = mysqli_query($conexion, $sql);
    $total = mysqli_fetch_assoc($result)['total'];
    mysqli_close($conexion);
    return $total;
}


function obtenerOrganizadores($busqueda = null)
{
    $conexion = conn();
    $sql = "SELECT * FROM organizadores";

    //Bara de busqueda
    if($busqueda){
        $busqueda = mysqli_real_escape_string($conexion, $busqueda);
        $sql  .= " WHERE organizadores.nombre LIKE '%$busqueda%' ";
    } 
    $result = mysqli_query($conexion, $sql);
    $organizadores = [];
    while($fila =mysqli_fetch_assoc($result)){
        $organizadores[] = $fila;
    }       
    mysqli_close($conexion);
    return $organizadores;
}
// Función para obtener un evento por su ID
function obtenerEventoPorId($id)
{
    $conexion = conn();  // Usamos la función de conexión a la base de datos
    $query = "SELECT eventos.id, eventos.nombre_evento, eventos.tipo_deporte, eventos.fecha, eventos.hora, eventos.ubicacion, eventos.id_organizador, organizadores.nombre AS organizador_nombre 
              FROM eventos 
              JOIN organizadores ON eventos.id_organizador = organizadores.id
              WHERE eventos.id = $id";  // Usamos el ID directamente en la consulta

    $result = $conexion->query($query);  // Ejecutar la consulta
    $evento = $result->fetch_assoc();  // Obtener el evento como un arreglo asociativo
    $conexion->close();  // Cerrar la conexión

    return $evento;  // Devolver el evento
}
// Función para obtener un organizador por su ID
function obtenerOrganizadorPorId($id)
{
    $conexion = conn();  // Usamos la función de conexión a la base de datos
    $query = "SELECT id, nombre, email, telefono FROM organizadores WHERE id = $id";  // Usamos el ID directamente en la consulta

    $result = $conexion->query($query);  // Ejecutar la consulta
    $organizador = $result->fetch_assoc();  // Obtener el organizador como un arreglo asociativo
    $conexion->close();  // Cerrar la conexión

    return $organizador;  // Devolver el organizador
}

