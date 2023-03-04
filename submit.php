<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cafetria System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <link href="stylesheet.css" type="text/css" rel="stylesheet">
  <link href="Images/login.png" type="image/png" rel="shortcut icon">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script src="Restaurents.js" type="text/javascript"></script>
</head>

<body>

<body id="login">
		<h1>Cafeteria</h1>
		
			<fieldset>
				<h4> You have succefully ordered your food.</h4>
                <div class="contentPost">
                    <h5>Thank you for ordering from Restaurents Online servie</h5>
                </div>
                <div class="contentPost">
                    <h5>For more information Contact us on 71234567</h5>
                </div>	
                <button type="button" class="btn btn-primary"><a href = "MainPage.php">Main Page</a></button>
                <button type="button" class="btn btn-primary"><a href = "Login.html">Log Out</a></button>
			</fieldset>
		
	</body>
</body>
</html>

<script type='text/javascript'>
$(document).ready(function() {
    $(".contentPost").delay(2000).fadeIn(500);
});
</script>

<style>
.contentPost { display:none;}
</style>