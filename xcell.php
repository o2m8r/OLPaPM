<?php require_once('server.php');?>
<html>
    <head>
    
        <title>XCELL</title>

	    <link rel="stylesheet" href="style.css" type="text/css">
	    <script src="xcell.js"></script>
	    
    </head>
<body onload="make('update');">

<form method="post">

<input type="button" onclick="make('addRow');" value="+ row">
<input type="button" onclick="make('deleteRow');" value="- row">
<input type="button" onclick="make('addCol');" value="+ col">
<input type="button" onclick="make('deleteCol');" value="- col">
<input type="submit" name="btnSave" value="SAVE">

<input type="hidden" id="rows" name="rows" value="">
<input type="hidden" id="cols" name="cols" value="">

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
    <td id="1A"><input type="text" name="1A"></td>
    <td id="1B"><input type="text" name="1B"></td>
  </tr>
  <tr id="tr2">
    <td id="2">2</td>
    <td id="2A"><input type="text" name="2A"></td>
    <td id="2B"><input type="text" name="2B"></td>
  </tr>
  <tr id="tr3">
    <td id="3">3</td>
    <td id="3A"><input type="text" name="3A"></td>
    <td id="3B"><input type="text" name="3B"></td>
  </tr>
 </tbody>
</table>

</form>

<br>

</body>
</html>



