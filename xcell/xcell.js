/*

    Pure JS ;)
    
*/
function make(todo){

    var table = document.getElementById('mainTable');
    //head
    var headers = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','BB','CC','DD','EE','FF','GG','HH','II','JJ','KK','LL','MM','NN','OO','PP','QQ','RR','SS','TT','UU','VV','WW','XX','YY','ZZ','AAA','BBB','CCC','DDD','EEE','FFF','GGG','HHH','III','JJJ','KKK','LLL','MMM','NNN','OOO','PPP','QQQ','RRR','SSS','TTT','UUU','VVV','WWW','XXX','YYY','ZZZ'];
    var headCount = document.querySelectorAll('th').length;
    var lastHead = document.querySelectorAll('th')[headCount-1];
    var lastHeadId = lastHead.id.substring(2,8);
    //rows
    var rowCount = document.querySelectorAll('tr').length; //pahalang na row count
    var lastRow = document.querySelectorAll('tr')[rowCount-1];
    var lastRowId = lastRow.id.substring(2,8);
    //columns
    var colCount = lastRow.querySelectorAll('td').length; //pahalang na column count
    var firstCol = lastRow.querySelectorAll('td')[0].innerHTML;
    var lastCol = lastRow.querySelectorAll('td')[colCount-1];
    var lastColId = lastCol.id.substring(10,13);  //kuha nung last 2 number sa id
    
    
    if( todo === "addRow"){
        //alert('addRow');
        var row = document.getElementsByTagName('tr');
        var rowNum = parseInt(firstCol);  //innerHTML ng first <td>
        var rowId = parseInt(lastRowId); //id ng first <tr>
        
        //dagdag row
        var lastInsertedRow = table.insertRow(rowCount);
        lastInsertedRow.id = "tr"+(rowId+1);
        lastInsertedRow.innerHTML = "<td id="+ (rowNum+1) +">"+ (rowNum+1) +"</td>";
        
        //dagdag cells
        for(var i = 1; i<=colCount-1; i++){
            var x = row[rowCount].insertCell(i);
            x.id = rowCount+headers[i-1];
            //x.innerHTML = "<input type=\"text\" name=\""+ rowCount+headers[i-1] +"\" value=\"new cell\">";
            //x.innerHTML = "<form method='post'><input type='hidden' name='coordinates' value='"+ rowCount +","+ i +"'><input type='text' name='field' id='field_"+ rowCount +","+ i +"' onchange='if(this.value != \"\") { this.form.submit(); }' value=''></form>";
            x.innerHTML = "<input type=\"text\" name=\"field\" id=\"field_"+ rowCount +","+ i +"\" onchange=\"sendData('"+ rowCount +","+ i +"',this.value);\">";
        }
 
            //make('update');
        
        
    }else if( todo === "deleteRow"){
        //alert('deleteRow');
        if(rowCount == 2){
            alert('cannot erase last row'); //bawal magdelete pag isang row nalang :P
        }else{
            deleteRowOrColumnData('row',rowCount-1); //delete ng lahat ng values na nasa roww
            //alert(rowCount-1);

            table.deleteRow(-1);
            //make('update');
        }
   
    }else if( todo === "addCol"){
        //alert('addCol'); 
        if( headCount == 79){
            alert('maximum columns reached');
        }else{
            var row = document.getElementsByTagName('tr');
            //var headNum = parseInt(lastHeadId);  //innerHTML ng last <th>
            
            //para sa <thead> to
            var tr = table.tHead.children[0];
            var th = document.createElement('th');
                th.innerHTML = headers[colCount-1];
                th.id = (headers[colCount-1]);
                tr.appendChild(th);

            for(var i = 1; i<=rowCount-1; i++){
                var x = row[i].insertCell(colCount);
                x.id = i+headers[colCount-1];
                //x.innerHTML = "<input type=\"text\" name=\""+ i+headers[colCount-1] +"\" value=\"new cell\">";
                //x.innerHTML = "<form method='post'><input type='hidden' name='coordinates' value='"+ i +","+ colCount +"'><input type='text' name='field' id='field_"+ i +","+ colCount +"' onchange='if(this.value != \"\") { this.form.submit(); }' value=''></form>";
                x.innerHTML = "<input type=\"text\" name=\"field\" id=\"field_"+ i +","+ colCount +"\" onchange=\"sendData('"+ i +","+ colCount +"',this.value);\">";
            }
            
            //make('update');
        }

    }else if( todo === "deleteCol"){
        //alert('deleteCol');
        var row = document.getElementsByTagName('tr');
        if(colCount == 2){
            alert('cannot delete last column');
        }else{
        
            deleteRowOrColumnData('column',colCount-1);
            
            var tr = table.tHead.children[0];
            var th = document.getElementsByTagName('th')[colCount-1];
                tr.removeChild(th);
                
            for(var i = 1; i<=rowCount-1; i++){
                var x = row[i].deleteCell(-1);
            }
            //make('update');
        }
    }else{

    }
}
function loadTable(rows,columns){

    //alert(rows+columns);
    //load rows
    
    while((rows-1) != 0){
        make('addRow'); 
        rows--;
    }
    
    //load columns
    while((columns-2) != 0){
        make('addCol'); 
        columns--;
    }
    
}

//AJAX
function sendData(XY,val) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("response").innerHTML = this.responseText;
        }
    };
    xhr.open("POST", "server.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("coordinates="+XY+"&field="+val);
}
function deleteRowOrColumnData(type,num){
    //alert(num);
    if(type === 'row'){
    
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("response").innerHTML = this.responseText;
            }
        };
        xhr.open("POST", "server.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("currentRows="+num);
        
    }else if(type === 'column'){
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("response").innerHTML = this.responseText;
            }
        };
        xhr.open("POST", "server.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("currentCols="+num);
    
    }else{
        alert('error!');
    }

}









