<html>
<head>
<title>Profile_Update</title>
<style>
</style>
</head>
<body>
<?php session_start();  ?>
<?php include('navbar.html');  ?>

<?php
	if ($_SESSION['Name']=="") {
		header('Location:login.php');
	}	
	$cn=mysqli_connect('database-1.cnd6jrd2s2pq.us-east-1.rds.amazonaws.com', 'root', 'koppala123','travel_journey');
	$s="select * from users where user_id='" . $_SESSION["user_id"] . "'";
			
	$q=mysqli_query($cn,$s);
	$r=mysqli_num_rows($q);
	
	$data=mysqli_fetch_array($q);
	$Password =$data[1];
	$Fname=$data[2];
	$Lname=$data[3];
	$Sex=$data[4];
	$Email=$data[5];
	$DOB=$data[6];
	$Address=$data[7];
	$Zipcode=$data[8];
	//mysqli_close($cn);
?> 
<h1 class='display-5 text-center mt-2'>Update Profile</h1>";
<section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row text-white">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">                 
                    <div class="px-2">
                        <form action="" method="post" class="justify-content-center" enctype='multipart/form-data'>
                            <div class="form-group">
                                <label class="sr-only">First Name</label>
                                <input type="text" class="form-control" name="Fname" value="<?php echo @$Fname;  ?>" required="required">
                            </div>
							<div class="form-group">
                                <label class="sr-only">Last Name</label>
                                <input type="text" class="form-control" name="Lname" value="<?php echo @$Lname;  ?>" required="required">
                            </div>
							<div class="form-group">
                                <label class="sr-only">Gender</label>
                                <input type="text" class="form-control" name="Sex" value="<?php echo @$Sex;  ?>" required="required" placeholder="Gender: M or F">
                            </div>
							<div class="form-group">
                                <label class="sr-only">Email</label>
                                <input type="text" class="form-control" name="Email" value="<?php echo @$Email;  ?>" required="required">
                            </div>

							<div class="form-group">
                                <label class="sr-only">DOB</label>
                                <input class="form-control" type="date" name="date" value="<?php echo @$DOB;  ?>" required="required" />
                            </div>							
							<div class="form-group">
                                <label class="sr-only">Address</label>
                                <input type="text" class="form-control" name="Address" value="<?php echo @$Address;  ?>" required="required">
                            </div>
							<div class="form-group">
                                <label class="sr-only">Zipcode</label>
                                <input type="text" class="form-control" name="Zipcode" value="<?php echo @$Zipcode;  ?>" required="required">
                            </div>
                            <button type="submit" name="Submit" class="btn btn-primary btn-lg">Update</button>
							
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
	if(isset($_POST["Submit"])) 
	{
		$s="update users set Fname='" .$_POST["Fname"]. "' ,Lname='" .$_POST["Lname"]. "' ,Sex='" .$_POST["Sex"]. "' ,Email='" .$_POST["Email"]. "' ,DOB='" .$_POST["date"]. "' ,Address='" .$_POST["Address"]."',Zipcode='" .$_POST["Zipcode"]. "' where user_id='" .$_SESSION["user_id"]. "'";
		
	$i=mysqli_query($cn,$s);
	mysqli_close($cn);
	echo "<script>alert('Profile successfully updated');
  window.location.href='../homepageAfterLogin.php';</script>";
	
}
?> 
</body>
</html>