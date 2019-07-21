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
		<a class="navbar-brand" href="#">Stock Register</a>
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
			<h5>This is Stock register, please press CTRL+F to find anything in the table.</h5>
		</div>
		<?php
		if(array_key_exists("id" , $_SESSION)) {
		$query = "SELECT * FROM items";
		$result = mysqli_query($link,$query);
		echo "<table id='container' class='table table-dark'>";
		echo "<thead>";
		echo "<tr>";
		echo "<th scope='col'>CODE</th>";
		echo "<th scope='col'>DESC</th>";
		echo "<th scope='col'>UOM</th>";
		echo "<th scope='col'>STOCK</th>";
		echo "<th scope='col'>MIN QYT</th>";
		echo "<th scope='col'>MAX QYT</th>";
		echo "<th scope='col'>SHELF LIFE</th>";
		echo "<th scope='col'>STATUS</th>";
		echo "<th scope='col'>CREATED DATE</th>";
		echo "<th scope='col'>ISSUE DT</th>";
		echo "<th scope='col'>DUTY FLAG</th>";
		echo "<th scope='col'>FSC TYPE</th>";
		echo "<th scope='col'>PURCHASE DT</th>";
		echo "</tr>";
		echo "</thead>";
		 

		while($row=mysqli_fetch_array($result)){  
			echo "<tbody>";
			echo "<tr><td>" . $row['ITEM_CD'] . "</td><td>" . $row['ITEM_DESC'] . "</td><td>" . $row['UOM_CD'] . "</td><td>" . $row['STOCK'] . "</td><td>" . $row['MIN_QYT'] . "</td><td>". $row['MAX_QYT'] . "</td><td>". $row['SHELF_LIFE'] . "</td><td>". $row['STATUS'] . "</td><td>". $row['CREATED_DATE'] . "</td><td>" . $row['LAST_QTY_ISS_DT'] . "</td><td>" . $row['DUTY_FLAG'] . "</td><td>" . $row['FSC_TYPE'] . "</td><td>" . $row['LAST_QTY_PURCHASE_DT'] . "</td></tr>"; 
			echo "</tbody>";
		}
		echo "</table>";
		}else{
			header("Location: index.php");
		}
		
		?>
		
	
	
	</body>

</html>