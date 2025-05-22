<?php
    include "connection.php";

    // si edit tiene algo y id tiene algo entonces es que se quiere editar ese user
    if( isset($_GET['edit']) && isset($_GET['id']) ){   
        // echo "editar";
        $edit = $_GET['edit'];
        $id = $_GET['id'];

        $id = mysqli_real_escape_string($dbconnection, $_GET['id']);

        $query = "SELECT * FROM Medical_Conditions WHERE condition_id =".$id;
        
        $result = mysqli_query($dbconnection,$query);
        $datos = mysqli_fetch_array($result);
    }elseif(isset($_POST['condition_name']) )  {
            // si se setean esas variables es un post
            $edit = false;
            
            // echo "post";
            
            $condition_name = $_POST['condition_name'];            
            $condition_name = mysqli_real_escape_string($dbconnection, $condition_name);

            // si se setea el id es que se quiere editar
            if(isset($_POST['id']) ){
                // echo "editar";
                // echo $condition_name;
                $condition_id = $_POST['id'];

                $condition_id = mysqli_real_escape_string($dbconnection, $condition_id);

                // $query = "UPDATE Medical_Conditions SET first_name = '{$first_name}';";
                $query = "UPDATE Medical_Conditions SET name = '{$condition_name}' WHERE condition_id = {$condition_id};";

                // $query = "UPDATE Medical_Conditions SET first_name = '".$first_name."' , last_name = '".$last_name. "' , birth_date = '".$birth_date ."' where user_id=1;";
                // echo $query;

                if (mysqli_query($dbconnection,$query)) 
                {
                //     $query_delete_emp = "delete from emp where eid=$id_emp";
                //     mysqli_query($dbconnection,$query_delete_emp);
                    
                //     header("Location: demo_struc.php");
                    // echo 'update succesfully';
            		header("Location: medical_conditions.php");
                }	 
            }
            else{
                // echo "crear";
                $query = "INSERT INTO Medical_Conditions (name) VALUES ('{$condition_name}');";
                // echo $query;
                // echo "{$query} con f string";
                if (mysqli_query($dbconnection,$query)){
                    // echo 'create succesfully';
            		header("Location: medical_conditions.php");
                }	
            }
        } else{
            $edit = false;

            // echo "crear2";
        }
    $table = 'Medical_Conditions';
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
                echo "<h1 align=center>Medical Conditions</h1>";
            ?>
        </h2>

        <form action="medical_condition_insert.php" method="post">
            <div class="form-group">
                <label for="first_name">Nombre</label>
                <input type="text" class="form-control" name="condition_name" id="condition_name" placeholder="Entre el nombre" value="<?php if($edit)print $datos['name'];?>" required>
            </div>

            <?php
                if($edit)print '<input type="hidden" name="id" value="'.$id.'">';
            ?>

            <br>
            <input type="submit" class="btn btn-primary" value="<?php if($edit)print 'Editar'; else print 'Insertar';?>">
        </form>      
    </body>
</html>