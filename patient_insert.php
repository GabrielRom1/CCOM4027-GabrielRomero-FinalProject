    <?php
        include "connection.php";

        // si edit tiene algo y id tiene algo entonces es que se quiere editar ese patient
        if( isset($_GET['edit']) && isset($_GET['id']) ){   
            // echo "editar";
            $edit = $_GET['edit'];
            $id = $_GET['id'];
            $id = mysqli_real_escape_string($dbconnection, $_GET['id']);

            $query = "SELECT * FROM Patients WHERE patient_id =".$id;
            $result = mysqli_query($dbconnection,$query);
            $datos = mysqli_fetch_array($result);

            $query_conditions = "SELECT * FROM Medical_Conditions";
            $conditions = mysqli_query($dbconnection, $query_conditions);

            

            $query_patient_conditions = "SELECT condition_id FROM Patient_Condition WHERE patient_id=".$id;
            $patient_conditions = mysqli_query($dbconnection, $query_patient_conditions);

            $patient_condition_ids = array();
            while ($row = mysqli_fetch_array($patient_conditions)) {
                $patient_condition_ids[] = $row[0];
            }


            
        }elseif(isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['birth_date']) )  {

                // si se setean esas variables es un 
                $edit = false;
                // echo "post";
                
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $birth_date = $_POST['birth_date'];
                $first_name = mysqli_real_escape_string($dbconnection, $first_name);
                $last_name = mysqli_real_escape_string($dbconnection, $last_name);
                $birth_date = mysqli_real_escape_string($dbconnection, $birth_date);

                // si se setea el id es que se quiere editar
                if(isset($_POST['id']) ){
                    // echo "editar";
                    $patient_id = $_POST['id'];
                    $patient_id = mysqli_real_escape_string($dbconnection, $patient_id);

                     $delete_query = "DELETE FROM Patient_Condition WHERE patient_id = $patient_id";
                        mysqli_query($dbconnection,$delete_query);
                    if(isset($_POST['conditions'])){
   

                        $post_cond = $_POST['conditions'];
                        // echo '<script>alert(1)</script>';
                        // echo "<script>alert($post_cond[0])</script>";
                        $countCond = count($post_cond); 
                        // echo "<script>alert('countCond: $countCond')</script>";
                        $many_cond_query = "INSERT INTO Patient_Condition (patient_id, condition_id) VALUES ";
                        $VALUES = "";
                        
                        for($cond_index = 0; $cond_index < $countCond; $cond_index++){

                            $post_condition_id =  mysqli_real_escape_string($dbconnection, $post_cond[$cond_index]);
                            $VALUES = $VALUES."($patient_id,$post_condition_id)";

                            if($cond_index != $countCond-1){
                                $VALUES = $VALUES.",";
                            }
                        }
                        $VALUES = $VALUES.";";

                        $many_cond_query = $many_cond_query.$VALUES;
                        // echo "<script>alert('$many_cond_query')</script>"; 
                        mysqli_query($dbconnection,$many_cond_query);       
                    }

                    $query = "UPDATE Patients SET first_name = '{$first_name}' , last_name = '{$last_name}' , birth_date = '{$birth_date}' where patient_id = {$patient_id};";
                    
                    if (mysqli_query($dbconnection,$query)) {
                        header("Location: patients.php");
                    }	 
                }
                else{
                    // echo "crear";
                    $query = "INSERT INTO Patients (first_name, last_name, birth_date) values ('{$first_name}', '{$last_name}', '{$birth_date}');";
                    // echo $query;
                    // echo "{$query} con f string";
                    $insert_result = mysqli_query($dbconnection,$query);
                    if ($insert_result){

                        if(isset($_POST['conditions'])){
                            // $delete_query = "DELETE FROM Patient_Condition WHERE patient_id = $patient_id";
                            // mysqli_query($dbconnection,$delete_query);

                            $post_cond = $_POST['conditions'];
                            // echo '<script>alert(1)</script>';
                            // echo "<script>alert($post_cond[0])</script>";
                            $countCond = count($post_cond); 
                            // echo "<script>alert('countCond: $countCond')</script>";
                    
                            $many_cond_query = "INSERT INTO Patient_Condition (patient_id, condition_id) VALUES ";
                            $VALUES = "";
                    
                            $pa_id = mysqli_insert_id($dbconnection);
                            echo "<script>alert('patient_id: $pa_id')</script>";

                            for($cond_index = 0; $cond_index < $countCond; $cond_index++){

                                $post_condition_id =  mysqli_real_escape_string($dbconnection, $post_cond[$cond_index]);
                                $VALUES = $VALUES."($pa_id,$post_condition_id)";

                                if($cond_index != $countCond-1){
                                    $VALUES = $VALUES.",";
                                }
                            }
                            $VALUES = $VALUES.";";

                            $many_cond_query = $many_cond_query.$VALUES;
                            // echo "<script>alert('$many_cond_query')</script>"; 
                            mysqli_query($dbconnection,$many_cond_query);       
                        }
                        



                        // echo 'create succesfully';
                    	header("Location: patients.php");
                    }	
                }
            } else{
                $edit = false;
                $query_conditions = "SELECT * FROM Medical_Conditions";
                $conditions = mysqli_query($dbconnection, $query_conditions);
                // echo "crear2";
            }
        $table = 'Patients';
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

            <div class="form-group">
                
                <label for="conditions[]">Condiciones Médicas <strong>(Marque todas las que apliquen)</strong></label>

                <?php
                if($edit){
                    while ($condition = mysqli_fetch_array($conditions)) {
                    
                        $condition_id = $condition[0];
                        $condition_name = $condition[1];

                        $checked = in_array($condition_id, $patient_condition_ids) ? "checked" : "";

                        echo "<div class=' form-check'>";
                        echo "<input class='form-check-input' type='checkbox' name='conditions[]' value='$condition_id' id='cond_$condition_id' $checked>";
                        echo "<label class='form-check-label' for='cond_$condition_id'>$condition_name</label>";
                        echo "</div>";
                    }
                }else{
                    while ($condition = mysqli_fetch_array($conditions)) {
                        $condition_id = $condition[0];
                        $condition_name = $condition[1];

                        echo "<div class='form-check'>";
                        echo "<input class='form-check-input' type='checkbox' name='conditions[]' value='$condition_id' id='cond_$condition_id'>";
                        echo "<label class='form-check-label' for='cond_$condition_id'>$condition_name</label>";
                        echo "</div>";
                    }

                }
        
                ?>
        







                <?php
                    if($edit)print '<input type="hidden" name="id" value="'.$id.'">';
                ?>




                <br>
                <input type="submit" class="btn btn-primary" value="<?php if($edit)print 'Editar'; else print 'Insertar';?>">
            </form>      
        </body>
    </html>