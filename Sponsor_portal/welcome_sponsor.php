<?php
	session_start();
	include('../config.php');
	$user=$_SESSION["login_user"];
	$sql="select wallet_sponsor from sponsor where id_sponsor='$user';";
	$result=mysqli_query($link,$sql);
	$row=mysqli_fetch_assoc($result);
	$amount=$row['wallet_sponsor'];
	$_SESSION['amount']=$amount;

?>
<!DOCTYPE html>
<html>
<head>
	<title>Sponsor Portal</title>
	<link rel="stylesheet" type="text/css" href="../css/welcome.css"/>
	<link rel="icon" href="/DBMS/favicon.jpg">
	<style type="text/css"></style>
	<link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans|Dancing+Script" rel="stylesheet">
	<link rel="icon" href="/DBMS/favicon.jpg">
</head>
<body>
	<div class="container">
		<div id="nav">
			<div id="name_logo">
				<p>Cycle-Lister VIT&trade;</p>
			</div>
			<div id="ret">
				<a href="../Logout.php" target="_self" class="button">Logout</a>
			</div>
		</div>
		<div id="sidebar">
			<ul id="menu">
				<li class="items"><a href="cycle_reg.php" target="_self" >Cycle Registeration</a></li>
				<li class="items"><a href="del_cycle.php" target="_self" >Delete Cycle</a></li>
				<li class="items"><a href="cycle_status.php" target="_self">View/Modify Cycle Status</a></li>
				<li class="items"><a href="Withdraw.php" target="_self">Withdraw</a></li>
				<li class="items"><a href="change_pass.php" target="_self">Change password</a></li>
				<li class="items"><a href="del_user.php" target="_self">Delete user</a></li>
			</ul>
		</div>
		<div id="wrapper">
			<div id="text">
				<p>Welcome user:<?php echo " ".$_SESSION["login_user"];?></p>
				<p>Current Wallet Amount: <?php echo $amount;?></p>
				<p>Use the side bar to explore your options</p>
			</div>
		</div>
	</div>
</body>
</html>
