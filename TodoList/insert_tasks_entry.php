<html>
<head>
<style>

</style>
<style>
.welcome {
    margin-top: 5px;
    padding: 5px;
    background-color: #1e90ff;
    border: 2px solid #666;
    width: auto;
    color: #000000;
}
</style>
</head>
<?php include('navbar.html');  ?>
<?php

SESSION_START();
if(isset($_SESSION['Name'])) {
    
}
elseif ($_SESSION['Name']=="") {	
		header('Location: ../user_profile/login.php'); 
}
else{
	echo "Please login to continue...";
}
?>
<body>
<h1 class='display-5 text-center mt-2'>Create a new entry in your To-Do List!</h1>";
<section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row text-white">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                    <div class="px-2">
                        <form action="" method="post" class="justify-content-center" enctype='multipart/form-data'>                           
							<div class="form-group">
                                <label class="sr-only">date</label>
                                <input class="form-control" type="date" name="task_entry_date" required="required" />
                            </div>
							<div class="form-group">
								<label for="exampleFormControlTextarea1"></label>
							<textarea class="form-control" name="task_name" placeholder="Enter your Task..!"  rows="2"></textarea>
							</div>
                            <button type="submit" name="submit" class="btn btn-primary btn-lg">Add Task</button>
											
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
 
<?php
if(isset($_POST["submit"])) 
{
$connection = mysqli_connect('database-1.cnd6jrd2s2pq.us-east-1.rds.amazonaws.com', 'root', 'koppala123','travel_journey');
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
			$sql="insert into to_do_list(user_id,date,task_name) values('" . $_SESSION['user_id'] ."','" . $_POST["task_entry_date"] . "','" . $_POST["task_name"]. "')";
			$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    echo "<script>alert('Task added successfully')</script>";	
}
?>

</body>
</html>