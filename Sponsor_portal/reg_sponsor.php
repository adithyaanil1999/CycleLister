<?php
	session_start();
	include('../config.php');
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$reg_no=$_SESSION['REGNAME'];
		$name=mysqli_real_escape_string($link,$_POST['Name']);
		$email=mysqli_real_escape_string($link,$_POST['email']);
		$block=mysqli_real_escape_string($link,$_POST['block']);
		$phone=mysqli_real_escape_string($link,$_POST['phone']);
		$sql="insert into sponsor(id_sponsor,name,block,email,phone) values('$reg_no','$name','$block','$email','$phone');";
		$_SESSION['login_user']=$reg_no;
		mysqli_query($link,$sql);
		header("location: welcome_sponsor.php");
	}
	mysqli_close($link);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cycle-Lister</title>
	<link rel="stylesheet" type="text/css" href="../css/reg_info.css"/>
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
		</div>
		<div id="wrapper">
			<header>
				<h1>Enter your details:</h1>
			</header>
			<div class="form">
				<form id="form_id" method="POST" action="#">

					<input type="text" name="Name" id="Name" placeholder="Name" class="reg-field" onchange="check()"/>
					<input type="email" name="email" id="email" placeholder="Email" class="reg-field" onchange="check()"/>
					<input type="text" name="block" id="block" placeholder="Block(Z for day scholar)" class="reg-field"onkeydown="upperCaseF(this)" onchange="check()"/>
					<input type="text" name="phone" id="phone" placeholder="Phone" class="reg-field" onchange="check()" />
					<span id='message'></span>
					<button id="REG_button">Register </button>
					<script>
						function check(){
							var username=document.getElementById('form_id').username.value;
							var email=document.getElementById('form_id').email.value;
							var Name=document.getElementById('form_id').Name.value;
							var phone=document.getElementById('form_id').phone.value;
							var block=document.getElementById('form_id').block.value;
							if(username==""||email=="" ||Name==""||phone=="" || block=="" )
							{
								document.getElementById("REG_button").setAttribute("disabled","disabled");
							}
							else
							{
		            document.getElementById("REG_button").removeAttribute('disabled');
		          }
						}
						function upperCaseF(a){
   						setTimeout(function(){
       					 a.value = a.value.toUpperCase();
    					}, 1);
						}
						check();
					</script>

				</form>
			</div>
		</div>
	</div>
</body>
</html>
