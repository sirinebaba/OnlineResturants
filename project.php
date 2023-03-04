<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cafetria System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script src="https://code.jquery.com/jquery-1.12.3.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.3.js"></script>

  <script src="Restaurents.js" type="text/javascript"></script>

  

</head>
<body class="b">
<div id="dumpdiv">
</div>

  <!--
<div class="container">
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" href="#collapse1">Search Panel</a>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse">
       <div class="form-group">
<div>
 <form class="form-inline">
    <div class="form-group">
      <label for="focusedInput">&nbsp;&nbsp;Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
      <input class="form-control" id="focusedInput" type="text" placeholder = "Search By Food Name">
    </div>
<div class="form-group">
      <label for="focusedInput">&nbsp;&nbsp;Category: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
      <input class="form-control" id="focusedInput" type="text" placeholder = "Search By Food Category">
    </div>
<div class="form-group">
      <label for="focusedInput">&nbsp;&nbsp;Price: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
      <input class="form-control" id="focusedInput" type="text" placeholder = "Search By Food Price">
    </div>


  </form>
<div class="form-group">
<div>
 <form class="form-inline">
    <div class="form-group">
      <label for="focusedInput">&nbsp;&nbsp;Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
      <input class="form-control" id="focusedInput" type="text" placeholder = "Order By Food Name">
    </div>
<div class="form-group">
      <label for="focusedInput">&nbsp;&nbsp;Category: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
      <input class="form-control" id="focusedInput" type="text" placeholder = "Order By Food Category">
    </div>
<div class="form-group">
      <label for="focusedInput">&nbsp;&nbsp;Price: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
      <input class="form-control" id="focusedInput" type="text" placeholder = "Order By Food Price">
    </div>


  </form>
</div>
</div>
      </div>
    </div>
  </div>
</div> -->
<br /><br />

<?php
  $db = new PDO("mysql:dbname=Restaurants;host=localhost:8889", "root", "root");
  $searchFood = $_REQUEST["name"];
  $rows = $db->query("SELECT * FROM Food f JOIN Restaurents r on f.R_Id = r.R_Id where r.name = '$searchFood'");
  $aaa = 6;
  $cars = array("1","2","3");
  ?>
  <div class="container">
      <button type="button" class="btn btn-primary" id = "edit_button"><a href="Login.html">Log Out</a></button>
    <button type="button" class="btn btn-primary" id = "edit_button"><a href="MainPage.php">Main Page</a></button>
  <h2 id="title"><?= $searchFood ?></h2>
  <br /><br /><br />

 <h4 id="sss"></h4>

  <div id = "wrapper">
  <div id = "right">
   <form class="form-inline">
    <div class="form-group">
      <label for="focusedInput">&nbsp;&nbsp;Name: &nbsp;&nbsp;&nbsp;&nbsp;</label>
      <input class="form-control" id="focusedInput1" type="text" placeholder = "Search By Food Name">
      <button type="button" class="btn btn-primary" onclick = "
      searchName()
      ">Search</button>
    </div>
<div class="form-group">
      <label for="focusedInput">&nbsp;&nbsp;Category: &nbsp;&nbsp;&nbsp;&nbsp;</label>
      <input class="form-control" id="focusedInput2" type="text" placeholder = "Search ByFood Category">
      <button type="button" class="btn btn-primary" onclick = "
      searchCat()
      ">Search</button>
    </div>

  </form>
  <br />
  
  <table class="table table-hover" id="mainTable">
    <thead>
      <tr>
        <th></th>
        <th>Name</th>
        <th>Category</th>
        <th>Ingredients</th>
        <th>Price</th>
        <!--<th>Advanced Order</th>-->
      </tr>
    </thead>
    <tbody>
  <?php
  $count =2;
  $count2 = 1;
  foreach($rows as $row) {
    ?>
    <tr>
        <td><input type="checkbox" id = "<?= $count ?>" onclick="
        if(this.checked){
          myFunction(this.id)
        }
        if(!this.checked){
          ttt(this.id)
        }

          "></td>
        <td id="n<?= $count ?>"><?= $row["Name"] ?></td>
        <td id = "c<?= $count ?>"><?= $row["Categorie"] ?></td>
        <td id = "i<?= $count ?>" class = "Ingredients" onclick = "show(this.id)">See ingredients</td>
        <td id="p<?= $count ?>"><?= $row["Price"] ?></td>
        <td hidden id = "ing<?= $count ?>">
        <?php
        $name = $row["Name"];
        $c = 0;
          $Ingr = $db->query("SELECT * FROM Ingredients i JOIN Food f on f.F_Id = i.F_Id where f.name = '$name' ");
          foreach($Ingr as $a) {
        ?>
        <?= $a["ing"] ?>
      <?php
      $c++;
       } 
       ?>
       </td>
      </tr>
      <td hidden id="nb<?= $count ?>"><?= $c ?></td>
    <?php
    $count++;
  }  
  ?>
  </tbody>
  </table>

</div>
<div id = "left">
<div id="rightTable">
 <table class="table table-striped" id = "myTable">
    <thead>
      <tr>
        <th>Name</th>
        <th>Price</th>
    <!--    <th>Remove</th> -->
      </tr>
    </thead>
    <tbody>
      <tfoot>
<th>Total: </th>
<th id = "total">0</th>
</tfoot>
    </tbody>
  </table>
  </div>
  </div>

<button type="button" class="btn btn-primary" onclick = "submit()"><a href="submit.php">Submit</a></button><br/><br /><br /><br />
</div>
</div>
<br />
<br />

<table id = "search" align = "center" style=" border: 1px solid black;">

</table>


</body>
</html>
<style>
#title {
  text-align: center;
  color: #0039e6;
  font-size: 50px;
  font-style:italic;
}
.table{
  display: inline;
}
.form-inline {
  margin-top: 20px;
  margin-bottom: 10px;
}
#mainTable {
  margin-right: 15%;
}
#rightTable {
  display: inline;
  margin-left: 15%;
  height: 500px;
}

#wrapper {
    width: 1200px;
    overflow: hidden; 
}
#right {
    width: 800px;
    float:left; 
}
#left {
    overflow: hidden; 
}

th {
  color:#0039e6;
  font-weight:bold;
  font-size: 18px;
}

#searchTable td{
    border: 1px solid black;
}
.b {
  background-color:#e6ffff;
}
a {
  color: #ffffff;
}
.container {
  border-bottom-width: 1px;
    border-bottom-style: solid;
    border-bottom-color: gray;
    overflow: auto;
}
#edit_button {
    float: right;
    margin: 0 10px 10px 0; /* for demo only */
}

/*.b {
  background-image: url("http://kms.zaatarwzeit.net/content/uploads/corporatepage/160614100811753~ZWZ_Meta.jpg");
  background-size: 160px 120px;
  image-opacity: 0.2;
  background-repeat:repeat;
}*/
</style>


<!--<script>
window.onload = function() {
  if(document.getElementById("test").checked) {
    alert("s");
  
}
}
var total = 0;
var count = 0;
function myFunction(y) {
   // document.getElementById("fname").value = document.getElementById("fname").value.toUpperCase();
   //alert(x);
   //alert(document.getElementById("n" + x).innerHTML);
    
   var x = document.getElementById("myTable").rows.length;
   var table = document.getElementById("myTable");
   var row = table.insertRow(x - 1);
   row.setAttribute("id", count);
   var cell1 = row.insertCell(0);
   var cell2 = row.insertCell(1);
   cell1.innerHTML = document.getElementById("n" + y).innerHTML;
   cell2.innerHTML = document.getElementById("p" + y).innerHTML;
   total += parseInt(document.getElementById("p" + y).innerHTML);
   document.getElementById("total").innerHTML = total;
   //alert(row.id);
   count++;
}

function ttt(x) {
  //alert("n"+x);
  var value = ("n"+x).toString();
  var row = document.getElementById(value).innerHTML;
  var found = -1;
 

  for(var i = 0; i < document.getElementById("myTable").rows.length; i++) {
    found++;
    if(document.getElementById("myTable").rows[i+1].cells[0].innerHTML == row) {
       //found = document.getElementById("myTable").rows[i+1].cells[0].innerHTML;
       break;
    }
  } 

  //alert(found);
  //alert(row);
  total -= parseInt(document.getElementById("myTable").rows[i+1].cells[1].innerHTML);
  document.getElementById("total").innerHTML = total;
  document.getElementById("myTable").deleteRow(found + 1);
  //row.deleteCell(1);
}

$(document).ready(function() { 
    $("table") 
    .tablesorter({widthFixed: true, widgets: ['zebra']}) 
    .tablesorterPager({container: $("#pager")}); 
}); 

</script> -->
