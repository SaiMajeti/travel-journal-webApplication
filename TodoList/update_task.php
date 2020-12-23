<html>
<head>
<title>Updating Task Entry..!</title>
</head>
<body>
<?php session_start();  ?>
<?php include('navbar.html');  ?>
<?php
if ($_SESSION['Name']=="") {
    header('Location:../user_profile/login.php');
}
	$id = (int)$_GET['id'];		
	$con=mysqli_connect('database-1.cnd6jrd2s2pq.us-east-1.rds.amazonaws.com', 'root', 'koppala123','travel_journey');
	$select="select * from to_do_list where task_id='" . $id . "'";
			
	$query=mysqli_query($con,$select);
	$rowscount=mysqli_num_rows($query);
	
	$data=mysqli_fetch_array($query);	
	$date = $data[2];
	$task_name = $data[3];
	
?> 

<h1 class='display-5 text-center mt-2'>Update To-Do Task</h1>";
<section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row text-white">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                    <div class="px-2">
                        <form action="" method="post" class="justify-content-center" enctype='multipart/form-data'>                           
							<div class="form-group">
                                <label class="sr-only">date</label>
                                <input class="form-control" type="date" name="date" value="<?php echo @$date;?>" required="required" />
                            </div>
							<div class="form-group">
								<label for="exampleFormControlTextarea1"></label>
							<textarea class="form-control" name="task_name" placeholder="Enter your Task..!"  rows="2"><?php echo @$task_name;?></textarea>
							</div>
                            <button type="submit" name="submit" class="btn btn-primary btn-lg">Update Task</button>
							
						
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

 <?php
	if(isset($_POST["submit"])) {	
		
		$query="update to_do_list set date='" .$_POST["date"]. "', task_name='" .$_POST["task_name"]."' where task_id='" .$id. "'";
		
		$update=mysqli_query($con,$query);
		mysqli_close($con);
		echo "<script>alert('Task successfully updated');
		window.location.href='To-Do-List.php';</script>";
	}
?> 


</body>
</html>