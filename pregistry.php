<?php
	session_start();
	$link = mysqli_connect("sql210.epizy.com","epiz_24036141","emvI7JScGILBdT5","epiz_24036141_stock");
	if(mysqli_connect_error()){
		die("There was an error");
	}
	if(array_key_exists("id",$_COOKIE)){
			
		$_SESSION['id'] = $_COOKIE['id'];
		
	}
	

?>

<html>
	<head>
	<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
	<style type="text/css">
		#container{
			width:92%;
			margin-left:55px;
			margin-top:10px;
			
			
			
		}
		#lgBut{
			
			margin-left:50px;
			
		}
		#crBut{
			
			margin-left:700px;
			
		}
		#isBut{
			
			margin-left:50px;
			
		}
		#prBut{
			
			margin-left:50px;
			
		}
		h5{
			font-family: Montserrat, sans-serif;
			
			
		}
		#info{
			margin-top:20px;
			background: #FFFBF9;
			height:50px;
			width:92%;
		}
	</style>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-fixed-top">
		<a class="navbar-brand" href="#">Purchase Register</a>
		<div class="pull-xs-right">
			
			<a href='creation.php'><button id="crBut" class="btn btn-outline-danger my-2 my-sm-0" type="submit">Create</button></a>
		</div>
		<div class="pull-xs-right">
			
			<a href='issue.php'><button id="isBut" class="btn btn-outline-info my-2 my-sm-0" type="submit">Issue</button></a>
		</div>
		<div class="pull-xs-right">
			
			<a href='purchase.php'><button id="prBut" class="btn btn-outline-warning my-2 my-sm-0" type="submit">Purchase</button></a>
		</div>
		<div class="pull-xs-right">
			
			<a href='index.php?logout=1'><button id="lgBut" class="btn btn-outline-success my-2 my-sm-0" type="submit">Log out</button></a>
		</div>
		</nav>
		<div id="info" class="container">
			<h5>This is Purchase register, please press CTRL+F to find anything in the table.</h5>
		</div>
		<?php
		if(array_key_exists("id" , $_SESSION)) {
		$query = "SELECT * FROM purchase";
		$result = mysqli_query($link,$query);
		echo "<table id='container' class='table table-dark'>";
		echo "<thead>";
		echo "<tr>";
		echo "<th scope='col'>CODE</th>";
		echo "<th scope='col'>AMOUNT PURCHASED</th>";
		echo "<th scope='col'>PURCHASE DATE</th>";
		
		echo "</tr>";
		echo "</thead>";
		 

		while($row=mysqli_fetch_array($result)){  
			echo "<tbody>";
			echo "<tr><td>" . $row['ITEM_CD'] . "</td><td>" . $row['AMOUNT_PURCHASED'] . "</td><td>" . $row['PURCHASE_DATE'] . "</td></tr>" ; 
			echo "</tbody>";
		}
		echo "</table>";
		}else{
			header("Location: index.php");
		}
		
		?>
		
	
	
	</body>

</html>