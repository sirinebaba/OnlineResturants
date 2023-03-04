<?php

//$pvalue = $_GET["p"];
//print $pvalue;

 $db = new PDO("mysql:dbname=Restaurants;host=localhost:8889", "root", "root");
  $searchFood = "Zaatar w Zeit";
 // $searchFood_db = $db->quote($searchFood);
  $rows = $db->query("SELECT * FROM Orders");
 //$first_name_db = $db->quote($first_name);


//header("Content-type: application/json");

/*print "{\n  \"firstname\": \"" . $first_name . "\",\n";
print "  \"lastname\": \"" . $last_name . "\",\n";
print "  \"films\": [";
$order = 1;
$count = 0;

$films = array();
foreach($rows as $row) {
    $films[$name][$order - 1] = $row["name"];
    $films[$year][$order - 1] = $row["year"];
    $films[$order][$order - 1] = $order;

    print "\n\t{\"name\": \"" . $row["name"] . "\", \"year\": " . $row["year"] . ", \"order\": " . $order . " }";
    if($order < $rows->rowCount()) {
        print ",";
    }
    $order++;
}

print "\n  ]\n}";*/
header("Content-type: application/xml");
$film = "";
print "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
print "<restaurent>\n\t<name>\n";
print "\t\t" .$searchFood . "\n";
print "\t</name>\n";

$order = 1;
$films = array();
foreach($rows as $row) {
  //  $films[$name][$order - 1] = $row["name"];
   // $films[$year][$order - 1] = $row["year"];
   // $films[$order][$order - 1] = $order;

    print "\t<food order=\"" . $order . "\" >\n";
    print "\t\t<name> " . $row["orderName"] . "</name></food>\n";
    $order++;
}
print "</restaurent>";

?>