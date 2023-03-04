<!DOCTYPE html>
<html>
	<head>
		<title> Login Page </title>
		<link href="stylesheet.css" type="text/css" rel="stylesheet">
		<link href="Images/login.png" type="image/png" rel="shortcut icon">
	</head>
	<body class="background">
<?php
#server side verification
#checking if username and password defined
if(isset($_REQUEST["username"]) && !empty($_REQUEST["username"]))
	$usernameGiven=$_REQUEST["username"];
else #else die
	die("You have not provided a Name");

if(isset($_REQUEST["password"]) && !empty($_REQUEST["password"]))
	$passwordGiven=$_REQUEST["password"];
else #else die
	die("You have not provided a Password");

#users file searched 
$files=file("Users.txt");
foreach($files as $file)
{
	$username=substr($file,0,strpos($file," "));
	$password=substr($file,strpos($file," ")+1,9);//strlen($file)-strlen($username));
	
	if(strcmp($username,$usernameGiven)==0 && strcmp($password,$passwordGiven)!=0)
	{
		?><p id="error"><strong> Error! Invlaid data.</strong><br/>
		A user with the name <?= $usernameGiven ?> already exists in our system with a different password <br/>
		Please go back and try again.</p><?php
		return;
	}
	else if(strcmp($username,$usernameGiven)==0 && strcmp($password,$passwordGiven)==0)
	{
		header("Location: MainPage.php"); #take me to MainPage
		include("MainPage.php");
		return;
	}
}

#put username and password in users file separated by space
$info="\n{$usernameGiven} {$passwordGiven}";
file_put_contents("Users.txt",$info,FILE_APPEND);
header("Location: MainPage.php"); #take me to MainPage
include("MainPage.php");
?>
	</body>
</html>