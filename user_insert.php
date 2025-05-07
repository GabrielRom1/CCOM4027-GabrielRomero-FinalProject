<?php
    include "connection.php";

    if( isset($_GET['edit']) && isset($_GET['id']) ){

        
        $edit = $_GET['edit'];
        $id = $_GET['id'];

        $query = "SELECT * FROM Users WHERE user_id =".$id;
        // echo $query;
        
        $result = mysqli_query($dbconnection,$query);
        $datos = mysqli_fetch_array($result);
    }
    else if(isset($_POST['first_name'])
            && isset($_POST['last_name'])
            && isset($_POST['birth_date']))
            
    {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $birth_date = $_POST['birth_date'];

        if(isset($_POST['id']) ){
            $user_id = isset($_POST['id'])
            $query = "UPDATE Users
                SET first_name=".$first_name. ", 
                    last_name=".$last_name. ", 
                    birth_date=". $birth_date. 
                "WHERE user_id="$user_id.";"
        }
        else{
            $query = "INSERT INTO Users (first_name, last_name, birth_date, role)"
        }

        
    }
    else{
        echo 'no query params';
    }

    $table = 'Users';
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

        <form action="user_insert.php" method="post">
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
                <label for="role">Role</label>
                <select>
                    <option value="employee">Employee</option>
                    <option value="tutor">Tutor</option>

                </select>
                <input type="" class="form-control" name="role" id="role" value="<?php if($edit)print $datos['role'];?>" required>
            </div>

            <?php
                if($edit)print '<input type="hidden" name="id" value='.$id.'>';
            ?>

            <br>
            <input type="submit" class="btn btn-primary" value="<?php if($edit)print 'Editar'; else print 'Insertar';?>">
        </form>      
    </body>
</html>