<html>
<head>
<title>Deleting Task...!</title>
</head>
<body>
<?php session_start();  ?>
<?php
	$id = (int)$_GET['id'];		
	$connection=mysqli_connect('database-1.cnd6jrd2s2pq.us-east-1.rds.amazonaws.com', 'root', 'koppala123','travel_journey');
	$query="delete from to_do_list where task_id='" . $id . "'";
			
	$del=mysqli_query($connection,$query);
	mysqli_close($connection);
	echo "<script>alert('Task successfully deleted!');
	window.location.href='To-Do-List.php';</script>";
?> 
</body>
</html>