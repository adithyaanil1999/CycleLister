<?php
	session_start();
	if((isset($_SESSION["login_type"]) && $_SESSION["login_type"]!=""))
	{
		if($_SESSION["login_type"]=="R")
		{
			header("location: welcome_renter.php");

		}
		if($_SESSION["login_type"]=="S")
		{
			header("location:welcome_sponsor.php");
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<html>
<head>
	<title>Cycle-Lister</title>
	<link rel="stylesheet" type="text/css" href="css/index.css" />
	<style type="text/css"></style>
	<link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans|Dancing+Script" rel="stylesheet">
	<link rel="icon" href="/DBMS/favicon.jpg">
</head>
<body>
	<div id="container">
		<div id="header">
			<h1>Welcome to Cycle-Lister VIT&trade;</h1>
		</div>
		<div id="choices">
			<p>Select your service</p>
			<div id="Sponsor_button">
				<a href="Sponsor_portal/login_spons.php" target="_self" class="button">Sponsor</a>
			</div>
			<div id="Renter_button">
				<a href="Renter_portal/login_renter.php" target="_self" class="button">Renter</a>
			</div>
		</div>
		<div id="desc">
			<p>Cycle-Lister is a Web based Application that lets you quickly and efficently seek out bicycles inside VIT-university without any hassle.For your convenience select wheater you are a sponsor(i.e. those who give out cycles) or a renter(i.e. those who seek cycles).</p>
		</div>

	</div>
	<footer id="foot">
		<div id="footer">Project Made by Adithya,Utkarsh and Chinmay for DBMS course,2018,VIT&trade;
		</div>
	</footer>
</body>
</html>
