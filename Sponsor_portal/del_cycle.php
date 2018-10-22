<?php
	session_start();
	include('../config.php');
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$Chasis=mysqli_real_escape_string($link,$_POST['Chasis_no']);
		$sql="select Chasis_no from cycle_list where Chasis_no='$Chasis';";
		$result=mysqli_query($link,$sql);
		$count=mysqli_num_rows($result);

		if($count==0)
		{
			$error="No cycle was found!";

		}
		else
		{

			$sql="select Chasis_no from cycle_list where available='N' and Chasis_no='$Chasis';";
			$result=mysqli_query($link,$sql);
			$count=mysqli_num_rows($result);
			if($count!=0)
			{
				$error="Cycle is currently rented!";
			}
			else
			{
				$sql="delete from cycle_list where Chasis_no='$Chasis';";
				$result=mysqli_query($link,$sql);
				header("location: welcome_sponsor.php");
			}
		}
	}
	mysqli_close($link);
?>

<!DOCTYPE html>
<html>
<head>
	<title>UnRegister your cycle</title>
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
				<h1>Unregister your cycle</h1>
			</header>
			<div class="form">
					<form id="form_id" method="POST" action="#">
						<p>Enter Chasis number:</p>
						<input type="text" name="Chasis_no" id="Chasis_no" placeholder="Chasis Number" class="reg-field" onchange="check()" onkeydown="upperCaseF(this)"/>
						<button id="REG_button">Unregister</button>
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
</body>
</html>
