window.onload=function()
{
	document.getElementById("logout").onclick=logout;
	var rearrange=document.getElementsByClassName("rearrange");
	rearrange=rearrange[0].getElementsByTagName("input");
	for(var i=0;i<rearrange.length;i++)
	{
		rearrange[i].onclick=function()
		{
			arrange(this.value);
		};
	}
	var sections=document.getElementsByTagName("section");
	for(var i=0;i<sections.length;i++)
	{
		sections[i].onclick=favorite;
		sections[i].ondblclick=specificPage;
	}
	
	document.getElementById("searchButton").onclick=search;
	//alert("DONE WITH LOAD");
};

/*
function counter()
{
	alert();
	window.setInterval("run()",1000);
}

function run()
{
	var math=1000*60*5;
	alert();
	if(count==math)
	{
		window.location="Login.html";
	}
	count++;
}*/

function favorite()
{
	//alert("IN FAVORITE");
	if(this.className=="favorite")
	{
		this.className="notFavorite";
		update(0,this.id);
	}
	else
	{
		this.className="favorite";
		update(1,this.id);
	}
	//alert(this.parentNode.innerHTML);
	//alert("DONE WITH FAVORITE");
}

function update(what,who)
{
	//alert("IN UPDATE");
	var ajax=new XMLHttpRequest();
	try 
	{
		ajax.open("get", "query.php?required=update&updateValue="+what+"&name="+who, true);
		ajax.send(null);
	} 
	catch (e) // if ("" + e).match(/denied/
	{
		alert("Ajax security error: cannot fetch " + url);
	}
	//alert("DONE WITH UPDATE");
}

function specificPage()
{
	window.location="project.php?name="+this.id;
}

function logout()
{
	window.location="Login.html";
}

function arrange(how)
{
	//alert("IN ARRANGE");
	var ajax=new XMLHttpRequest();
	document.getElementById("restaurants").innerHTML = "";
	ajax.onreadystatechange = function() 
	{
		if(ajax.readyState==4) 
			document.getElementById("restaurants").innerHTML = ajax.responseText;
	};
	try 
	{
		ajax.open("get", "query.php?required=arrange&arrangeValue="+how, true);
		ajax.send(null);
	} 
	catch (e) // if ("" + e).match(/denied/
	{
		alert("Ajax security error: cannot fetch " + url);
	}
	//alert("DONE WITH ARRANGE");
}

function search()
{
	//alert("IN SEARCH");
	var ajax = new XMLHttpRequest();
	ajax.onload=objectFunctionSearch;
	ajax.onreadystatechange = function() 
	{
		if(ajax.readyState==4) 
			document.getElementById("ajax").innerHTML = ajax.responseText;
	};
	try 
	{
		var value=document.getElementById("searchInput").value; //get value of search 
		//debugger;
		ajax.open("get", "query.php?required=search&searchValue="+value, true);
		ajax.send(null);
	} 
	catch (e) // if ("" + e).match(/denied/
	{
		alert("Ajax security error: cannot fetch " + url);
	}
	//alert("DONE WITH SEARCH");
}

//json function
function objectFunctionSearch()
{
	var data = JSON.parse(this.responseText);
	if(data.restaurants.length==0)
	{
		document.getElementById("ajax").innerHTML = "No such field in our database";
		return;
	}
	
	document.getElementById("ajax").innerHTML = "";   // clear previous search entries
	
	//initial header elements
	var table=document.createElement("table");
	var tr=document.createElement("thead");
	var td = document.createElement("td");
	td.innerHTML="Restaurant Name";
	tr.appendChild(td);
	td = document.createElement("td");
	td.innerHTML="Type";
	tr.appendChild(td);
	td = document.createElement("td");
	td.innerHTML="Distance";
	tr.appendChild(td);
	table.appendChild(tr);
	
	for (var i=0;i<data.restaurants.length;i++) 
	{
		/*var linkNewPage=document.createElement("a");
		linkNewPage.href="NewPage.html";*/
		
		tr=document.createElement("tr");
		td=document.createElement("td");
		td.innerHTML="<a href=\"project.php?name="+data.restaurants[i].name+"\">"+data.restaurants[i].name+"</a>"; //make the name a link to the next page to order
		//td.onclick = function() {alert();};
		/*linkNewPage.appendChild(td);*/
		tr.appendChild(td);
		
		td = document.createElement("td");
		td.innerHTML=data.restaurants[i].type;
		tr.appendChild(td);

		td = document.createElement("td");
		td.innerHTML=data.restaurants[i].distance;
		tr.appendChild(td);
		
		table.appendChild(tr);
	}
	
	document.getElementById("ajax").appendChild(table);
}