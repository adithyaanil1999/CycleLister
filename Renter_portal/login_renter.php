<?php
	session_start();
	include('../config.php');
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$theuser=mysqli_real_escape_string($link,$_POST['username']);
		$pass=md5($_POST['password']);
		$sql="select reg_r from r_login where reg_r='$theuser' and password='$pass';";
		$result=mysqli_query($link,$sql);
		$count=mysqli_num_rows($result);
		if($count==1)
		{
			$_SESSION['login_user']=$theuser;
			$_SESSION['login_type']="R";
			header("location: welcome_renter.php");
		}
		else
		{
			$error="Your Login Name or Password is invalid!";
		}
	}
	mysqli_close($link);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Renter-Login</title>
	<link rel="icon" href="/DBMS/favicon.jpg">
	<link rel="stylesheet" type="text/css" href="../css/login.css"/>
	<style type="text/css"></style>
	<link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans|Dancing+Script" rel="stylesheet">

</head>
<body>
	<div id="container">
		<div id="nav">
			<div id="name_logo">
				<p>Cycle-Lister VIT&trade;</p>
			</div>
			<div id="ret">
				<a href="../index.php" target="_self" class="button">HomePage</a>
			</div>
		</div>
		<div class="form">
			<form class="login-form" method="POST" 	action="">
				<input type="text" name="username" placeholder="Register Number" onkeydown="upperCaseF(this)"/>
					<script>
						function upperCaseF(a){
   						setTimeout(function(){
       					 a.value = a.value.toUpperCase();
    					}, 1);
						}
					</script>
				<input type="password" name="password"placeholder="Password"/>
				<button id="login_button">LOGIN</button>
				<div class="error">
					<?php
						if(isset($error))
						{
							echo $error;
						}
					?>
				</div>
				<p id="message">Not Registered? <a href="../reg.php" id="message2">Click here</a></p>
			</form>
		</div>
	</div>


</body>
</html>
