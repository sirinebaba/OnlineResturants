<?php
try
{
	$db=new PDO("mysql:dbname=Restaurants;host=localhost:8889", "root", "root");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if(isset($_GET["required"])) //if required is set
	{
		$required=$_GET["required"];
		//search for values in database and echo to use with json
		if(isset($_GET["searchValue"]) && $required=="search")
		{
			$value=$_GET["searchValue"];
			$rows = $db->query("SELECT * FROM `Restaurents` WHERE type LIKE '%$value%' OR name LIKE '%$value%' OR distance LIKE '%$value%' ORDER BY name ASC"); 
			$rows=$rows->fetchAll();
			$arrayRestaurants="{\"restaurants\":[ ";
			foreach($rows as $row)
			{
				$arrayRestaurants .="{" . '"name":"' . $row["name"] .'",';
				$arrayRestaurants .='"type":"' . $row["type"] .'",';
				$arrayRestaurants .='"distance":"' . $row["distance"] .'"},';
			}
			$arrayRestaurants=substr($arrayRestaurants,0,strlen($arrayRestaurants)-1); //to remove extra ,
			echo "$arrayRestaurants]}";
		}
		
		//update favorite values in database
		if(isset($_GET["updateValue"]) && isset($_GET["name"]) && $required=="update")
		{
			$value=$_GET["updateValue"]; 
			$name=$_GET["name"];
	
			$stmt = $db->prepare("UPDATE restaurents SET favorite='$value' WHERE name='$name'");
			$stmt->execute(); // execute the query
		}
		
		//arrange sections of restaurants on main page
		if(isset($_GET["arrangeValue"]) && $required=="arrange")
		{
			$value=$_GET["arrangeValue"];
			$arrayRestaurantsName=array();
			$arrayRestaurantsType=array();
			$arrayRestaurantsLocation=array();
			$rows = $db->query("SELECT * FROM `restaurents`");
			$rows=$rows->fetchAll();
			$counter=0;
			foreach($rows as $row)
			{
				if($row["favorite"]==0)
					$class="notFavorite";
				else
					$class="favorite";
				
				$arrayRestaurantsName[$counter]=$row["name"].":".$row["type"].":".$row["distance"].":".$class.":".$row["image"];
				$arrayRestaurantsType[$counter]=$row["type"].":".$row["name"].":".$row["distance"].":".$class.":".$row["image"];
				$arrayRestaurantsLocation[$counter]=$row["distance"].":".$row["name"].":".$row["type"].":".$class.":".$row["image"];
				$arrayRestaurantsFavorite[$counter]=$class.":".$row["name"].":".$row["type"].":".$row["distance"].":".$row["image"];
				$counter++;
			}
			
			$length=count($arrayRestaurantsName);
			
			/*print_r($arrayRestaurantsName);
			print_r($arrayRestaurantsType);
			print_r($arrayRestaurantsLocation);
			print_r($arrayRestaurantsFavorite);*/
			
			if(strcmp($value,"Alphabetical A")==0)
				sort($arrayRestaurantsName);
			else if(strcmp($value,"Alphabetical D")==0)
				rsort($arrayRestaurantsName);
			else if(strcmp($value,"Type")==0)
			{
				sort($arrayRestaurantsType);
				$arrayRestaurantsName=NULL;
			}
			else if(strcmp($value,"Favorite")==0)
			{
				sort($arrayRestaurantsFavorite);
				$arrayRestaurantsLocation=NULL;
				$arrayRestaurantsName=NULL;
				$arrayRestaurantsType=NULL;
			}
			else if(strcmp($value,"Location A")==0)
			{
				sort($arrayRestaurantsLocation,1);
				$arrayRestaurantsType=NULL;
				$arrayRestaurantsName=NULL;
			}
			else if(strcmp($value,"Location D")==0)
			{
				//sort($arrayRestaurantsLocation);
				rsort($arrayRestaurantsLocation,1);
				$arrayRestaurantsType=NULL;
				$arrayRestaurantsName=NULL;
			}
			
			for($i=0;$i<$length;$i++)
			{
				if($arrayRestaurantsName!=NULL)  //if by name
				{
					$arrayInfo=explode(":",$arrayRestaurantsName[$i]);
					list($name,$type,$distance,$favorite,$image)=$arrayInfo;
				}
				else if($arrayRestaurantsType!=NULL) //if by type
				{
					$arrayInfo=explode(":",$arrayRestaurantsType[$i]);
					list($type,$name,$distance,$favorite,$image)=$arrayInfo;
				}
				else if($arrayRestaurantsLocation!=NULL)  //if by location
				{
					$arrayInfo=explode(":",$arrayRestaurantsLocation[$i]);
					list($distance,$name,$type,$favorite,$image)=$arrayInfo;
				}
				else if($arrayRestaurantsFavorite!=NULL)  //if by favorite
				{
					$arrayInfo=explode(":",$arrayRestaurantsFavorite[$i]);
					list($favorite,$name,$type,$distance,$image)=$arrayInfo;
				}

				?><section name="<?=$name?>" class="<?=$favorite?>" id="<?=$name?>">
				<span class="restaurantName"><?=$name?></span><br/>
				<img src="<?=$image?>" title="<?=$type?>" alt="<?=$name?>"/><br/>
				<span><?=$distance?>m</span>
				</section><?php
			}
		}
	}
} 
catch (PDOException $exception) 
{
	?>
		<p>Sorry, a database error occurred. Please try again.</p>
		<p>(Error details: <?=$exception->getMessage() ?>)</p>
	<?php
}?>
