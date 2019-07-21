<?php
	session_start();
	$link = mysqli_connect("sql210.epizy.com","epiz_24036141","emvI7JScGILBdT5","epiz_24036141_stock");
	if(mysqli_connect_error()){
		die("There was an error");
	}
	$month = date('m');
	$day = date('d');
	$year = date('Y');
	$today = $year . '-' . $month . '-' . $day;
	if(array_key_exists("id",$_COOKIE)){
			
		$_SESSION['id'] = $_COOKIE['id'];
		
	}
	if(array_key_exists("id" , $_SESSION)) {
	$error="";
	$info="";
	
	function phpAlert($msg) {
		echo '<script type="text/javascript">alert("' . $msg . '")</script>';
	}if($_POST['SUBMIT']==0){
	if(array_key_exists('ITEM_CD',$_POST)){
		if($_POST['ITEM_CD']==""){
			
			$error.="Item code can't be kept empty";
		}
		if($_POST['AMOUNT_ISSUED']==""){
			
			$error.="Please specify amount issued";
		}
		if($_POST['ISSUE_DATE']==""){
			
			$error.="Date can't be kept empty";
		}else{
			$query= "SELECT * FROM `items` WHERE ITEM_CD= '".mysqli_real_escape_string($link,$_POST["ITEM_CD"])."'";
			$result=mysqli_query($link, $query);
			$row=mysqli_fetch_array($result);
			$stock=$row["STOCK"];
			$min=$row["MIN_QYT"];
			$max=$row["MAX_QYT"];
			
			if(array_key_exists("ITEM_CD",$row)){
				if($_POST['AMOUNT_ISSUED'] > $stock){
				
					phpAlert("Not enough stock to issue");			//<----------------------------
			
				}else if($_POST['AMOUNT_ISSUED'] < $min){
				
					phpAlert("You have to issue atleast more than ".$min." KG of goods"); 		//<----------------------------
				
				}else if($_POST['AMOUNT_ISSUED'] > $max){
				
					phpAlert("You can issue atmost more than ".$max." KG of goods");  //<----------------------------
				
				}else{
				$stock=$stock-$_POST['AMOUNT_ISSUED'];
				$query= "INSERT INTO `issue` (ITEM_CD,AMOUNT_ISSUED,ISSUE_DATE) VALUES('".mysqli_real_escape_string($link,$_POST["ITEM_CD"])."','".$_POST['AMOUNT_ISSUED']."','".$_POST["ISSUE_DATE"]."' ) ";
				if(mysqli_query($link,$query)){
					
					$query = "UPDATE `items` SET LAST_QTY_ISS_DT= '".$_POST["ISSUE_DATE"]."'  WHERE ITEM_CD= '".mysqli_real_escape_string($link,$_POST["ITEM_CD"])."'";
					$result = mysqli_query($link , $query);
					$query = "UPDATE `items` SET STOCK= '$stock'  WHERE ITEM_CD= '".mysqli_real_escape_string($link,$_POST["ITEM_CD"])."'";
					if(mysqli_query($link,$query)){
						
						header("Location: completion.php");
						
					}
				}
				
				}
			
			
			}else{
				
				phpAlert("Theres no such Item in the Stock"); //<-----------------------------------INFO
				
			}
		}
		
	}}else{
			
				$query= "SELECT * FROM items WHERE ITEM_CD= '".mysqli_real_escape_string($link,$_POST["ITEM_CD"])."'";
				$result=mysqli_query($link, $query);
				$row=mysqli_fetch_array($result);
				if(array_key_exists('ITEM_CD',$row)){
				$avail = $row['STOCK'];
				$min= $row['MIN_QYT'];
				$max= $row['MAX_QYT'];
				$msg = "Stock: ".$avail." ,"."Minimum: ".$min." ,"."Maximum: ".$max;
			
				phpAlert($msg);
			}else{
				
					phpAlert("No such item present");
				
			}
		
	}
	}else{
		
		header("Location: index.php");
		
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
	body{
			background-color: #E9E9E9;
			
		}
		#main{
			position:absolute;
			top:200px;
			left:350px;
			width:50%;
			height:400px;
			z-index:1;
			background: #FFFFFF;
			padding:10px;
			box-shadow: 10px 10px 5px grey;
			font-family: Montserrat, sans-serif;
		}
		#logo{
			
			margin-left:50px;
			margin-top:50px;
			font-family: Montserrat, sans-serif;
			font-size: 200px;
			background-image: url('back.jpg');
			background-position:center;
			background-repeat: no-repeat;
			background-size: 100%;
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
		}
		#header{
			position: absolute;
			top: 0;
			left: 150px;
			width: 80%;
			height: 150px;
			z-index: 1;
		}
		#Card{
			position:absolute;
			top:150px;
			margin-left:200px;
			height:200px;
			
		}
		.card{
			padding:10px;
			top:50px;
		}
		#footer{
			position:absolute;
			top:800px;
			font-family:"Courier New", Courier, monospace;
			font-size:13px;
			text-align:center;
			left:0;
			width:100%;
			height:50px;
			background: #FFFFFF;
			z-index:1;
		}
		#lgBut{
			
			margin-left:1050px;
			
		}
		#stBut{
			
			margin-left:270px;
			
		}
		#menu{
			position:absolute;
			top:200px;
			left:20px;
			width:150px;
			height:500px;
			width: 150px;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			text-align: center;
		
			
	
		}
		ul{
			list-style-type:none;
			margin:0;
			padding:0;
			background-color: #FFFFFF;
		}
		li a {
			display:block;
			text-align:center;
			text-decoration:none;
			padding:10px 15px;
			color: #000000;
			font-family: Montserrat, sans-serif;
		}
		li a:hover{
			background-color: rgba(187,255,187,1);
			color: rgba(0,74,0,1);
	
		}
		#status{
			
			width: 200px;
			height=50px;
			margin-left:1050px;
			z-index:2;
			position:absolute;
			top:200px;
			background: #FFFFFF;
			padding:10px;
			  box-shadow: 10px 10px 5px grey;
			font-family: Montserrat, sans-serif;
			
		}
		
	
	</style>
	<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-fixed-top">
		<a class="navbar-brand" href="#">Thompson Press</a>
		<div class="pull-xs-right">
			
			<a href='index.php?logout=1'><button id="lgBut" class="btn btn-outline-success my-2 my-sm-0" type="submit">Log out</button></a>
		</div>
		</nav>
	<div id="logo">
		<h1>Thompson Press: Issue an Item</h1>
	</div>
	<hr>
		<ul id="menu">
		<hr>
		<li><a href="creation.php">Create</a></li>
		<hr>
		<li><a href="issue.php">Issue</a></li>
		<hr>
		<li><a href="purchase.php">Purchase</a></li>
		<hr>
		<li><a href="iregistry.php">Stock Register</a></li>
		<hr>
		<li><a href="isregistry.php">Issue Register</a></li>
		<hr>
		<li><a href="pregistry.php">Purchase Register</a></li>
		<hr>
	</ul>
	
<form method="post" id="main">
  <div class="form-group" >
    <label for="ITEM_CD">Item Code</label>
    <input type="text" class="form-control" id="ITEM_CD" name="ITEM_CD" aria-describedby="emailHelp" placeholder="Enter item code" required>
    <small id="help" class="form-text text-muted">Please enter a valid code.</small>
  </div>
	<div class="form-group">
    <label for="AMOUNT_ISSUED">Quantity Issued</label>
    <input type="number" class="form-control" id="AMOUNT_ISSUED" name="AMOUNT_ISSUED" aria-describedby="emailHelp" placeholder="Enter the amount issued" required>
    <small id="help" class="form-text text-muted">Please enter a valid amount.</small>
  </div>
	<div class="form-group">
    <label for="ISSUE_DATE">Date Of Issue</label>
    <input type="date" class="form-control" value="<?php echo $today; ?>" id="ISSUE_DATE" name="ISSUE_DATE" placeholder="Enter the date of purchase">
  </div>
	<button type="submit" value=0 name="SUBMIT" id="stBut" class="btn btn-primary">Submit</button>
</form>
<form method="post" id="status">
	<div class="form-group">
    <label for="ITEM_CD">Check Status</label>
    <input type="text" class="form-control" id="STATE" name="ITEM_CD" aria-describedby="emailHelp" placeholder="Enter item code">
    <small id="help" class="form-text text-muted">Enter a valid code</small>
	<button type="submit" value=1 id="ctBut" name="SUBMIT" class="btn btn-info">Check</button>
  </div>
	</form>
		<div id="footer">
			<p> Thompson &#169 2019<br> Developed by Arnob and Meghna, SRMIST</p>
			
		</div>
	</body>
</html>