<?php
  session_start();
	include('../config.php');
	$user=$_SESSION["login_user"];
  $amount=$_SESSION['amount'];
  $sql="update trans_cycle set t_status='W' where id_rec='$user' and t_status='N';";
  $result=mysqli_query($link,$sql);
  $sql="update sponsor set wallet_sponsor=0 where id_sponsor='$user';";
  $result=mysqli_query($link,$sql);
  if($_SERVER["REQUEST_METHOD"]=="POST")
	{
    echo "
      <script  type='text/javascript'>
        alert('Money Withdrawn!');
        window.location.href = 'welcome_sponsor.php';
      </script>";
  }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Withdraw</title>
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
				<h1>Withdraw the amount?</h1>
			</header>
			<div>
				<p class="error">Amount: <?php echo $amount; ?></p>
			</div>
			<div class="form">
				<form id="form_id" method="POST">
            <br/><br/><br/><br/><br/><br/>
            <button id="REG_button">Withdraw</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
