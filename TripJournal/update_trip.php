
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Updating Trip..!</title>
  <style>

</style>
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
	$query="select * from trips where Trip_id='" . $id . "'";
			
	$exec=mysqli_query($con,$query);
	$count=mysqli_num_rows($exec);
	
	$data=mysqli_fetch_array($exec);
	$attraction_id = $data[2];
	$date = $data[3];
	$story = $data[4];
	$query2="select * from attractions where attraction_id= '".$attraction_id. "' ";		
	$exec2=mysqli_query($con,$query2);
	$attr=mysqli_fetch_array($exec2);
	$location_name=$attr[1];
	$city=$attr[2];
	$country=$attr[3];
	$location_type=$attr[4];
	
?> 
<h1 class='display-5 text-center mt-2'>Update Trip</h1>";
<section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row text-white">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">                
                    <div class="px-2">
                        <form action="" method="post" class="justify-content-center" enctype='multipart/form-data'>
                            <div class="form-group">
                                <label class="sr-only">location_type</label>
                                <input type="text" class="form-control" name="location_type" value="<?php echo @$location_type;  ?>" placeholder="Type of Location: Museum, Beach etc." required="required">
                            </div>
							<div class="form-group">
                                <label class="sr-only">date</label>
                                <input class="form-control" type="date" name="date" value="<?php echo @$date;?>" required="required" />
                            </div>							
							<div class="form-group">
                                <label class="sr-only">location_name</label>
                                <input type="text" class="form-control" name="location_name" value="<?php echo @$location_name;?>" required="required">
                            </div>
							<div class="form-group">
                                <label class="sr-only">city</label>
                                <input type="text" class="form-control" name="city" value="<?php echo @$city;?>"required="required">
                            </div>
							<div class="form-group">
                                <label class="sr-only">country</label>
                                <input type="text" class="form-control" name="country" value="<?php echo @$country;?>" required="required">
                            </div>
							
							<div class="form-group">
								<label for="exampleFormControlTextarea1"></label>
							<textarea class="form-control" name="story"><?php echo @$story;?></textarea>
							</div>
                            <button type="submit" name="submit" class="btn btn-primary btn-lg">Update Trip</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
 
 <?php
	if(isset($_POST["submit"])) {
		
		$query1="update trips set date='" .$_POST["date"]. "',story='" .$_POST["story"]."' where Trip_id='" .$id. "'";
		
		$exec=mysqli_query($con,$query1);
		
		$query2="update attractions set location_type='" .$_POST["location_type"]. "' ,city='" .$_POST["city"]."' ,country='" .$_POST["country"]. "' ,place_name='" .$_POST["location_name"]. "' where attraction_id='" .$attraction_id. "'";
		
		$exec=mysqli_query($con,$query2);
		mysqli_close($con);
		echo "<script>alert('Trip successfully updated');
		window.location.href='view_trips.php';</script>";
	}
?> 


</body>
</html>