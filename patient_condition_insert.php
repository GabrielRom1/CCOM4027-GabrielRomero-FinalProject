<?php
    include "connection.php";

    // si edit tiene algo y id tiene algo entonces es que se quiere editar ese user
    if( isset($_GET['edit']) && isset($_GET['id']) ){   
        // echo "editar";
        $edit = $_GET['edit'];
        $id = $_GET['id'];

        $id = mysqli_real_escape_string($dbconnection, $_GET['id']);

        $query = "SELECT * FROM Patient_Condition WHERE patient_condition_id =".$id;
        $result = mysqli_query($dbconnection,$query);
        $datos = mysqli_fetch_array($result);
    }elseif(isset($_POST['patient_id']) && isset($_POST['condition_id']))  {
            // si se setean esas variables es un post
            $edit = false;
            
            // echo "post";
            
            $patient_id = $_POST['patient_id'];  
            $condition_id = $_POST['condition_id'];            

            $patient_id = mysqli_real_escape_string($dbconnection, $patient_id);
            $condition_id = mysqli_real_escape_string($dbconnection, $condition_id);

            // si se setea el id es que se quiere editar
            if(isset($_POST['id']) ){
                // echo "editar";
                // echo $condition_name;
                $patient_condition_id = $_POST['id'];
                $patient_condition_id = mysqli_real_escape_string($dbconnection, $patient_condition_id);

                
                $query = "UPDATE Patient_Condition
                        SET patient_id = '{$patient_id}',
                        condition_id = '{$condition_id}'
                        WHERE patient_condition_id = {$patient_condition_id};";

                if (mysqli_query($dbconnection,$query)) 
                {
                //     $query_delete_emp = "delete from emp where eid=$id_emp";
                //     mysqli_query($dbconnection,$query_delete_emp);
                    
                //     header("Location: demo_struc.php");
                    // echo 'update succesfully';
            		header("Location: patient_condition.php");
                }	 
            }
            else{
                // echo "crear";
                $query = "INSERT INTO Patient_Condition (patient_id, condition_id)
                VALUES ({$patient_id}, {$condition_id});";
                // echo $query;
                // echo "{$query} con f string";
                if (mysqli_query($dbconnection,$query)){
                    echo 'create succesfully';
            		header("Location: patient_condition.php");
                }	
            }
        } else{
            $edit = false;

            // echo "crear2";
        }
    $table = 'Patient Conditions';
    $query_patients = "SELECT * FROM Patients";
    $patients = mysqli_query($dbconnection, $query_patients);

    $query_conditions = "SELECT * FROM Medical_Conditions";
    $conditions = mysqli_query($dbconnection, $query_conditions);
    
?>

<!DOCTYPE html>
    <html>
    <head>
        <?php
            include "header.html";
            include "scriptsBase.html";
        ?>
    </head>
	<body>
	    <div id="wrap" class="container">
            <?php
                include "navbar.html";
            ?>
	    <h2>
            <?php
                echo "<h1 align=center>$table</h1>";
            ?>
        </h2>

        <form action="patient_condition_insert.php" method="post">

            <div class="form-group">
                <label for="role">Patient</label>
                <select class="form-control" name="patient_id" id="patient_id" >">
                    <?php
                        while($patient = mysqli_fetch_array($patients))
                        {
                            $p_id = $patient['patient_id'];
                            $first_name = $patient['first_name'];
                            print "<option value='$p_id' ";
                            if($edit) echo  $datos["patient_id"] == $p_id? 'selected':'';
                            print ">$first_name</option>";
                        }
                    ?>   
                </select>
            </div>

            <div class="form-group">
                <label for="condition_id">Conditions</label>
                <select class="form-control" name="condition_id" id="condition_id" value="<?php if($edit)print $datos['condition_id'];?>">
                    <?php
                        while($condition = mysqli_fetch_array($conditions))
                        {
                            $c_id = $condition['condition_id'];
                            $name = $condition['name'];
                            print "<option value='$c_id' ";
                            if($edit) echo  $datos["condition_id"] == $c_id? 'selected':'';
                            print ">$name</option>";
                        }
                    ?>  
                
                </select>
            </div>
        

            <?php
                if($edit)print '<input type="hidden" name="id" value="'.$id.'">';
            ?>

            <br>
            <input type="submit" class="btn btn-primary" value="<?php if($edit)print 'Editar'; else print 'Insertar';?>">
        </form>      
    </body>
</html>