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
    <span>GABRIEL ROMERO TORRES</span>
    <span>CCOM-4027-FINAL-PROJECT</span>



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
                <a class="" href="https://ada.uprrp.edu/~gabriel.romero5/PROYECTO/patient_condition.php">Patient - Condition</a>  (Relación)  
            </li>
        </ul>
    </p>


    <p>
        La última relación (Patient - Condition) es una peculiar porque se puede modificar desde el
        <a href="https://ada.uprrp.edu/~gabriel.romero5/PROYECTO/patient_insert.php">"INSERT" de patients</a>. Qué también se adapta para realizar el update.
    </p>

    <h1>VISTAS </h1>

    <h2><a href="https://ada.uprrp.edu/~gabriel.romero5/PROYECTO/">Home</a></h2>

    <p>
        Esta es una vista preparada para un tutorial en el que se explica como se puede utilizar la aplicación, su propósito, entre otras cosas.
    </p>


    <h2><a href="https://ada.uprrp.edu/~gabriel.romero5/PROYECTO/patients.php">Patients</a></h2>

    <p>
        Vista creada para poder ver una lista de todos los pacientes. Presionando el botón de <code>DELETE</code> y confirmando, se puede dar paso a eliminar a un paciente existente. Cuando se borra un paciente también se borran sus relaciones. Por ejemplo, si el PACIENTE1 tenía Diabetes e Hipertensión registradas, si se decide eliminar el PACIENTE1, entonces también se eliminará de las demás tablas relacionadas. Quedando ningún rastro de cuales eran las condiciones médicas, por ejemplo, del paciente recién eliminado. De la misma manera que se pueden añadir presionando el botón "add" apareceria el mismo formulario pero en este caso para poder editar algo a la base datos.
    </p>

    <h2><a href="https://ada.uprrp.edu/~gabriel.romero5/PROYECTO/medical_conditions.php">Medical Conditions</a></h2>

    <p>
        Esta vista muestra todas las condiciones médicas disponibles en la base de datos. Desde aquí, se pueden añadir nuevas condiciones, editar las existentes o eliminarlas. Si una condición médica está asociada a un paciente, eliminarla también eliminará la relación en la tabla <code>Patient_Condition</code>. Esto asegura que no queden registros huérfanos o inconsistencias en la base de datos.
    </p>

    <h2><a href="https://ada.uprrp.edu/~gabriel.romero5/PROYECTO/users.php">Users</a></h2>

    <p>
        Esta vista presenta la lista de todos los usuarios registrados en el sistema. Permite crear, editar y eliminar usuarios. Estos usuarios pueden ser profesionales de la salud u otros tipos de administradores. La funcionalidad de esta vista facilita la administración de accesos y la organización del personal dentro del sistema.
    </p>

    <h2><a href="https://ada.uprrp.edu/~gabriel.romero5/PROYECTO/annotations.php">Annotations</a></h2>

    <p>
        Esta vista permite gestionar las anotaciones clínicas realizadas por los usuarios. Desde esta vista se pueden añadir nuevas anotaciones, verlas en detalle o eliminarlas. Cada anotación queda registrada con el usuario que marcó que la hizo y la fecha correspondiente.
    </p>

    <h2><a href="https://ada.uprrp.edu/~gabriel.romero5/PROYECTO/patient_condition.php">Patient_Condition</a></h2>

    <p>
        Esta vista representa y gestiona explícitamente la tabla de relación entre pacientes y condiciones médicas. Desde aquí, se pueden añadir nuevas relaciones manualmente seleccionando un paciente y una condición médica, así como eliminar relaciones específicas. Esto resulta útil para modificar asociaciones sin necesidad de editar directamente los datos del paciente o la condición. Esta vista brinda control directo sobre la tabla intermedia <code>Patient_Condition</code>.
    </p>


 
    
</body>
</html>


