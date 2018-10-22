<?php
	session_start();
	include('../config.php');
	$user=$_SESSION["login_user"];
	$sql="select * from cycle_list where reg_no='$user';";
	$result=mysqli_query($link,$sql);
	$count=mysqli_num_rows($result);
	if($count==0)
	{
		$error="No cycles registered!";
	}
	if(isset($_POST['button']))
	{
		$INP=$_POST['button'];
		$para=explode(" ",$INP);
		if($para[1]=='A')
		{
			$sql="update cycle_list set available='L' where Chasis_no='$para[0]'";
			$result=mysqli_query($link,$sql);
			if($result)
			{
				header('location: cycle_status.php');
			}
		}
		if($para[1]=='L')
		{
			$sql="update cycle_list set available='A' where Chasis_no='$para[0]'";
			$result=mysqli_query($link,$sql);
			if($result)
			{
				header('location: cycle_status.php');

			}
		}
		if($para[1]=='R')
		{
			$sql="update cycle_list set available='T' where Chasis_no='$para[0]'";
			$result=mysqli_query($link,$sql);
			if($result)
			{
				header('location: cycle_status.php');

			}
		}
		if($para[1]=='T')
		{
			$sql="update cycle_list set available='R' where Chasis_no='$para[0]'";
			$result=mysqli_query($link,$sql);
			if($result)
			{
				header('location: cycle_status.php');

			}
		}
	}
	mysqli_close($link);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Cycle-Status</title>
	<link rel="stylesheet" type="text/css" href="../css/cycle_status.css"/>
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
				<h1>View cycle Status for user:<?php echo $user;?></h1>
			</header>
			<div>
				<table>
					<tr>
						<th>Chasis-No</th>
						<th>Location</th>
						<th>Brand</th>
						<th>Status</th>
					</tr>
					<?php
						if(!(isset($error)))
						{
							while ($row=mysqli_fetch_assoc($result)) {
								?>
								<tr>
									<td><?php echo $row['Chasis_no']; ?></td>
									<td><?php echo $row['location']; ?></td>
									<td><?php echo $row['brand']; ?></td>
									<td><?php echo $row['available']; ?></td>
									<form method="POST">
									<td><button id="REG_button" type="submit" name="button" value="<?php echo $row['Chasis_no'].' '.$row['available']?>">
										<?php

											if($row['available']=='A')
											{
												echo "Lock";
											}
											else if($row['available']=='R')
											{
												echo "Lock on return";
											}
											else if($row['available']=='T'){
												echo "Waiting for return,click to cancel";
											}
											else {
												echo "Unlock";
											}

											?>
									</button>
									</form>
									</td>
								</tr>
								<?php
							}
						}
					?>
				</table>
			</div>
			<div class="error">
				<?php
					if(isset($error))
					{
						echo $error;
					}
				?>
			</div>
		</div>
</body>
</html>
