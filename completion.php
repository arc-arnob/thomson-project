<?php
	if(array_key_exists("id",$_COOKIE)){
			
		$_SESSION['id'] = $_COOKIE['id'];
		
	}
	if(array_key_exists("id" , $_SESSION)) {
		
		
	}
	else{
			header("Location: index.php");
		
	}

?>

<html>
	<title> Success </title>
	<head>
	<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<style>
		#success{
			margin-left:450px;
			
		}
		.text{
			
			margin-top:20px;
			text-align:center;
			font-family: Montserrat, sans-serif;
			font-size: 50px;
			background-color:#4CD58A;
			background-position:center;
			background-repeat: no-repeat;
			background-size: 100%;
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			
		}
		#button{
			font-family: Montserrat, sans-serif;
			
			margin-left:645px;
		}
	</style>
	</head>
	<body>
		<div id="success">
			<img src="success.png" width="400" height="400">
		</div>
		<h4 class="text">Yey! You just completed the task successfully, Happy Working!</h4>
		 <div id="button">
		 <a href="creation.php">Go Back</a>
		 </div>
	</body>

</html>