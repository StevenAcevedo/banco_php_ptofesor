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

<body>
    <form action="" method="post">
        <input type="text" name="username" placeholder="username">
        <input type="text" name="password" placeholder="password">
        <button type="submit" name="login">Enviar</button>
    </form>
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