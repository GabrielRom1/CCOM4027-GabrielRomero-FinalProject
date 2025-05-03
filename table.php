<?php

    // include "header.html";
    // include "scriptsBase.html";

    // include "navbar.html";

    include "connection.php";

    $tables = array("Users", "Patients", "Medical_Conditions", "Patient_Condition", "Annotations");
    if( isset($_GET['table'])){
        if (in_array($_GET['table'], $tables)) {
            $table = $_GET['table']; 
        }
        else{
            echo "ERROR ON URI PARAMETER";
        }
    }
    else{
        echo "ERROR ON URI PARAMETER";
    }

    // $edita = mysqli_real_escape_string($dbconnection, $_GET['table']);
    // $id_emp = mysqli_real_escape_string($dbconnection, $_GET['eid']);
    // $id_dept = mysqli_real_escape_string($dbconnection, $_GET['did']);

    $query="SELECT * FROM ".$table;

    // echo $query;

    $result = mysqli_query($dbconnection,$query);
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
            Lista de Users
        </h2>
        <table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
            <thead class="thead-light">
            <tr>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Birth Date</th>
                <th scope="col">Role</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>

            <?php
                while($row = mysqli_fetch_array($result))
                {
                    $primary_key = $row[0];
                    // echo "primary key: ";
                    // echo $primary_key;  
                    $confirm_statement = $primary_key.','.$table;
                    echo $confirm_statement;

                    print "<tr><td>";
                    print $row['first_name'];
                    print "</td><td>";
                    print $row['last_name'];
                    print "</td><td>";
                    print $row['birth_date'];
                    print "</td><td>";
                    print $row['role'];
                    print "</td>";
                
                    print "<td>";

                    // print '
                    // <a href="demo_insert.php?edita=1&eid='.$row['eid'].'&did='.$row['did'].'" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Edita</a>
                    // <a href="#" onclick="confirmDelete('.$row['eid'].', '.$row['did'].'); return false;" class="btn btn-danger btn-sm" role="button" aria-pressed="true">Borra</a>
                    // ';
                    
                    print '
                        <a href="#" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Edita</a>
                        <a href="#" onclick="confirmDelete('.$primary_key.', \''.$table.'\'); return false;" class="btn btn-danger btn-sm" role="button" aria-pressed="true">Borra</a>
                    ';
                    print "</td></tr>";		
                    // print "</tr>";	
                }
            ?>
            </tbody>

        </table>

        <?php
            include "scriptsBase.html";
        ?>  

        <script>
            $(document).ready(function () {
                $('#dtBasicExample').DataTable();
            });
        </script>
        <script>
            
            function confirmDelete(primary_key, table ) {
                alert(primary_key);
                alert(table);

                // Confirmation dialog
                // if (confirm('Si no tienes duda de que quieres borrar oprime OK. Si tienes duda oprime Cancel.')) {
                //     // User clicked 'OK', proceed with the deletion
                //     window.location.href = 'https://ada.uprrp.edu/~carlos.corrada2/demo/procesa_delete.php?eid=' + eid + '&did=' + did;
                // } else {
                //     // User clicked 'Cancel', do nothing
                //     alert('Deletion cancelled.');
                // }
            }
        </script>
    </body>
</html>
<?php
    mysqli_close($dbconnection);
?>
