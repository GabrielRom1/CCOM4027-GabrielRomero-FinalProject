<?php
    // include "header.html";
    // include "scriptsBase.html";
    // include "navbar.html";

    include "connection.php";

    $tables = array("Users", "Patients", "Medical_Conditions", "Patient_Condition", "Annotations");

    $lowerCaseTable = strtolower($table);

    $lowerCaseTable = substr($lowerCaseTable, 0, strlen($lowerCaseTable)-1);

    $table_columns = array(
        "Users" => array("First Name", "Last Name", "Birth Date", "Role"),
        "Patients" => array("First Name", "Last Name", "Birth Date"),
        "Medical_Conditions" => array("Name"),
        "Annotations" => array("Patient","Created at", "Created by", "Description", "Urgency level"),
        "Patient_Condition" => array("Patient", "Condition")
    );
    
    $table_attributes = array(
        "Users" => array("first_name", "last_name", "birth_date", "role"),
        "Patients" => array("first_name", "last_name", "birth_date"),
        "Medical_Conditions" => array("name"),
        "Annotations" => array("patient_id","created_at", "user_id", "description", "urgency_level"),
        "Patient_Condition" => array("patient_id", "condition_id")

    );

    $query="SELECT * FROM ".$table;

    // echo "query:";
    // echo $query;

    if($table == "Annotations"){
        $query = "SELECT Annotations.annotation_id ,Patients.first_name, created_at, Users.first_name, Patients.patient_id, Users.user_id,  Annotations.description, Annotations.urgency_level FROM $table JOIN Users JOIN Patients 
        WHERE Annotations.user_id = Users.user_id AND Annotations.patient_id = Patients.patient_id";
    }
    else if($table == "Patient_Condition"){
        $query = "SELECT patient_condition_id ,patient_id, first_name, condition_id, Medical_Conditions.name FROM $table NATURAL JOIN Patients NATURAL JOIN Medical_Conditions";
    }

    $result = mysqli_query($dbconnection,$query);

    if($lowerCaseTable == "patient_conditio"){
        $lowerCaseTable = "patient_condition";
    }
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
                if($table == "Medical_Conditions"){
                    echo "<h1 align=center > Medical Conditions </h1>";
                } else if($table == "Patient_Condition"){
                    echo "<h1 align=center >Patient Conditions</h1>";
                }else{
                    echo "<h1 align=center >$table</h1>" ;
                }
            ?>
        </h2>

        <p><a href="<?php echo trim($lowerCaseTable).'_insert.php'?>" class="btn btn-primary btn-sm" role="button" aria-pressed="true">Insert</a></p>
        
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


                    if($table == "Annotations"){
                        // el query devuelve esto:

                        //$k=0 => annotation_id
                        //$k=1 => patient.first_name
                        //$k=2 => created at
                        //$k=3 => user.first_name
                        //$k=4 => patient_id
                        //$k=5 => user_id
                        //$k=6 => description
                        //$k=7 => urgency_level 

                        // for($k=0;$k<count($row); $k++){
                        //     echo $row[$k];
                        //     echo '<br>';
                        // }
                        // echo $row['user_id'];
                        // echo $row['patient_id'];
                        // // echo $row['first_name']; /DA EL FIRSTNAME DEL USER
                        for($i = 1; $i <= count($table_attributes[$table]); $i++ ){
                            print "<td>";
                            if( $i == 1){
                                $key = 'patient_id';
                                print "<a href='patient_insert.php?edit=1&id=$row[$key]'>$row[$i]</a>";

                            }else if($i == 3){
                                $key = 'user_id';
                                print "<a href='user_insert.php?edit=1&id=$row[$key]'>$row[$i]</a>";

                            }else if($i == 4){
                                print $row[6];
                            }
                            else if($i == 5){
                                print($row[7]);
                            }
                            else{
                                print $row[$i];
                            }
                            print "</td>";
                        }
                    
                        print "<td align=center>";
                        
                        print '
                            <a href="'.$lowerCaseTable.'_insert.php?edit=1&id='.$row[0] .'"class="btn btn-primary btn-sm" role="button" aria-pressed="true">Edit</a>
                            <a href="#" onclick="confirmDelete('.$primary_key.', \''.$table.'\'); return false;" class="btn btn-danger btn-sm" role="button" aria-pressed="true">Delete</a>';
                        print "</td></tr>";		
                        // print "</tr>";	
                    }
                    else if($table == "Patient_Condition"){

                        // el query devuelve:
                        // $l=0 => patient_condition_id
                        // $l=1 => patient_id
                        // $l=2 => patient first name
                        // $l=3 => condition_id
                        // $l=4 => condition name

                        print "<td> <a href='patient_insert.php?edit=1&id=$row[1]'>$row[2]</a> </td>";
                        print "<td> <a href='medical_condition_insert.php?edit=1&id=$row[3]'>$row[4]</a> </td>";

                        print "<td align=center>";
                        print '
                            <a href="'.$lowerCaseTable.'_insert.php?edit=1&id='.$row[0] .'"class="btn btn-primary btn-sm" role="button" aria-pressed="true">Edit</a>
                            <a href="#" onclick="confirmDelete('.$primary_key.', \''.$table.'\'); return false;" class="btn btn-danger btn-sm" role="button" aria-pressed="true">Delete</a>';
                        print "</td></tr>";	

                    }
                    else{
                        
                    // echo "primary key: ";
                    // echo $primary_key;  
                    // echo "row:";
                    // echo $row;
                    print "<tr>";
                    for($i = 1; $i <= count($table_attributes[$table]); $i++ ){
                        print "<td>";
                        print $row[$i];
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
                    print '
                        <a href="'.$lowerCaseTable.'_insert.php?edit=1&id='.$row[0] .'"class="btn btn-primary btn-sm" role="button" aria-pressed="true">Edit</a>
                        <a href="#" onclick="confirmDelete('.$primary_key.', \''.$table.'\'); return false;" class="btn btn-danger btn-sm" role="button" aria-pressed="true">Delete</a>
                    ';
                    print "</td></tr>";		
                    }
	
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
                        window.location.href = "<?php echo $url?>" + 'delete.php?id=' + primary_key + '&table=' + table;
                    } else {
                        // User clicked 'Cancel', do nothing
                        alert('Deletion cancelled.');
                    }
                }
            </script>
        </div>
    </body>
</html>
<?php
    mysqli_close($dbconnection);
?>
