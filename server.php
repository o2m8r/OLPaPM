<?php
session_start();
error_reporting(0);

function clean($data) {
    $data = trim($data);
    $data = stripslashes($data); 
    $data = htmlspecialchars($data);
    $data = str_replace(array("'"), "&#39;", $data  );
    $data = str_replace(array("\""), "&#34;", $data  );
    return $data;
}

define('HOSTNAME','localhost');
define('USERNAME','root');
define('DB_PASS','');
define('DB_NAME','xcell');

$dbconnect = mysqli_connect( HOSTNAME, USERNAME, DB_PASS, DB_NAME );
if($dbconnect){
    echo "<center>Connected.</center><br>";
}else{
    echo "<center>Not connected.</center><br>";
}
$msg1=$msg2 = "";
#sample
$_SESSION['userID'] = '1';
$id = $_SESSION['userID'];

if(isset($_POST['field'])){
    
    #$rows = clean($_POST['rows']);
    #$cols = clean($_POST['cols']);
    $fieldValue = clean($_POST['field']);
    list($XCoordinates,$YCoordinates) = explode(',',clean($_POST['coordinates']));
    
    #for debugging
    echo 'Last data inserted:<br>Value: '.$fieldValue.'<br>X: '.$XCoordinates.'<br>Y: '.$YCoordinates.'<br>';
    
    $results = mysqli_query($dbconnect,"SELECT xcell_data_tbl.*, xcell_tbl.* FROM xcell_data_tbl INNER JOIN xcell_tbl ON xcell_data_tbl.XCellID = xcell_tbl.XCellID WHERE xcell_data_tbl.Xrows = '$XCoordinates' AND xcell_data_tbl.Ycolumns = '$YCoordinates';");
    
    if (mysqli_num_rows($results) == 1) {
        
        $query = "UPDATE xcell_data_tbl SET FieldValue = '$fieldValue' WHERE Xrows = '$XCoordinates' AND Ycolumns = '$YCoordinates';";
        if(!mysqli_query($dbconnect,$query)){
            echo "<script>alert('error in updating')</script>";
        }else{
            echo "<script>alert('updated successfully')</script>";
        }
    
    }else{
    $query = "INSERT INTO xcell_data_tbl(Xrows, Ycolumns, FieldValue) VALUES('$XCoordinates','$YCoordinates','$fieldValue');";
        if(!mysqli_query($dbconnect,$query)){
        
            $msg1 = "Error in inserting on xcell_data_tbl";
            
        }else{
            $last_id = $dbconnect->insert_id;
            $msg1 = "Success in inserting on xcell_data_tbl!";
            if(!mysqli_query($dbconnect,"INSERT INTO xcell_tbl(UserID, XCellDataID) VALUES('$id','$last_id');")){
                $msg2 = "Error in inserting data on xcell_tbl!";
            }else{
                $last_id2 = $dbconnect->insert_id;
                mysqli_query($dbconnect,"UPDATE xcell_data_tbl SET XCellID = '$last_id2' WHERE XCellDataID = '$last_id';");
                mysqli_query($dbconnect,"UPDATE xcell_tbl SET RowCount = (SELECT MAX(Xrows) FROM xcell_data_tbl WHERE XCellDataID = '$last_id'), ColCount = (SELECT MAX(Ycolumns) FROM xcell_data_tbl WHERE XCellDataID = '$last_id') WHERE XCellDataID = '$last_id';");
                $msg2 = "Success in inserting data on xcell_tbl!";
                echo "<script>alert('".$msg1." and ".$msg2."')</script>";
            }
        }
    }
    
}












?>
