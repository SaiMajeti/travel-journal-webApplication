<html>
<head>
<title>Updating Diary Entry..!</title>
</head>
<body>

<?php session_start();  ?>
<?php include('navbar.html');  ?>
<?php
if ($_SESSION['Name']=="") {
    header('Location: ../user_profile/login.php');
}
	$id = (int)$_GET['id'];		
	$con=mysqli_connect('database-1.cnd6jrd2s2pq.us-east-1.rds.amazonaws.com', 'root', 'koppala123','travel_journey');
	$selectq="select * from personal_diary where entry_id='" . $id . "'";			
	$query=mysqli_query($con,$selectq);
	
	$data=mysqli_fetch_array($query);	
	$date = $data[1];
	$diary_entry = $data[2];
	
?>	
<h1 class='display-5 text-center mt-2'>Update entry in your Personal Diary!</h1>";
<section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row text-white">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">                 
                    <div class="px-2">
                        <form action="" method="post" class="justify-content-center" enctype='multipart/form-data'>                           
							<div class="form-group">
                                <label class="sr-only">date</label>
                                <input class="form-control" value="<?php echo @$date;?>" type="date" name="date" required="required" />
                            </div>
							<div class="form-group">
								<label for="exampleFormControlTextarea1"></label>
							<textarea class="form-control" name="diary_entry" placeholder="Enter your Diary notes..!"  rows="5"><?php echo @$diary_entry;?></textarea>
							</div>
                            <button type="submit" name="submit" class="btn btn-primary btn-lg">Update</button>
											
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
 
 <?php
	if(isset($_POST["submit"])) {	
		
		$query2="update personal_diary set date='" .$_POST["date"]. "', diary_entry='" .$_POST["diary_entry"]."' where entry_id='" .$id. "'";
		
		$select=mysqli_query($con,$query2);
		mysqli_close($con);
		echo "<script>alert('Diary Entry successfully updated');
		window.location.href='Personal_Diary.php';</script>";
	}
?> 
</body>
</html>