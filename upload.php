<?php
  $db = new PDO("mysql:dbname=Restaurants;host=localhost:8889", "root", "root");
  $order = $_REQUEST["o"];
  $sql = "INSERT INTO Orders(OrderName) VALUES ('$order')";
$db->exec($sql);
//print "succeess";
?>