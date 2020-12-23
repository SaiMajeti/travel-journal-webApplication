<html>
<head>
<title>Deleting Diary Entry...!</title>
</head>
<body>
<?php session_start();  ?>
<?php
	$id = (int)$_GET['id'];		
	$cn=mysqli_connect('database-1.cnd6jrd2s2pq.us-east-1.rds.amazonaws.com', 'root', 'koppala123','travel_journey');
	$s="delete from personal_diary where entry_id='" . $id . "'";
			
	$i=mysqli_query($cn,$s);
	mysqli_close($cn);
	echo "<script>alert('Diary Entry successfully deleted!');
	window.location.href='Personal_Diary.php';</script>";
?> 
</body>
</html>