<?php
    include "connection.php";

    // si edit tiene algo y id tiene algo entonces es que se quiere editar ese user
    if( isset($_GET['edit']) && isset($_GET['id']) ){   
        // echo "editar";
        $edit = $_GET['edit'];
        $id = $_GET['id'];

        $id = mysqli_real_escape_string($dbconnection, $_GET['id']);

        $query = "SELECT * FROM Annotations WHERE annotation_id =".$id;
        
        $result = mysqli_query($dbconnection,$query);
        $datos = mysqli_fetch_array($result);
    }elseif(isset($_POST['description'])
            && isset($_POST['urgency_level'])
            && isset($_POST['created_at']) 
            && isset($_POST['patient_id'])
            && isset($_POST['user_id']) )  {
            // si se setean esas variables es un post
            $edit = false;
            
            // echo "post";
            
            $description = $_POST['description'];  
            $urgency_level = $_POST['urgency_level'];            
            $created_at = $_POST['created_at'];            
            $patient_id = $_POST['patient_id'];            
            $user_id = $_POST['user_id'];            

            $description = mysqli_real_escape_string($dbconnection, $description);
            $urgency_level = mysqli_real_escape_string($dbconnection, $urgency_level);
            $created_at = mysqli_real_escape_string($dbconnection, $created_at);
            $patient_id = mysqli_real_escape_string($dbconnection, $patient_id);
            $user_id = mysqli_real_escape_string($dbconnection, $user_id);

            // si se setea el id es que se quiere editar
            if(isset($_POST['id']) ){
                // echo "editar";
                // echo $condition_name;
                $annotation_id = $_POST['id'];
                $annotation_id = mysqli_real_escape_string($dbconnection, $annotation_id);

                // $query = "UPDATE Medical_Conditions SET first_name = '{$first_name}';";
                $query = "UPDATE Annotations
                        SET patient_id = '{$patient_id}',
                        user_id = '{$user_id}',
                        created_at = '{$created_at}',
                        description = '{$description}',
                        urgency_level = '{$urgency_level}'
                        WHERE annotation_id = {$annotation_id};";

                // $query = "UPDATE Medical_Conditions SET first_name = '".$first_name."' , last_name = '".$last_name. "' , birth_date = '".$birth_date ."' where user_id=1;";
                // echo $query;

                if (mysqli_query($dbconnection,$query)) 
                {
                //     $query_delete_emp = "delete from emp where eid=$id_emp";
                //     mysqli_query($dbconnection,$query_delete_emp);
                    
                //     header("Location: demo_struc.php");
                    // echo 'update succesfully';
            		header("Location: annotations.php");
                }	 
            }
            else{
                // echo "crear";
                $query = "INSERT INTO Annotations (patient_id, user_id, created_at, description, urgency_level)
                VALUES ({$patient_id}, {$user_id}, '{$created_at}', '{$description}', '{$urgency_level}');";
                // echo $query;
                // echo "{$query} con f string";
                if (mysqli_query($dbconnection,$query)){
                    echo 'create succesfully';
            		header("Location: annotations.php");
                }	
            }
        } else{
            $edit = false;

            // echo "crear2";
        }
    $table = 'Annotations';
    $query_patients = "SELECT * FROM Patients";
    $patients = mysqli_query($dbconnection, $query_patients);

    $query_users = "SELECT * FROM Users";
    $users = mysqli_query($dbconnection, $query_users);

    $levels = array(
        "high" => 3,
        "medium" => 2,
        "low" => 1
    );
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

        <form action="annotation_insert.php" method="post">

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
                <label for="role">User</label>
                <select class="form-control" name="user_id" id="user_id" >">
                    <?php
                        while($user= mysqli_fetch_array($users))
                        {
                            $u_id = $user['user_id'];
                            $first_name = $user['first_name'];
                            print "<option value='$u_id' ";
                            if($edit) echo $datos["user_id"] == $u_id? 'selected':'';
                            print ">$first_name</option>";
                        }
                    ?>   
                </select>
            </div>
        
            <div class="form-group">
                <label for="created_at">Created at</label>
                <input type="date" class="form-control" name="created_at" id="created_at" placeholder="Entre el nombre" value="<?php if($edit)print $datos['created_at'];?>" required>
            </div>

            <div class="form-group">
                <label for="description">description</label>
                <input type="text" class="form-control" name="description" id="description" placeholder="Entre el nombre" value="<?php if($edit)print $datos['description'];?>" required>
            </div>

            <div class="form-group">
                <label for="urgency_level">Role</label>
                <select class="form-control" name="urgency_level" id="urgency_level">
                

                    <option value="1" <?php if($edit) echo $datos['urgency_level'] == 'low' ? 'selected' : '' ?>>Low</option>
                    <option value="2" <?php if($edit) echo $datos['urgency_level'] == 'medium' ? 'selected' : '' ?>>Medium</option>
                    <option value="3" <?php if($edit) echo $datos['urgency_level'] == 'high' ? 'selected' : '' ?>>High</option>
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