<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

</head>



<body class=" flex justify-center	 bg-gradient-to-r from-slate-500 via-slate-400 to-slate-500">

    <div class="px-48 container w-100 text-2xl font-bold fixed mt-12">
        <ul class="flex justify-around">
            <a href="roles.php">Roles</a>
            <a href="login.php">Usuarios</a>
            <a hr>Mi Cuenta</a>
        </ul>
    </div>
    <div class=" container flex p-28 gap-x-8">

        <div class="w-80">
            <button id="boton-formulario" class="bg-blue-500 flex hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded boton-formulario px-32 transition ease-in-out delay-150 bg-blue-500 hover:-translate-y-1 hover:scale-110 hover:bg-blue-900 duration-300">Agregar </button>
            <button id="boton-formulario" class="bg-blue-500 flex hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded boton-formulario    px-32 transition ease-in-out delay-150 bg-blue-500 hover:-translate-y-1 hover:scale-110 hover:bg-blue-900 duration-300">Roles </button>

            <form class="formulario-visible w-80 bg-white shadow-md rounded px-8 pt-6 pb-8  action=" method="post">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nombres</label><input required id="name" name="name" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </br>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="lastname">Apellidos</label><input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required id="lastname" name="lastname" type="text">
                </br>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="profession">Profesion</label><input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required id="profession" name="profession" type="text">
                </br>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="country">Pais</label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="country" id="">
                    <option value="" selected>Seleccione una opcion </option>
                    <option value="Colombia">Colombia</option>
                    <option value="Argentina">Argentina</option>
                    <option value="Ecuador">Ecuador</option>
                    <option value="Peru">Peru</option>
                    <option value="Estados Unidos">Estados Unidos</option>
                    <option value="Portugal">Portugal</option>
                </select>
                </br>
                <div class="flex justify-center bg-slate bg-slate-300 mt-2">
                    <button name="save" type="submit">Enviar</button>
                </div>
            </form>
        </div>

        <?php
        include_once('./conexion.php');
        $sql = "SELECT * FROM roles order by idRol desc ";
        $query = $coon->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if ($query->rowCount() > 0) {
            echo "<div id='tabla' class='ml-36'>
            <table class=' text-center text-white rounded-lg '>
            <th class='py-2 bg-slate-700'>Nombres</th>
            <th class=' bg-slate-700'>Apellidos</th>
            <th class='px-6 bg-slate-700'>Acciones</th>";
            foreach ($results as $result) {
                echo "<tr>"
                    . "<td class='whitespace-nowrap px-3 py-2 bg-slate-600 uppercase'>" . $result->idRol . "</td>"
                    . "<td class='whitespace-nowrap px-3 uppercase bg-slate-600 py-2'>" . $result->descripcion . "</td>"
                    . "<td class='whitespace-nowrap flex px-3 justify-between px-6 py-2
                	 bg-slate-600'> <form method='POST' class='bg-green-600'>
                   <input type='hidden' name='id' value='$result->idRol' /> 
                   <button name='edit' type='submit'><box-icon name='edit' type='solid' color='#fff' ></box-icon></button>
                </form>  
              
                <form class='bg-red-600' method='POST'>
                   <input type='hidden' name='id' value='$result->idRol' /> 
                   <button name='delete' type='submit'><box-icon name='trash' type='solid' color='#ffff' ></box-icon></button>
                </form>  </td>
                " .
                    "</tr>";
            }
            echo '</table></div>';
        }

        if (isset($_POST['save'])) {
            $nombres = $_POST['name'];
            $apellidos = $_POST['lastname'];
            $profesion = $_POST['profession'];
            $pais = $_POST['country'];
            $fregis = date('Y-m-d');
            $queryInsertar = $coon->prepare("insert into tbl_personal (nombres, apellidos, profesion ,pais, fregis )
         values(:nombres,:apellidos,:profesion,:pais,:fregis)");
            $queryInsertar->bindParam(':nombres', $nombres, PDO::PARAM_STR);
            $queryInsertar->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
            $queryInsertar->bindParam(':profesion', $profesion, PDO::PARAM_STR);
            $queryInsertar->bindParam(':pais', $pais, PDO::PARAM_STR);
            $queryInsertar->bindParam(':fregis', $fregis, PDO::PARAM_STR);
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
            window.location.href='index.php';  
        }, 1500);    
           </script>
           ";
            }
        }
        if (isset($_POST['delete'])) {
            $queryEliminar = $coon->prepare('delete from tbl_personal where id = :id');
            $queryEliminar->bindParam(':id', $_POST['id']);
            if ($queryEliminar->execute()) {

                echo "
            <script language='javascript'>
            Swal.fire({
             icon: 'success',
             title: 'Eliminado',
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
             window.location.href='index.php';  
         }, 1500);    
            </script>
            ";
            }
        }
        if (isset($_POST['edit'])) {
            $id = $_POST['id'];
            $queryEditar = $coon->prepare('select * from roles where idRol = :id ');
            $queryEditar->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
            $queryEditar->execute();
            $obj = $queryEditar->fetchObject();
            

            
            echo "<script>
       let boton= document.getElementById('boton-formulario').classList.add('boton-formulario-padding');
       
  </script>";

        ?>
 <!--  if ($obj -> idRol!=$result->idRol && $obj->descripcion=$result->descripcion) {
                                echo "<option value='$result->idRol'>$result->descripcion</option>";
                            } -->

            <form id='formulario-editar' class="w-80 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action='' method='post'>
                <input type="text" name="idRol" value="<?php echo $obj->idRol ?>">
                <h2 class="mx-12 whitespace-nowrap font-extrabold	text-lg">Actualizar Datos</h2>
                </br>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="descripcion"></label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required id="lastname" value="<?php echo $obj->descripcion ?>" name="descripcion" type="text">
                </br>
               
                </br>
                <div class="flex justify-center bg-slate bg-slate-300 mt-2">
                    <button name="update" type="submit">Actualizar </button>
                </div>


            </form>

        <?php

        }


        if (isset($_POST['update'])) {
            $id = trim($_POST['idRol']);
            $descripcion = trim($_POST['descripcion']);
            $consulta = "update roles set descripcion= :descripcion where (idRol = :idRol);";
            $queryConsultar = $coon->prepare($consulta);
            $queryConsultar->bindParam(':idRol', $id, PDO::PARAM_INT);
            $queryConsultar->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            
            $queryConsultar->execute();

            if ($queryConsultar->rowCount() > 0) {
                echo "
            <script language='javascript'>
            Swal.fire({
             icon: 'success',
             title: 'Registro actualizado',
             showConfirmButton: false,
             timer: 1500
             
           }); 
           setTimeout(() => {       
             window.location.href='roles.php';   
         }, 1500);
                     
            </script>
            ";
            } else {
                echo "
            <script language='javascript'>
            Swal.fire({
             icon: 'error',
             title: 'No fue posible actualizar el registro',
             showConfirmButton: false,
             timer: 1500
             
           }); 
           setTimeout(() => {
             window.location.href='roles.php'; 
             
         }, 1500);    
            </script>
            ";
            }
        }

        ?>

    </div>

    <style>
        .formulario-visible {
            display: none;
        }

        .formulario-oculto {
            display: block;
        }

        .boton-formulario-padding {
            padding: 0.5rem 1rem;
            transition: padding ease-in-out 1s;
        }

        #tabla::-webkit-scrollbar {
            -webkit-appearance: none;
        }


        #tabla::-webkit-scrollbar:horizontal {
            height: 0px;

        }

        #tabla::-webkit-scrollbar:vertical {
            width: 7px;
        }

        #tabla::-webkit-scrollbar-thumb {
            border-radius: 20px;
            border: .2px solid black;
        }

        body {
            max-height: 100vh;
        }
    </style>
    <script>
        const botonFormulario = document.querySelector(".boton-formulario");
        const formulario = document.querySelector(".formulario-visible");
        const formularioEditar = document.getElementById('formulario-editar');
        botonFormulario.addEventListener("click", () => {
            formulario.classList.toggle("formulario-oculto");
            formularioEditar.style.display = "none";
            botonFormulario.style.padding = "0.5rem 8rem";
        });
    </script>
</body>

</html>