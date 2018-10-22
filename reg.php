<?php
	session_start();
	include('config.php');
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$choice=$_POST["type"];
		if($choice=='R')
		{
			if(!(empty(trim($_POST['username'])) &&empty(trim($_POST['password']))))
			{
				$theuser=mysqli_real_escape_string($link,$_POST['username']);
				$pass=md5($_POST['password']);
				$sql="select reg_r from r_login where reg_r='$theuser';";
				$result=mysqli_query($link,$sql);
				$count=mysqli_num_rows($result);


				if($count==1)
				{
					$error="The user already exsist!";

				}
				else
				{
					$sql="insert into r_login values('$theuser','$pass');";
					mysqli_query($link,$sql);
					$_SESSION['REGNAME']=$theuser;
					header("location: Renter_portal/reg_renter.php");
				}
			}

		}

		if($choice=='S')
		{
			if(!(empty(trim($_POST['username'])) &&empty(trim($_POST['password']))))
			{
				unset($error);
				$theuser=mysqli_real_escape_string($link,$_POST['username']);
				$pass=md5($_POST['password']);
				$sql="select reg_s from s_login where reg_s='$theuser';";
				$result=mysqli_query($link,$sql);
				$count=mysqli_num_rows($result);


				if($count==1)
				{
					$error="The user already exsist!";

				}
				else
				{
					$sql="insert into s_login values('$theuser','$pass');";
					$_SESSION['REGNAME']=$theuser;
					mysqli_query($link,$sql);
					header("location: Sponsor_portal/reg_sponsor.php");
				}
			}

		}


	}
	mysqli_close($link);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Register-New User</title>
	<link rel="stylesheet" type="text/css" href="css/reg.css"/>
	<link rel="icon" href="/DBMS/favicon.jpg">
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
				<a href="index.php" target="_self" class="button">HomePage</a>
			</div>
		</div>
		<div id="wrapper">
			<header>
				<h1>Sign Up</h1>
			</header>
			<div class="form">
				<form id="form_id" method="POST" action="#">
					<p>1.Select your service:</p>
					<select name="type" id="choices">
						<option value="R">Renter</option>
						<option value="S">Sponsor</option>
					</select>
					<p>2.Enter your Register Number:</p>
					<input type="text" id="username" name="username" placeholder="Register Number" class="reg-field" onkeydown="upperCaseF(this)"/>
					<p>3.Enter your Password:</p>
					<input type="password" name="password" id="password" placeholder="Password" class="reg-field"/>
					<p>4.Confirm your Password:</p>
					<input type="password" name="confirm_password" id="confirm_password"  placeholder="Password" class="reg-field" onkeyup="check();check2();"/>
					<span id='message'></span>
					<button id="REG_button"><script>check2();</script>Register </button>
	        		<script>
	        			var cond1=true;
	        			var cond2=true;
	          			function check() {
		            		if(document.getElementById('password').value ===document.getElementById('confirm_password').value) {
		                	document.getElementById('message').innerHTML = "Passwords Match!";
		                	cond1=true;
		            		}
		            		else {
		                	document.getElementById('message').innerHTML = "Passwords Do not Match";
		                	cond1=false;
		            		}
	          			}
	          			function check2(){
							var username=document.getElementById('form_id').username.value;
							var email=document.getElementById('form_id').password.value;
							if(username==""||password=="")
							{
								cond2=false;
							}
							else
							{

		                		cond2=true;
		                	}

		                	if(cond1==true && cond2==true)
		                	{
		                		document.getElementById("REG_button").removeAttribute('disabled');

		                	}
		                	else
		                	{
		                		document.getElementById("REG_button").setAttribute("disabled","disabled");
		                	}

						}
						check2();
						function upperCaseF(a){
	   						setTimeout(function(){
	       					 a.value = a.value.toUpperCase();
	    					}, 1);
						}
					</script>
					<div class="error">
						<?php
							if(isset($error))
							{
								echo $error;
							}
						?>
					</div>
	        	</form>

			</div>
		</div>

	</div>
</body>
</html>
