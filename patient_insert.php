<?php
    include "connection.php";

    // si edit tiene algo y id tiene algo entonces es que se quiere editar ese patient
    if( isset($_GET['edit']) && isset($_GET['id']) ){   
        echo "editar";
        $edit = $_GET['edit'];
        $id = $_GET['id'];
        $id = mysqli_real_escape_string($dbconnection, $_GET['id']);

        $query = "SELECT * FROM Patients WHERE patient_id =".$id;
        $result = mysqli_query($dbconnection,$query);
        $datos = mysqli_fetch_array($result);
    }elseif(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['birth_date']) )  {
            // si se setean esas variables es un post
            
            echo "post";
            
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $birth_date = $_POST['birth_date'];
            $first_name = mysqli_real_escape_string($dbconnection, $first_name);
            $last_name = mysqli_real_escape_string($dbconnection, $last_name);
            $birth_date = mysqli_real_escape_string($dbconnection, $birth_date);

            // si se setea el id es que se quiere editar
            if(isset($_POST['id']) ){
                echo "editar";
                $patient_id = $_POST['id'];

                $patient_id = mysqli_real_escape_string($dbconnection, $patient_id);

                // $query = "UPDATE Patients SET first_name = '{$first_name}';";
                $query = "UPDATE Patients SET first_name = '{$first_name}' , last_name = '{$last_name}' , birth_date = '{$birth_date}' where patient_id = {$patient_id};";

                // $query = "UPDATE Patients SET first_name = '".$first_name."' , last_name = '".$last_name. "' , birth_date = '".$birth_date ."' where patient_id=1;";
                echo $query;

                if (mysqli_query($dbconnection,$query)) 
                {
                //     $query_delete_emp = "delete from emp where eid=$id_emp";
                //     mysqli_query($dbconnection,$query_delete_emp);
                    
                //     header("Location: demo_struc.php");
                    echo 'update succesfully';
            		header("Location: patients.php");
                }	 
            }
            else{
                echo "crear";
                $query = "INSERT INTO Patients (first_name, last_name, birth_date) values ('{$first_name}', '{$last_name}', '{$birth_date}');";
                // echo $query;
                // echo "{$query} con f string";
                if (mysqli_query($dbconnection,$query)){
                    echo 'create succesfully';
            		header("Location: patients.php");
                }	
            }
        } else{
            echo "crear2";
        }
    $table = 'Patients';
?>

<!DOCTYPE html>
    <html>
    <head>
        <?php
            include "header.html";
        ?>
    </head>
	<body>
	    <div id="wrap" class="container">
            <?php
                include "navbar.html";
            ?>
	    <h2>
            <?php
                echo $table;
            ?>
        </h2>

        <form action="patient_insert.php" method="post">
            <div class="form-group">
                <label for="first_name">Nombre</label>
                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Entre el nombre" value="<?php if($edit)print $datos['first_name'];?>" required>
            </div>
            <div class="form-group">
                <label for="last_name">Apellido</label>
                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Entre apellido" value="<?php if($edit)print $datos['last_name'];?>" required>
            </div>
            <div class="form-group">
                <label for="birth_date">Fecha de nacimiento</label>
                <input type="date" class="form-control" name="birth_date" id="birth_date" value="<?php if($edit)print $datos['birth_date'];?>" required>
            </div>

            <?php
                if($edit)print '<input type="hidden" name="id" value="'.$id.'">';
            ?>

            <br>
            <input type="submit" class="btn btn-primary" value="<?php if($edit)print 'Editar'; else print 'Insertar';?>">
        </form>      
    </body>
</html>