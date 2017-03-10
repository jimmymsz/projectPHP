<?php
	$page = (isset($_GET['username'])? "un" : "pw");
?>

<!DOCTYPE html>
<html>
<head>
	<?php
	if ($page=="un"){
		echo"<title>Recover Username - Forum abc</title>";
	}
	else {
		echo"<title>Recover Password - Forum abc</title>";
	}
	?>
</head>
<body style="background-color: blue">

</body>
</html>