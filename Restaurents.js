var ajax;
window.onload = function() {
   // XMLfunc();
};


function viewOrd() {
    ajax = new XMLHttpRequest();
   // ajax.onload = getJson;
    ajax.onload = getXML;
    ajax.onerror = ajaxFailed;
    ajax.open("get", "Restaurents.php", true);
    ajax.send(null);
};


function getXML() {
    var allFilms = ajax.responseXML.getElementsByTagName("food"); 
    var table = document.createElement("table");
    table.setAttribute("class","table table-hover");
    //alert(table.id);
    var tr = document.createElement("tr");
    var th = document.createElement("th");
    th.innerHTML = "My Orders";
    tr.appendChild(th);
    
    table.appendChild(tr);
    //document.getElementById("dumpdiv").appendChild(table);
    var count = 0;
    for (var i = 0; i < allFilms.length; i++) {

        var tr = document.createElement("tr");
        var th = document.createElement("td");
        th.innerHTML = allFilms[i].getElementsByTagName("name")[0].firstChild.nodeValue;
        tr.appendChild(th);
        table.appendChild(tr);
        count++;

    }
     document.getElementsByClassName("contentPost").appendChild(table);
     //document.getElementsByClassName("table table-hover").appendChild(table);

}

function ajaxFailed(exception) {
	var errorMessage = "Error making Ajax request:\n\n";
	if (exception) {
		errorMessage += "Exception: " + exception.message;
	} else {
		errorMessage += "Server status:\n" + ajax.status + " " + ajax.statusText + 
		                "\n\nServer response text:\n" + ajax.responseText;
	}
	alert(errorMessage);
}




var total = 0;
var count = 0;
var foodName = [];
var foodCategory = [];
var foodPrice = [];
var count2 = 0;
var ordersAdded = [];
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
   ordersAdded.push(document.getElementById("n" + y).innerHTML);
   document.getElementById("total").innerHTML = total;
   //alert(row.id);
   count++;
  //alert(ordersAdded);
}

function show(z) {
  var x = z.charAt(1);
  var i = document.getElementById("ing"+x).innerHTML;
  alert(i);
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
  ordersAdded.splice(found, 1);
  //alert(ordersAdded);
  //row.deleteCell(1);
}

var q = 1;
function searchName() {
    var searchN = document.getElementById("focusedInput1").value;
    //alert(searchN);
   //var x  = document.getElementById("focusedInput").value;
    // document.getElementById("sss").innerHTML = "x";
   // document.getElementById("sirine").value = document.getElementById("focusedInput").value;
   //alert(a);
   
    var l = document.getElementById("mainTable").rows.length;
    var j = 0;
    //alert(l-9);
    if(q == 1) {
    for(var i = 2; i <= (l+1)/2; i++) {
       // alert(document.getElementById("n" + i).innerHTML);
        foodName.push(document.getElementById("n" + i).innerHTML);
        foodCategory.push(document.getElementById("c" + i).innerHTML);
        foodPrice.push(document.getElementById("p" + i).innerHTML); 
         
    }

    }
    q++;

  // alert(searchN);
    for(var i = foodName.length - 1; i >= 0; i--) { 
        if(foodName[i] == searchN) {
         // alert(i);
         document.getElementById("n" + (i+2)).style.backgroundColor = "lightblue";
         document.getElementById("c" + (i+2)).style.backgroundColor = "lightblue";
         document.getElementById("i" + (i+2)).style.backgroundColor = "lightblue";
         document.getElementById("p" + (i+2)).style.backgroundColor = "lightblue";
        }
    }

   // alert(foodName[l-2]);
   // alert(foodCategory[l-2]);
   // alert(foodPrice[l-2]);
    
    var table = document.getElementById("mainTable");
    //table.deleteRow(8);
   count++;
   // }

}

//var w = 1;
function searchCat() {
    var searchN = document.getElementById("focusedInput2").value;
    //alert(searchN);
   //var x  = document.getElementById("focusedInput").value;
    // document.getElementById("sss").innerHTML = "x";
   // document.getElementById("sirine").value = document.getElementById("focusedInput").value;
   //alert(a);
   
    var l = document.getElementById("mainTable").rows.length;
    var j = 0;
    //alert(l-9);
    if(q == 1) {
    for(var i = 2; i <= (l+1)/2; i++) {
       // alert(document.getElementById("n" + i).innerHTML);
        foodName.push(document.getElementById("n" + i).innerHTML);
        foodCategory.push(document.getElementById("c" + i).innerHTML);
        foodPrice.push(document.getElementById("p" + i).innerHTML); 
         
    }
    } 
    q++;

  // alert(searchN);
    for(var i = foodName.length - 1; i >= 0; i--) { 
        if(foodCategory[i] == searchN) {
         // alert(i);
         document.getElementById("n" + (i+2)).style.backgroundColor = "lightblue";
         document.getElementById("c" + (i+2)).style.backgroundColor = "lightblue";
         document.getElementById("i" + (i+2)).style.backgroundColor = "lightblue";
         document.getElementById("p" + (i+2)).style.backgroundColor = "lightblue";
        }
    }

   // alert(foodName[l-2]);
   // alert(foodCategory[l-2]);
   // alert(foodPrice[l-2]);
    
    var table = document.getElementById("mainTable");
    //table.deleteRow(8);
   count++;
   // }

}


function submit() {
    for(var i = 0; i < ordersAdded.length; i++) {
    ajax = new XMLHttpRequest();
   // ajax.onload = getJson;
    ajax.onload = getXML;
    ajax.onerror = ajaxFailed;
    //alert(ordersAdded[0]);
    
    ajax.open("get", "upload.php?o="+ordersAdded[i], true);

    ajax.send(null);
    }
  //alert("You have succefully ordered your food. Thank you for your time!");
}



