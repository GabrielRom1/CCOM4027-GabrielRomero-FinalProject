<?php
    // include "header.html";
    // include "scriptsBase.html";
    // include "navbar.html";

    include "connection.php";

    $tables = array("Users", "Patients", "Medical_Conditions", "Patient_Condition", "Annotations");

    $table_columns = array(
        "Users" => array("First Name", "Last Name", "Birth Date", "Role"),
        "Patients" => array("First Name", "Last Name", "Birth Date"),
        "Medical_Conditions" => array("Name"),
        "Annotations" => array("Patient","Created at", "Created by", "Description", "Urgency level")
    );
    
    $table_attributes = array(
        "Users" => array("first_name", "last_name", "birth_date", "role"),
        "Patients" => array("first_name", "last_name", "birth_date"),
        "Medical_Conditions" => array("name"),
        "Annotations" => array("patient_id","created_at", "user_id", "description", "urgency_level")
    );

    // if( isset($_GET['table'])){
    //     if (in_array($_GET['table'], $tables)) {
    //         $table = $_GET['table']; 
    //     }
    //     else{
    //         echo "ERROR ON URI PARAMETER";
    //     }
    // }
    // else{
    //     echo "ERROR ON URI PARAMETER";
    // }

    // $edita = mysqli_real_escape_string($dbconnection, $_GET['table']);
    // $id_emp = mysqli_real_escape_string($dbconnection, $_GET['eid']);
    // $id_dept = mysqli_real_escape_string($dbconnection, $_GET['did']);

    $query="SELECT * FROM ".$table;

    echo "query:";
    echo $query;

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
                <?php
                $headers = $table_columns[$table];
                foreach($headers as $header){
                    echo '<th scope="col">'.$header.'</th>';
                }
                ?>
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
                    // echo "row:";
                    // echo $row;
                    print "<tr>";
                    for($i = 0; $i < count($table_attributes[$table]); $i++ ){
                        print "<td>";
                        print $row[$i+1];
                        print "</td>";
                    }

                    // print "<tr><td>";
                    // print $row['first_name'];
                    // print "</td><td>";
                    // print $row['last_name'];
                    // print "</td><td>";
                    // print $row['birth_date'];
                    // print "</td><td>";
                    // print $row['role'];
                    // print "</td>";
                
                    print "<td align=center>";

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
                 if (confirm('Si no tienes duda de que quieres borrar oprime OK. Si tienes duda oprime Cancel.')) {
                    // User clicked 'OK', proceed with the deletion
                    window.location.href = 'https://ada.uprrp.edu/~gabriel.romero5/PROYECTO/delete.php?id=' + primary_key + '&table=' + table;
                } else {
                    // User clicked 'Cancel', do nothing
                    alert('Deletion cancelled.');
                }
            }
        </script>
    </body>
</html>
<?php
    mysqli_close($dbconnection);
?>
