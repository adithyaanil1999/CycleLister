<?php
	session_start();
	if(session_destroy())
	{
		header("Refresh: 3; url=index.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Logging out</title>
	<link rel="stylesheet" type="text/css" href="css/animate.css"/>
	<link rel="icon" href="/DBMS/favicon.jpg">
	<style type="text/css"></style>
</head>
<body>
	<div id=text>
		<h1>Logging out!</h1>
		<h2>Wait 3 Seconds!</h2>
	</div>
	<div id="animation">
		<div class="lds-default"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
	</div>
</body>
</html>
