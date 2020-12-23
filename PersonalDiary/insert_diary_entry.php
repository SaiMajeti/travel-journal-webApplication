<html>
<head>

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
	{
		header('Location: ../user_profile/login.php');
	}
}
else{
	echo "please login";
}
?>

<body>
<h1 class='display-5 text-center mt-2'>Create a new entry in your Personal Diary!</h1>";
<section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row text-white">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                    <div class="px-2">
                        <form action="" method="post" class="justify-content-center" enctype='multipart/form-data'>                           
							<div class="form-group">
                                <label class="sr-only">date</label>
                                <input class="form-control" type="date" name="diary_entry_date" required="required" />
                            </div>
							<div class="form-group">
								<label for="exampleFormControlTextarea1"></label>
							<textarea class="form-control" name="diary_entry_story" placeholder="Enter your Diary notes..!"  rows="5"></textarea>
							</div>
                            <button type="submit" name="Submit" class="btn btn-primary btn-lg">Add Task</button>
											
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
if(isset($_POST["Submit"])) 
{
$connection = mysqli_connect('database-1.cnd6jrd2s2pq.us-east-1.rds.amazonaws.com', 'root', 'koppala123','travel_journey');
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'travel_journey');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}
			$sql="insert into  personal_diary(userid,date,diary_entry) values('" . $_SESSION['user_id'] ."','" . $_POST["diary_entry_date"] . "','" . $_POST["diary_entry_story"]. "')";
			$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    echo "<script>alert('Diary entry added successfully')</script>";
	
}
?>

</body>
</html>
