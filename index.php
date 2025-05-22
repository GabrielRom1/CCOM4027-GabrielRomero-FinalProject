<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include "header.html"?>
    <?php include "scriptsBase.html"?>

</head>
<body>
    <?php include "navbar.html"?>


    <h1>Bienvenido al proyecto Care Track!</h1>


    <p>
        Este proyecto está pensado para llevar un manejo de interacciones entre los cuidadores (ya sea en un asilo de ancianos o en un cuido de niños).
    </p>


    <p>
        En específico el enfoque de este proyecto no fue la practicidad para algún cliente específico, por esto no tiene un sistem de cuenta con un registro con autenticación ni distribución de permisos. Sin embargo se preparó para poder hacer CRUD (Create, Read, Update, Delete) a todas las tablas diseñadas para este proyecto. Las tablas de la base de datos para este proyecto son:
        <ul>
            <li> 
                <a class="" href="https://ada.uprrp.edu/~gabriel.romero5/PROYECTO/users.php">Users</a> (Entidad)
            </li>
            <li>
             <a class="" href="https://ada.uprrp.edu/~gabriel.romero5/PROYECTO/patients.php">Patients</a> (Entidad)
            </li>
            <li>
                <a class="" href="https://ada.uprrp.edu/~gabriel.romero5/PROYECTO/conditions.php">Medical Conditions</a> (Entidad)
            </li>
            <li>
             <a class="" href="https://ada.uprrp.edu/~gabriel.romero5/PROYECTO/patients.php">Annotations</a>  (Relación)  
            </li>
            <li>
                Patient-Conditions (Relación)
            </li>
        </ul>
    </p>


    <p>
        La última relación 

    </p>



    
</body>
</html>


