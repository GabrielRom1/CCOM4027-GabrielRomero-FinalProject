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

        if(in_array($table, $tables) ){
            $query_delete = "delete from ".$table ." where ".$primary_keys[$table]."=". $id.";";

            echo $query_delete;
            // mysqli_query($dbconnection,$query_delete_works);
            //esto lo brega el ondelete cascade
            // 	print($query_insert);
            // 	print "Edita $edita";
            // 	exit();

            // ONDELETE CASCADE!!!!!!
                if (mysqli_query($dbconnection,$query_delete)) 
                {
                //     $query_delete_emp = "delete from emp where eid=$id_emp";
                //     mysqli_query($dbconnection,$query_delete_emp);
                    
                //     header("Location: demo_struc.php");
                    echo 'delete succesfully';
            		header("Location: table.php?table=".$table);

                }	 
                // else 
                // {
                //     $error=mysqli_error($dbconnection);
                //     mysqli_close($dbconnection);
                //     header("Location: demo_struct.php?error=$error");
                // }
        }
    }
    else{
        echo "ERROR ON URI PARAMETER";
    }


?>
