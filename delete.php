<?php
    include("connection.php"); 

    $primary_keys = array(
        "Users"=>"user_id",
        "Patients" => "patient_id",
        "Medical_Conditions" => "condition_id",
        "Annotations" => "annotation_id",
        "Patient_Condition" => "patient_condition_id"
    );

    $tables = array("Users", "Patients", "Medical_Conditions", "Patient_Condition", "Annotations");
    if( isset($_GET['id']) && isset($_GET['table'])){

		$id = mysqli_real_escape_string($dbconnection, $_GET['id']);
		$table = mysqli_real_escape_string($dbconnection, $_GET['table']);

        $lowerCaseTable = strtolower($table).".php";

        if(in_array($table, $tables) ){
            $query_delete = "DELETE FROM {$table} WHERE ".$primary_keys[$table]." = {$id};"; 
            // $query_delete = "delete from ".$table ." where ".$primary_keys[$table]." = ". $id.";";

            echo "query delete: {$query_delete}";
            
            if (mysqli_query($dbconnection, $query_delete)) {
                echo "DELETE SUCESSFULLY";
                header("Location: $lowerCaseTable");
            } else {
                echo "DELETE FAIL: ".mysqli_error($dbconnection);
            }  
        }
    }
    else{
        echo "ERROR ON URI PARAMETER";
    }
?>
