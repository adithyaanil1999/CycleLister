<?php
  session_start();
	include('../config.php');
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
    $old_pass=md5($_POST['old_pass']);
    $new_pass=md5($_POST['new_pass']);
    $sql="select reg_r from r_login where password='$old_pass';";
    $result=mysqli_query($link,$sql);
  	$count=mysqli_num_rows($result);

		if($count==1)
		{
			$sql="Update s_login set password='$new_pass' where password='$old_pass'";
      $result=mysqli_query($link,$sql);
			header("location:welcome_sponsor.php");
    }
    else
    {
      $error="The password is wrong";
    }

  }
  mysqli_close($link);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Change Password</title>
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
        <h1>Change Password</h1>
      </header>
      <div class="form">
        <form id="form_id" method="POST" action="#">
          <p>Enter Current Password:</p>
          <input type="password" name="old_pass" id="old_pass" placeholder="Old Password" class="reg-field"/>
          <p>Enter New Password:</p>
          <input type="password" name="new_pass" id="new_pass"placeholder="New Password" class="reg-field" onkeydown="check()"/>
          <input type="checkbox" onclick="myFunction()">Show Password
          <button id="REG_button">Change</button>
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
  					var old_pass=document.getElementById('form_id').old_pass.value;
  					var new_pass=document.getElementById('form_id').new_pass.value;
  					if(old_pass==""||new_pass=="")
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
          function myFunction() {
            var x = document.getElementById("new_pass");
            if (x.type === "password") {
              x.type = "text";
            } else {
              x.type = "password";
            }
          }
          </script>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
