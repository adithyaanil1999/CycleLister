<?php
	session_start();
	include('../config.php');
	$user=$_SESSION["login_user"];
	$sql="select chasis_no from cycle_rec where renter_reg='$user' and ret_status='N';";
	//echo $sql;
	$result=mysqli_query($link,$sql);
	$count=mysqli_num_rows($result);
	if($count==1)
	{
		$row=mysqli_fetch_assoc($result);
		$_SESSION['curr_cycle']=$row['chasis_no'];
	}
	else {
		unset($_SESSION["curr_cycle"]);
	}
	mysqli_close($link);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Renter Portal</title>
	<link rel="icon" href="/DBMS/favicon.jpg">
	<link rel="stylesheet" type="text/css" href="../css/welcome.css"/>
	<style type="text/css"></style>
	<link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans|Dancing+Script" rel="stylesheet">
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
				<li class="items"><a href="rent_cycle.php" target="_self" >Rent Cycle</a></li>
				<li class="items"><a href="ret_cycle.php" target="_self" >Return Cycle</a></li>
				<li class="items"><a href="change_pass.php" target="_self">Change password</a></li>
				<li class="items"><a href="del_user.php" target="_self">Delete user</a></li>
			</ul>
		</div>
		<div id="wrapper">
			<div id="text">
				<p>Welcome user:<?php echo " ".$_SESSION["login_user"];?></p>
				<p>
					<?php
					if(isset($_SESSION['curr_cycle']))
					{
						echo "The cycle you currently Rented is: ".$_SESSION['curr_cycle'];
					}
					else {
						echo "You currently have not Rented any Cycle! Go for a ride!";
					}
					?>
				</p>
				<p>Use the side bar to explore your options</p>
			</div>
		</div>
	</div>
</body>
</html>
