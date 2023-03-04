<!DOCTYPE html>
<?php
if(isset($_POST["username"])) 
	$username=$_POST["username"];
else
	$username="";

$cookie_name="user";
$cookie_value=$username;
setcookie($cookie_name,$cookie_value,time()+(86400 * 30), "/"); // 86400 = 1 day
?>

<html>
	<head>
		<title> Login Page </title>
		<link href="stylesheet.css" type="text/css" rel="stylesheet">
		<script src="Rearrange.js"></script>
		<link href="Images/login.png" type="image/png" rel="shortcut icon">
	</head>
	<body class="background">
	<!--<?php
		if(!isset($_COOKIE[$cookie_name]))
			echo "Cookie named '" . $cookie_name . "' is not set!";
		else 
		{
			echo "Cookie '" . $cookie_name . "' is set!<br>";
			echo "Value is: " . $_COOKIE[$cookie_name];
		}
	?>-->
		<label><input type="button" value="Log Out" name="logout" id="logout"></label>
		<h1>Cafeteria</h1>
		
		<p class="quote">"The only time to eat diet food is while you're waiting for the steak to cook."
		<span>Julia Child</span></p>
		
		<p  class="quote" id="center" >"We must have a pie. Stress cannot exist in the presence of a pie."
		<span>David Mamet, Boston Marriage</span></p>
		
		<p  class="quote">"Everything you see I owe to spaghetti."
		<span>Sophia Loren</span></p>
		<br/>
		
		<div id="search">
			<label id="search">Search:</label>
			<input type="text" name="searchInput" size="40" id="searchInput">
			<input type="button" value="Search" name="searchButton" id="searchButton">
		</div>
		<div class="rearrange" >
			<label id="reference">Arrange restaurants by:</label><br/>
			<input type="radio" name="order" value="Alphabetical A"><label class="colors">Alphabetical ASC</label><br/>
			<input type="radio" name="order" value="Alphabetical D"><label class="colors">Alphabetical DSC</label><br/>
			<input type="radio" name="order" value="Location A"><label class="colors">Distance ASC</label><br/>
			<input type="radio" name="order" value="Location D"><label class="colors">Distance DSC</label><br/>
			<input type="radio" name="order" value="Favorite"><label class="colors">Favorite</label><br/>
			<input type="radio" name="order" value="Type"><label class="colors">Type</label><br/>
		</div>
		<div id="ajax">

		</div>
		<p id="hint2">Click <span class="number">once</span> on the box to Favorite the restaurant. Click <span class="number">twice</span> to order.</p>
		<div class="restaurants" id="restaurants">
		<?php
			try
			{
				$db=new PDO("mysql:dbname=Restaurants;host=localhost:8889", "root", "root");
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$rows = $db->query("SELECT * FROM Restaurents"); //get everything from the restaurants table
				$rows=$rows->fetchAll();
				//print_r($rows);
				foreach ($rows as $row)
				{
					if($row["favorite"]==0)
						$class="notFavorite";
					else
						$class="favorite";
					?><section name="<?=$row["name"]?>" class="<?=$class?>" id="<?=$row["name"]?>">
					<span class="restaurantName"><?=$row["name"]?></span><br/>
					<img src="<?=$row["image"]?>" title="<?=$row["type"]?>" alt="<?=$row["name"]?>"/><br/>
					<span><?=$row["distance"]?>m</span>
					</section><?php
				}
			} 
			catch (PDOException $exception) 
			{
				?>
					<p>Sorry, a database error occurred. Please try again.</p>
					<p>(Error details: <?=$exception->getMessage() ?>)</p>
				<?php
		}?>
		</div>
	</body>
</html>