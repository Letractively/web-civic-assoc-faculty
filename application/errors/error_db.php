<!DOCTYPE html>
<html lang="en">
<head>
<title>Database Error</title>
<style type="text/css">

::selection{ background-color: #E13300; color: white; }
::moz-selection{ background-color: #E13300; color: white; }
::webkit-selection{ background-color: #E13300; color: white; }

body {
	margin: 75px;
	font-family: Arial;
}

#container {
	background-color: white;
	margin: 25px auto 45px auto;
	padding: 0px 5px 15px 5px;
	border: 4px solid black;
	border-top-right-radius: 50px;
	border-bottom-left-radius: 50px;
	-moz-box-shadow: 5px 5px 20px 10px #2e2e2e;
	-webkit-box-shadow: 5px 5px 20px 10px #2e2e2e;
	box-shadow: 5px 5px 20px 10px #2e2e2e;	
}

h3 {
	height: 55px;
	margin: 0px -5px;
	border-bottom: solid black 4px;
	padding: 18px 5px 0px 25px;
	font-weight: bolder;
	color: darkred;
	border-top-right-radius: 47px;
	-webkit-box-shadow: 5px 5px 20px 5px #2e2e2e;
}

p {
	margin: 15px 15px 15px 25px;
	font-weight: bolder;
}

</style>
</head>
<body>
	<div id="container">
		<h1> <?php echo $heading; ?> </h1>
		<?php echo $message; ?>
	</div>
</body>
</html>