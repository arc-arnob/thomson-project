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
$today = $year . '-' . $month . '-' . $day;
	if(array_key_exists("id",$_COOKIE)){
			
		$_SESSION['id'] = $_COOKIE['id'];
		
	}
	if(array_key_exists("id" , $_SESSION)) {
	$error="";
	$info="";
	
	function phpAlert($msg) {
		echo '<script type="text/javascript">alert("' . $msg . '")</script>';
	}
	if(array_key_exists('ITEM_CD',$_POST)){
		if($_POST['ITEM_CD']==""){
			$error.="Item code is required<br>";
		}
		
		if($_POST['ITEM_DESC']==""){
			$error.="Item Description is required<br>";
		}
		if($_POST['UOM_CD']==""){
			$error.="Unit of Measurement is required<br>";
		}if($_POST['DUTY_FLAG']==""){
			$error.="Duty flag is required<br>";
		}
		if($error!=""){
			$error="There were following errors in the form: ".$error;
			phpAlert($error);
		}else{
				$stock=$_POST['STOCK'];
				$query = "SELECT id FROM `items` WHERE ITEM_CD= '".mysqli_real_escape_string($link,$_POST["ITEM_CD"])."'";
				$result = mysqli_query($link,$query); 
				if(mysqli_num_rows($result)>0){
					$info.="This Item Code number already exists.<br>";
					phpAlert($info);
				}
				
				else{
					$query = "INSERT INTO items (ITEM_CD,ITEM_DESC,UOM_CD,STOCK,MIN_QYT,MAX_QYT,SHELF_LIFE,STATUS,CREATED_DATE,DUTY_FLAG,FSC_TYPE) VALUES ('".mysqli_real_escape_string($link,$_POST["ITEM_CD"])."','".$_POST['ITEM_DESC']."','".$_POST['UOM_CD']."','".$_POST['STOCK']."','".$_POST['MIN_QYT']."','".$_POST['MAX_QYT']."','".$_POST['SHELF_LIFE']."','".$_POST['STATUS']."','".$_POST['CREATED_DATE']."','".$_POST['DUTY_FLAG']."','".$_POST['FSC_TYPE']."')";
					if(mysqli_query($link,$query)){
						$info.="Success";
						header("Location: completion.php");
						echo "Problem in code" ;
						
					}
				}
			
		}
		
	}
	}
	else{
		
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
		form{
			position:absolute;
			top:200px;
			left:350px;
			width:50%;
			height:1100px;
			z-index:1;
			background: #FFFFFF;
			padding:10px;
			  box-shadow: 10px 10px 5px grey;
			font-family: Montserrat, sans-serif;
			
		}
		
		#header{
			position: absolute;
			top: 0;
			left: 150px;
			width: 80%;
			height: 150px;
			z-index: 1;
		}
		
		
		#footer{
			position:absolute;
			top:1350px;
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
			
			margin-left:950px;
			
		}
		#stBut{
			
			margin-left:270px;
			
		}
		#uom{
			
			width:100px;
		}
		#sta{
			
			width:140px;
		}
		#logo{
			
			margin-left:20px;
			margin-top:40px;
			font-family: Montserrat, sans-serif;
			font-size: 200px;
			background-image: url('back.jpg');
			background-position:center;
			background-repeat: no-repeat;
			background-size: 100%;
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
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
		
	
	</style>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-fixed-top">
		<a class="navbar-brand" href="#">Thompson Press: Item Creation</a>
		<div class="form-inline my-2 my-lg-0">
			
			<a href='index.php?logout=1'><button id="lgBut" class="btn btn-outline-success my-2 my-sm-0" type="submit">Log out</button></a>
		</div>
		</nav>
		<div id="logo">
		<h1>Thompson Press: Create A New Item</h1>
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

<form method="post"  > 
  <div class="form-group">
    <label for="ITEM_CD">Item Code</label>
    <input type="text" class="form-control" id="ITEM_CD"  name="ITEM_CD" aria-describedby="emailHelp" placeholder="Enter item code" pattern=[A-Za-z0-9]{2,10} required>
    <small id="help" class="form-text text-muted">Please enter a valid code.</small>
  </div>
  <div class="form-group">
    <label for="ITEM_DESC">Item Description</label>
		<textarea class="form-control" id="ITEM_DESC"  name="ITEM_DESC" rows="3" required></textarea>
  </div>
  
    <div id="uom" class="form-group">
    <label for="STATUS">Unit Of Measurement</label>
		<select class="form-control" name="UOM_CD" required>
		<option>KG</option>
		<option>gm</option>
		<option>L</option>
		<option>ml</option>
		</select>
	</div>
  
   <div class="form-group">
    <label for="STOCK">Stock</label>
    <input type="number" class="form-control" id="STOCK" name="STOCK" placeholder="Enter the Stock, if available" pattern=[0-9]{1,200} >
  </div>
  <div class="form-group">
    <label for="MIN_QYT">Minimum Quatity</label>
    <input type="number" class="form-control" id="MIN_QYT"  name="MIN_QYT" placeholder="Enter the Minimum Quatity" >
  </div>
  <div class="form-group">
    <label for="MAX_QYT">Maximum Quatity</label>
    <input type="number" class="form-control" id="MAX_QYT" name="MAX_QYT" placeholder="Enter the Maximum Quatity" >
  </div>
  <div class="form-group">
    <label for="SHELF_LIFE">Shelf Life</label>
    <input type="text" class="form-control" id="SHELF_LIFE" name="SHELF_LIFE" placeholder="Enter the Shelf Life of The item" pattern=[0-9]{1,5} >
  </div>
  <div  id="sta" class="form-group">
    <label for="STATUS">Status</label>
		<select class="form-control" name="STATUS">
		<option>Active</option>
		<option>Inactive</option>
		</select>
	</div>
  <div class="form-group">
    <label for="CREATED_DATE">Date Of Creation</label>
    <input type="date" class="form-control"  value="<?php echo $today; ?>" id="CREATED_DATE" name="CREATED_DATE" placeholder="Enter the date of creation">
  </div>
  <div class="form-group">
    <label for="DUTY_FLAG">Duty Flag</label>
		<select class="form-control" name="DUTY_FLAG">
		<option>Paid</option>
		<option>Free</option>
		</select>
	</div>
	<div class="form-group">
    <label for="FSC_TYPE">Forest Stewardship Council Certification</label>
		<select class="form-control" name="FSC_TYPE">
		<option>Yes</option>
		<option>No</option>
		</select>
	</div>
	<button type="submit" id="stBut" class="btn btn-primary">Submit</button>
</form>
		<div id="footer">
			<p> Thompson &#169 2019<br> Developed by Arnob and Meghna, SRMIST</p>
			
		</div>
	</body>
</html>
