<?php

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
    echo "Connected.<br>";
}else{
    echo "Not connected.<br>";
}

$colsNames = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','BB','CC','DD','EE','FF','GG','HH','II','JJ','KK','LL','MM','NN','OO','PP','QQ','RR','SS','TT','UU','VV','WW','XX','YY','ZZ','AAA','BBB','CCC','DDD','EEE','FFF','GGG','HHH','III','JJJ','KKK','LLL','MMM','NNN','OOO','PPP','QQQ','RRR','SSS','TTT','UUU','VVV','WWW','XXX','YYY','ZZZ');
$fields = array();

if(isset($_POST['btnSave'])){

    $rows = clean($_POST['rows']);
    $cols = clean($_POST['cols']);
    /*
    $a1 = clean($_POST['1A']);
    $a2 = clean($_POST['1B']);
    $b1 = clean($_POST['2A']);
    $b2 = clean($_POST['2B']);
    $c1 = clean($_POST['3A']);
    $c2 = clean($_POST['3B']);

    echo $a1.":".$a2."<br>".$b1.":".$b2."<br>".$c1.":".$c2;
    */

    for( $i = 1; $i <= $rows; $i++){
        for( $j = 0; $j <= $cols-1; $j++){
 
            array_push($fields,$i.$colsNames[$j]);
            
        }
        
    }

    for( $a = 0; $a <= count($fields); $a++){
        $var = $fields[$a];
        $$fields[$a] = clean($_POST['$$var']);
        echo $$fields[$a];
    }

/*
    foreach($fields as $field){
        echo $field;echo "<br>";
    }
*/
   
    
}

?>
