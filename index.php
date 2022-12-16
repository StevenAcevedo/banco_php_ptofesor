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

<body class="  bg-gradient-to-r from-slate-500 via-slate-400 to-slate-500">
    <div class=" flex justify-center  items-center p-80">
    <form class="block  formulario-visible w-80 bg-white shadow-md rounded px-8 pt-6 pb-8  action=" method="post">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Password</label><input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required id="username" name="username" type="text">
              </br>
         
              <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label><input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required id="password" name="password" type="text">
              </br>
              </br>
            
              <div class="flex justify-around  mt-2">
                  <button class="bg-slate bg-blue-300 px-2 py-1 hover:bg-blue-700 rounded-2xl" name="login" type="submit">Enviar</button>
          
              </div>
              </br>
              <a class="text-blue-900" href="register.php">Registarse</a>
          </form>
          
        
    </div>
    
    <?php
    include "./conexion.php";

        if (isset($_POST['login']) ){
           
            $queryEditar = $coon->prepare('select * from tbl_personal where username=:username and password = :password');
            $queryEditar->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
            $queryEditar->bindParam(':password', $_POST['password'], PDO::PARAM_STR);
            $queryEditar->execute();
             
           
            if ($queryEditar->rowCount()==null){
                echo "
                <script language='javascript'>
                Swal.fire({
                 icon: 'error',
                 title: 'Crendeciales invalidas',
                 showConfirmButton: false,
                 timer: 1500
                 
               }); 
              
                </script>
                ";
                
               }else
               {
                
                $obj = $queryEditar->fetchObject(); 
                $rol =$obj->roles_idRol;
                if ($rol==1){
              
                    
                    echo "
                    <script language='javascript'>
                    Swal.fire({
                     icon: 'success',
                     title: 'Ingreso Exitoso',
                     showConfirmButton: false,
                     timer: 1500
                     
                   }); 
                   setTimeout(() => {
                     window.location.href='login.php';  
                 }, 1500);    
                    </script>
                    ";
                   }
                elseif($rol==2){
                    echo "
                    <script language='javascript'>
                    Swal.fire({
                     icon: 'success',
                     title: 'Ingreso Exitoso',
                     showConfirmButton: false,
                     timer: 1500
                     
                   }); 
                   setTimeout(() => {
                     window.location.href='user.php';  
                 }, 1500);    
                    </script>
                    ";
                }
                
               }
              
        }
        

    ?>
</body>

</html>