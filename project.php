<!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>

<?php 
error_reporting(E_ALL);

$querryErr = "";
$querry = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	if(empty($_POST["querry"])) {
	 $querryErr = "Input is required!";
	} else {
	  $querry = test_input($_POST["querry"]);
	  }
}

function test_input($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

$cmd = "sudo python /home/pi/Project/Transmitter.py '" . $querry . "'";

$output = shell_exec($cmd);

 ?> 

<h2>Morse Code Transmitter</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);  ?>">
	Message: <input type="text" name="querry">
	<span class="error">* <?php echo $querryErr;  ?></span>
	<br><br>
	<input type="submit" name="submit" value="Transmit">
</form>

<?php

echo "<h2>Transmission:</h2>";
echo "<pre>$output</pre>";

 ?>

</body>
</html>
