<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eventos Deportivos</title>

    <!--Tailwind y FontAwesome-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/47d7c4b9a5.js" crossorigin="anonymous"></script>
</head>

<!--Icono y Botones para ir al Botón Organizador y Botón  Eventos-->
<body class="bg-gray-200">
    <div class="flex flex-col justify-center items-center h-screen">
        <img src="./image-removebg-preview.png" alt="" width="200">
        <div class="flex">
            <a href="./listarOrganizadores.php"><button class="m-3 border-2 border-solid border-indigo-600 rounded-lg p-5 bg-indigo-100 font-bold hover:bg-indigo-300">Listar Organizadores <i class="fa-solid fa-user-pen"></i></button></a><!--  -->
            <a href="./listarEventos.php"><button class="m-3 border-2 border-solid border-indigo-600 rounded-lg p-5 bg-indigo-100 font-bold hover:bg-indigo-300">Listar Eventos <i class="fa-solid fa-medal"></i></button></a>
        </div>
        <!--Grupo Estudiantes de Ilerna-->
        <span class="text-lg text-indigo-600 font-semibold">Gonzalo Maraver</span>
        <span class="text-lg text-indigo-600 font-semibold">Santiago Guzman</span>
        <span class="text-lg text-indigo-600 font-semibold">Carlos Ramos</span>
    </div>

</body>

</html>