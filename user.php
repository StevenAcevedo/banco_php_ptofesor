<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

</head>
<body class="bg-gradient-to-r from-slate-500 via-slate-400 to-slate-500">
<div class="box-border container w-100 text-2xl font-bold fixed mt-12">
            <ul class="px-96 flex justify-start">
                <a class="bg-blue-500 rounded-3xl py-2 px-4 border-dashed border-2 border-sky-500 hover:bg-blue-700" href="index.php">Cerrar Sesion</a>
             
            </ul>
        </div>
    <div class="py-48 px-96 flex justify-around">
        
    <?php
     include_once('./conexion.php');
     $sql = "select * from tbl_personal  
     inner join roles on tbl_personal.roles_idRol=roles.idRol
     inner join pais on tbl_personal.pais_idpais =pais.idpais order by id desc ";

     $query = $coon->prepare($sql);
     $query->execute();
     $results = $query->fetchAll(PDO::FETCH_OBJ);

     if ($query->rowCount() > 0) {
         echo "<div id='tabla' class='
  
 '><table class=' text-center text-white   
 rounded-lg 
 '> <th class='py-2 bg-slate-700'>Nombres</th>
    <th class=' bg-slate-700'>Apellidos</th>
    <th class=' bg-slate-700'>Profesion</th>
    <th class=' bg-slate-700'>País</th>
    <th class='px-6 bg-slate-700'>Fecha registro</th>";
    
         foreach ($results as $result) {
             echo "<tr>"
                 . "<td class='whitespace-nowrap px-3 py-2 bg-slate-600'>" . $result->nombres . "</td>"
                 . "<td class='whitespace-nowrap px-3  bg-slate-600 py-2'>" . $result->apellidos . "</td>"
                 . "<td class='whitespace-nowrap px-3  bg-slate-600 py-2'>" . $result->profesion . "</td>"
                 . "<td class='whitespace-nowrap px-3  bg-slate-600 py-2'>" . $result->nombrePais . "</td>"
                 . "<td class='whitespace-nowrap px-3  bg-slate-600 py-2'>" . $result->fregis . "</td>".
                 "</tr>";
         }
         echo '</table></div>';
     }

     include_once('./conexion.php');
     $sql = "SELECT * FROM pais order by idpais desc ";
     $query = $coon->prepare($sql);
     $query->execute();
     $results = $query->fetchAll(PDO::FETCH_OBJ);

     if ($query->rowCount() > 0) {
         echo "<div id='tabla' class='ml-36'>
         <table class=' text-center text-white rounded-lg '>
         <th class='py-2 bg-slate-700'>ID</th>
         <th class=' bg-slate-700'>Nombre Pais</th>";
         foreach ($results as $result) {
             echo "<tr>"
                 . "<td class='whitespace-nowrap px-3 py-2 bg-slate-600 uppercase'>" . $result->idpais . "</td>"
                 . "<td class='whitespace-nowrap px-3 uppercase bg-slate-600 py-2'>" . $result->nombrePais . "</td>"
                 ;
                 "</tr>";
         }
         echo '</table></div>';
     }  
     include_once('./conexion.php');
     $sql = "SELECT * FROM roles order by idRol desc ";
     $query = $coon->prepare($sql);
     $query->execute();
     $results = $query->fetchAll(PDO::FETCH_OBJ);

     if ($query->rowCount() > 0) {
         echo "<div id='tabla' class='ml-36'>
         <table class=' text-center text-white rounded-lg '>
         <th class='py-2 bg-slate-700'>ID</th>
         <th class=' bg-slate-700'>Desccripcion</th>";
         foreach ($results as $result) {
             echo "<tr>"
                 . "<td class='whitespace-nowrap px-3 py-2 bg-slate-600 uppercase'>" . $result->idRol . "</td>"
                 . "<td class='whitespace-nowrap px-3 uppercase bg-slate-600 py-2'>" . $result->descripcion . "</td>".
                 "</tr>";
         }
         echo '</table></div>';
     }

    ?>
     <div  class="py-12 px-32  justify-around" >
            <div class="py-12"  style="font-size: 3rem;">
                <?php
                $consulta = "call usuarioXRol(2)";
                $queryConsultar = $coon->prepare($consulta);
                $queryConsultar->execute();
                $obj = $queryConsultar->fetchObject();
               
                ?>
                
                <p class="text-4xl text-center font-bold"> <?php echo $obj->cantidad;?><i class="text-center fa-solid fa-user"></i> Admins</p>

            </div>

            <div style="font-size: 3rem;">
                <?php
                $consulta = "call usuarioXRol(1)";
                $queryConsultar = $coon->prepare($consulta);
                $queryConsultar->execute();
                $obj = $queryConsultar->fetchObject();

                ?>
                
                
                <p class="text-4xl text-center font-bold"><?php echo $obj->cantidad; ?><i class="fa-solid fa-user"></i> Usser</p>

            </div>

        </div>
    </div>
</body>
</html>