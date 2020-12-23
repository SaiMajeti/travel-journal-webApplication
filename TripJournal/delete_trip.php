<html>
<head>
<title>Deleting Trip...!</title>
</head>
<body>
<?php session_start();  ?>
<?php
	$id = (int)$_GET['id'];		
	$con=mysqli_connect('database-1.cnd6jrd2s2pq.us-east-1.rds.amazonaws.com', 'root', 'koppala123','travel_journey');
	$query="delete from trips where Trip_id='" . $id . "'";
			
	$execution=mysqli_query($con,$query);
	mysqli_close($con);
	echo "<script>alert('Trip successfully deleted!');
	window.location.href='view_trips.php';</script>";
?> 
</body>
</html>