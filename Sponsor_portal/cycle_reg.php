<?php
	session_start();
	include('../config.php');
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$loc=mysqli_real_escape_string($link,$_POST['location']);
		$Chasis=mysqli_real_escape_string($link,$_POST['Chasis_no']);
		$brand=mysqli_real_escape_string($link,$_POST['brand']);
		$reg=mysqli_real_escape_string($link,$_SESSION['login_user']);
		$sql="select Chasis_no from cycle_list where Chasis_no='$Chasis';";
		$status='A';
		$result=mysqli_query($link,$sql);
		$count=mysqli_num_rows($result);

		if($count==1)
		{
			$error="The Cycle is already Registered!";

		}
		else
		{
			$sql="insert into cycle_list values('$Chasis','$reg','$brand','$loc','$status');";
			mysqli_query($link,$sql);
			header("location:welcome_sponsor.php");
		}
	}
	mysqli_close($link);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register-Cycle</title>
	<link rel="stylesheet" type="text/css" href="../css/reg.css"/>
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
				<a href="welcome_sponsor.php" target="_self" class="button">Back</a>
			</div>
		</div>
		<div id="wrapper">
			<header>
				<h1>Register your cycle</h1>
			</header>
			<div class="form">
				<form id="form_id" method="POST" action="#">
					<p>1.Select the booth in which you are registering:</p>
					<select name="location" id="choices">
						<option value="SJT">SJT</option>
						<option value="TT">TT</option>
						<option value="MB">MB</option>
						<option value="SMV">SMV</option>
					</select>
					<p>2.Enter Chasis number:</p>
					<input type="text" name="Chasis_no" id="Chasis_no" placeholder="Chasis Number" class="reg-field" onchange="check()" onkeydown="upperCaseF(this)"/>
					<p>3.Enter the Brand of your cycle:</p>
					<input type="text" name="brand" id="brand" placeholder="Brand" class="reg-field" onkeyup="check()"/>
					<button id="REG_button">Register</button>
	        	</form>
			</div>
			<div class="error">
					<?php
						if(isset($error))
						{
							echo $error;
						}
					?>
			</div>
			<script>
				function check(){
					var cond2;
					var Chasis_no=document.getElementById('form_id').Chasis_no.value;
					var brand=document.getElementById('form_id').brand.value;
					if(Chasis_no==""||brand=="")
					{
						cond2=false;
					}
					else
					{

              cond2=true;
          }

        	if(cond2==true)
        	{
        		document.getElementById("REG_button").removeAttribute('disabled');

        	}
        	else
        	{
        		document.getElementById("REG_button").setAttribute("disabled","disabled");
        	}
				}
				check();
				function upperCaseF(a){
	   						setTimeout(function(){
	       					 a.value = a.value.toUpperCase();
	    					}, 1);
						}
			</script>
		</div>

	</div>
</body>
</html>
