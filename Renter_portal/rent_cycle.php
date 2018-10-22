<?php
	session_start();
	include('../config.php');
  if(isset($_SESSION['curr_cycle']))
  {
    $error2="RETURN CYCLE FIRST";
    echo "
      <script  type='text/javascript'>
        alert('You must Return Cycle first to rent again!');
        window.location.href = 'welcome_renter.php';
      </script>";
  }
	$user=$_SESSION["login_user"];
	$sql="select * from cycle_list where available='A';";
	$result=mysqli_query($link,$sql);
	$count=mysqli_num_rows($result);
	if($count==0)
	{
		$error="No cycles available!";
	}
  if(isset($_POST['button']))
  {
    $INP=$_POST['button'];
    $para=explode(" ",$INP);
    $sql="update cycle_list set available='$para[0]' where Chasis_no='$para[1]';";
    $result=mysqli_query($link,$sql);
    $timestamp=date("Y-m-d H:i:s");
    $sql="select reg_no from cycle_list where Chasis_no='$para[1]';";
    $result=mysqli_query($link,$sql);
    $row=mysqli_fetch_assoc($result);
    $reg=mysqli_real_escape_string($link,$row['reg_no']);
    $sql="insert into cycle_rec(chasis_no,sponsor_reg,renter_reg,start_Time,ret_status) values('$para[1]','$reg','$user',now(),'N');";
    echo $sql;
    $result=mysqli_query($link,$sql);
    $_SESSION['curr_cycle']=$para[1];
    header("location: welcome_renter.php");
  }


?>
<!DOCTYPE html>
<html>
  <head>
    <title>Rent A Cycle</title>
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
  				<a href="welcome_renter.php" target="_self" class="button">Back</a>
  			</div>
  		</div>
  		<div id="wrapper">
  			<header>
  				<h1>See available cycles near you!</h1>
  			</header>
  			<div>
          <p>At fixed Rate of 0.01₹/Sec</p>
  				<table>
  					<tr>
  						<th>Chasis-No</th>
  						<th>Location</th>
  						<th>Brand</th>
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
  									<form method="POST">
  									<td><button id="REG_button" type="submit" name="button" value="R <?php echo $row['Chasis_no']?>">RENT</button>
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
  						echo $error."<br/>";
  					}
            if(isset($error2))
            {
              echo $error2;

            }
  				?>
  			</div>
  		</div>
  </body>
</html>
