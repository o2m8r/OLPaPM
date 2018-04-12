<?php require_once('server.php');?>
<html>
    <head>
    
        <title>XCELL</title>

	    <link rel="stylesheet" href="style.css" type="text/css">
	    <script src="xcell.js"></script>
	    
    </head>
    
<body onload="loadTable(<?php $results = mysqli_query($dbconnect,'SELECT MAX(xcell_tbl.RowCount) AS rows,MAX(xcell_tbl.ColCount) AS cols FROM xcell_tbl INNER JOIN users_tbl ON xcell_tbl.UserID = users_tbl.UserID INNER JOIN xcell_data_tbl ON xcell_tbl.XCellDataID = xcell_data_tbl.XCellDataID WHERE users_tbl.UserID = \'1\';');    while($row = $results->fetch_assoc()){ echo $row['rows'].','.$row['cols'];}?>);">


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
        <form method="post">
            <input type="hidden" name="coordinates" value="1,1">
            <input type="text" name="field" onfocusout="if(this.value != '') { this.form.submit(); }">
        </form>
    </td>
    <td id="1B">
        <form method="post">
            <input type="hidden" name="coordinates" value="1,2">
            <input type="text" name="field" onfocusout="if(this.value != '') { this.form.submit(); }">
        </form>
    </td>
  </tr>

 </tbody>
</table>



<br>

</body>
</html>



