
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

    <title>Document</title>
</head>

<body class="box-border bg-gradient-to-r from-slate-500 via-slate-400 to-slate-500">
    <div class=" flex justify-center  items-center p-52">
    <form class="formulario-visible w-80 bg-white shadow-md rounded px-8 pt-6 pb-8  action=" method="post">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nombres</label><input required id="name" name="name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </br>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="lastname">Apellidos</label><input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required id="lastname" name="lastname" type="text">
                    </br>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="profession">Profesion</label><input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required id="profession" name="profession" type="text">
                    </br>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Username</label><input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required id="username" name="username" type="text">
                    </br>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label><input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required id="password" name="password" type="text">
                    </br>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="country">Pais</label>
                    <?php

                    include_once('./conexion.php');
                    $sql = "SELECT * FROM pais  ";

                    $query = $coon->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    echo "<select class='shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline' name='country'>\n";
                    if ($query->rowCount() > 0) {

                        foreach ($results as $result) {
                            echo "<option value='$result->idpais'>$result->nombrePais</option>";
                        }
                    }

                    echo "\n</select>\n";
                    ?>
                   
                 
                    </br>
                    <div class="flex justify-center bg-slate bg-slate-300 mt-2">
                        <button name="save" type="submit">Enviar</button>

                    </div>

                </form>
    </div>
    <?php
    include_once( "./conexion.php");

      
if (isset($_POST['save'])) {
    $nombres = $_POST['name'];
    $apellidos = $_POST['lastname'];
    $profesion = $_POST['profession'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $rol = 1;
    $pais = $_POST['country'];
    $fregis = date('Y-m-d');
    $queryInsertar = $coon->prepare("insert into tbl_personal (nombres, apellidos, profesion ,pais_idpais,roles_idRol, fregis ,username, password)
values(:nombres,:apellidos,:profesion,:pais,:rol,:fregis,:username,:password)");
    $queryInsertar->bindParam(':nombres', $nombres, PDO::PARAM_STR);
    $queryInsertar->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
    $queryInsertar->bindParam(':profesion', $profesion, PDO::PARAM_STR);
    $queryInsertar->bindParam(':pais', $pais, PDO::PARAM_INT);
    $queryInsertar->bindParam(':fregis', $fregis, PDO::PARAM_STR);
    $queryInsertar->bindParam(':rol', $rol, PDO::PARAM_INT);
    $queryInsertar->bindParam(':username', $username, PDO::PARAM_STR);
    $queryInsertar->bindParam(':password', $password, PDO::PARAM_STR);
    $queryInsertar->execute();
    $lastInsertId = $coon->lastInsertId();
    if ($lastInsertId > 0) {
        echo "
<script language='javascript'>
Swal.fire({
icon: 'success',
title: 'Registro Guardado',
showConfirmButton: false,
timer: 1500

}); 
setTimeout(() => {
window.location.href='index.php';  
}, 1500);
        
</script>
";
    } else {
        echo "
<script language='javascript'>
Swal.fire({
icon: 'error',
title: 'Errro no se pudo guardar',
showConfirmButton: false,
timer: 1500

}); 
setTimeout(() => {
window.location.href='register.php';  
}, 1500);    
</script>
";
    }
}
        

    ?>
</body>

</html>