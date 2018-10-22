<?php
	session_start();
	include('../config.php');
  if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$loc=mysqli_real_escape_string($link,$_POST['location']);
    $user=$_SESSION["login_user"];
    $sql="select available from cycle_list where Chasis_no='$_SESSION[curr_cycle]' and available='T';";
		$result=mysqli_query($link,$sql);
		$count=mysqli_num_rows($result);
    if($count==1)
    {
      $sql="update cycle_list set available='L',location='$loc' where Chasis_no='$_SESSION[curr_cycle]';";
  		$result=mysqli_query($link,$sql);
      if($result)
      {
        $sql="update cycle_rec set end_Time=now(),ret_status='T' where renter_reg='$user';";
  		  $result=mysqli_query($link,$sql);

      }
    }
    else
    {
      $sql="update cycle_list set available='A',location='$loc' where Chasis_no='$_SESSION[curr_cycle]';";
  		$result=mysqli_query($link,$sql);
      if($result)
      {
        $sql="update cycle_rec set end_Time=now(),ret_status='T' where renter_reg='$user';";
  		  $result=mysqli_query($link,$sql);
      }
    }
		$sql="select reg_no from cycle_list where Chasis_no='$_SESSION[curr_cycle]';";
		$result=mysqli_query($link,$sql);
    $row=mysqli_fetch_assoc($result);
    $reg=mysqli_real_escape_string($link,$row['reg_no']);

		$sql="insert into trans_cycle(t_diff,total,id_rec)
		values((select TIMESTAMPDIFF(SECOND,start_Time,end_Time) from cycle_rec where renter_reg='$user'order by id DESC LIMIT 1),
		(select TIMESTAMPDIFF(SECOND,start_Time,end_Time) from cycle_rec where renter_reg='$user' order by id DESC LIMIT 1 )*5,
		(select sponsor_reg from cycle_rec where renter_reg='$user' order by id DESC LIMIT 1)); ";

		$result=mysqli_query($link,$sql);

		$sql="update sponsor set wallet_sponsor=(SELECT sum(t_diff) from trans_cycle where id_rec='$user' AND t_status='N') where id_sponsor='$user';";
		$result=mysqli_query($link,$sql);
		echo "
			<script  type='text/javascript'>
				alert('Return sucessful!');
				window.location.href = 'payment.php';
			</script>";
		unset($_SESSION['curr_cycle']);


  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Return Cycle</title>
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
				<a href="welcome_renter.php" target="_self" class="button">Back</a>
			</div>
		</div>
		<div id="wrapper">
			<header>
				<h1>Register your cycle</h1>
			</header>
			<div class="form">
				<form id="form_id" method="POST" action="#">
          <p>Cycle Chasis Number: <?php echo $_SESSION['curr_cycle'];?></p>
					<p>Select the booth in which you are Returning:</p>
					<select name="location" id="choices">
						<option value="SJT">SJT</option>
						<option value="TT">TT</option>
						<option value="MB">MB</option>
						<option value="SMV">SMV</option>
					</select>
          <br/><br/><br/><br/><br/>
          <button id="REG_button">Return</button>
      </div>
    </div>
  </div>
</body>
</html>
