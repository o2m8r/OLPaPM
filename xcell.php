<?php require_once('server.php');?>
<html>
    <head>
    
        <title>XCELL</title>

	    <link rel="stylesheet" href="style.css" type="text/css">
	    <script src="xcell.js"></script>

    </head>
    
<body onload="loadTable(<?php $results = mysqli_query($dbconnect,'SELECT MAX(xcell_tbl.RowCount) AS rows,MAX(xcell_tbl.ColCount) AS cols FROM xcell_tbl INNER JOIN users_tbl ON xcell_tbl.UserID = users_tbl.UserID INNER JOIN xcell_data_tbl ON xcell_tbl.XCellDataID = xcell_data_tbl.XCellDataID WHERE users_tbl.UserID = \'1\';');    while($row = $results->fetch_assoc()){ echo $row['rows'].','.$row['cols'];}?>);loadData();">
<center><h3><b>NOTE:</b> Mawawala yung mga row or column na walang laman yung mga field pag nagrefresh. ;)</h3></center>
<p id="response"></p><br>


<input type="button" onclick="make('addRow');" value="+ row">
<input type="button" onclick="make('deleteRow');" value="- row">
<input type="button" onclick="make('addCol');" value="+ col">
<input type="button" onclick="make('deleteCol');" value="- col">


<table id="mainTable">
 <thead>
  <tr>
    <th id="thtd00"></th>
    <th id="A">A</th>
    <th id="B">B</th>
  </tr>
 </thead>
 <tbody>
 
 
  <tr id="tr1">
    <td id="1">1</td>
    <td id="1A">
            <input type="text" name="field" id="field_1,1" onchange="sendData('1,1',this.value);">
    </td>
    <td id="1B">
            <input type="text" name="field" id="field_1,2" onchange="sendData('1,2',this.value);">
    </td>
  </tr>

 </tbody>
</table>

<script>
function loadData(){
    <?php
    
        $results = mysqli_query($dbconnect,'SELECT xcell_data_tbl.Xrows AS row, xcell_data_tbl.Ycolumns AS col, xcell_data_tbl.FieldValue AS val FROM xcell_tbl INNER JOIN users_tbl ON xcell_tbl.UserID = users_tbl.UserID INNER JOIN xcell_data_tbl ON xcell_tbl.XCellDataID = xcell_data_tbl.XCellDataID WHERE users_tbl.UserID = \'1\';');
        while($rows = $results->fetch_assoc()){ 
            echo "document.getElementById('field_".$rows['row'].','.$rows['col']."').value = '".$rows['val']."';";
        }
        
    ?>
}
</script>

</body>
</html>





