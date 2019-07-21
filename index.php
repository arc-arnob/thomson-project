<?php
	session_start();
	if(array_key_exists("logout" ,$_GET)){
		
		unset($_SESSION);	
		setcookie("id","",time()-60*60);
		$_COOKIE["id"]="";
		
	}else if(array_key_exists("id",$_SESSION) OR array_key_exists("id", $_COOKIE)){
		
		header("Location: creation.php");
		
	}
	$link = mysqli_connect("sql210.epizy.com","epiz_24036141","emvI7JScGILBdT5","epiz_24036141_employee");
	if(mysqli_connect_error()){
		die("There was an error");
	}
	$error="";
	$info="";
	function phpAlert($msg) {
		echo '<script type="text/javascript">alert("' . $msg . '")</script>';
	}
	if(array_key_exists('EMP_ID',$_POST)){
		$query = "SELECT * FROM `login` WHERE EMP_ID = '".mysqli_real_escape_string($link,$_POST['EMP_ID'])."'";
		$result = mysqli_query($link,$query); 
				if(mysqli_num_rows($result)>0){
					$row=mysqli_fetch_array($result);
					
					$pass=$row["PASS"];
					
					if($_POST['PASS']==$pass){
						$_SESSION['id']= mysqli_insert_id($link);
						setcookie('id', mysqli_insert_id($link) , time() + 60*60*24);
						header("Location: creation.php");
						
					}else{
						
						phpAlert("Wrong Id or Password");
						
					}
					
					
				}else{
					
					phpAlert("Wrong Id or Password ");
				}
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
			background: #FFFBF9;
			
		}
		.text{
			font-family: Montserrat, sans-serif;
			font-size: 200px;
			background-image: url('Thompson.jpg');
			background-position:center;
			background-repeat: no-repeat;
			background-size: 100%;
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			
		}
		#login{
			position:absolute;
			padding:10px;
			border-radius:5px;
			top:300px;
			left:750px;
			width:400px;
			height:320px;
			z-index:1;
			background: #FFFBE2;
		}
		label{
			font-family: Montserrat, sans-serif;
		}
		#history{
			background: #FFFBE2;
			margin-top:130px;
		}
		.lead{
			padding:5px;
			margin-left:10px;
		}
		#About{
			font-family: Montserrat, sans-serif;
			margin-left:10px;
		}
		#footer{
			position:absolute;
			top:950px;
			font-family:"Courier New", Courier, monospace;
			font-size:13px;
			text-align:center;
			left:0;
			width:100%;
			height:50px;
			background: #FFFFFF;
			z-index:1;
		}
		
		
	</style>
	<body>
		<h1 class="text">Thompson Press.</h1>
		<div id="login">
		<form method="post" >
			<div class="form-group">
				<label for="employeeId">Employee Id</label>
				<input type="text" class="form-control" name="EMP_ID" id="employeeId" aria-describedby="emailHelp" placeholder="Enter the Id" required>
				<small id="emailHelp" class="form-text text-muted">Never share your employee Id with anyone else.</small>
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" name="PASS" id="password" placeholder="Password" required>
			</div>
			
			<button type="submit" class="btn btn-primary" value=1>Login</button>
		</form>
		</div>
		<div id="history"class="jumbotron jumbotron-fluid">
			<div class="information">
			<h1 id="About" class="display-4">About Us</h1>
			<p class="lead">Established in 1967, Thomson Press is renowned in equal parts for its state-of-the-art infrastructure, highly skilled team, robust processes and adoption of the latest technological advances. Operating from its 5 factories in the National Capital Region (NCR) and Chennai, the company acts as a turnkey provider of printing services with an extensive plant and machinery list of mono and multi-colour Sheetfed and web offset printing, automated binding, finishing and distribution management.</p>
			</div>
		</div>
		
		<div id="footer">
			<p> Thompson &#169 2019<br> Developed by Arnob and Meghna, SRMIST</p>
			
		</div>
		
	</body>
</html>
