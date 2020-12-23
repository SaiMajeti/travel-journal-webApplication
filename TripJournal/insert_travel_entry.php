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
ini_set('mysql.connect_timeout', 500);
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

<h1 class='display-5 text-center mt-2'>Create a Trip entry</h1>";
<section id="cover" class="min-vh-100">
    <div id="cover-caption">
        <div class="container">
            <div class="row text-white">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">                 
                    <div class="px-2">
                        <form action="" method="post" class="justify-content-center" enctype='multipart/form-data'>
                            <div class="form-group">
                                <label class="sr-only">location_type</label>
                                <input type="text" class="form-control" name="location_type" placeholder="Type of Location: Museum, Beach etc." required="required">
                            </div>
							<div class="form-group">
                                <label class="sr-only">date</label>
                                <input class="form-control" type="date" name="date" required="required" />
                            </div>							
							<div class="form-group">
                                <label class="sr-only">location_name</label>
                                <input type="text" class="form-control" name="location_name" placeholder="Name of the place" required="required">
                            </div>
							<div class="form-group">
                                <label class="sr-only">city</label>
                                <input type="text" class="form-control" name="city" placeholder="City" required="required">
                            </div>
							<div class="form-group">
                                <label class="sr-only">country</label>
                                <input type="text" class="form-control" name="country" placeholder="Country" required="required">
                            </div>
						
							  <input style="display: visible; color:black;" type="file" name="file"/>
							 				
							
							
							<div class="form-group">
								<label for="exampleFormControlTextarea1"></label>
							<textarea class="form-control" name="story" placeholder="Write your story..!"  rows="7"></textarea>
							</div>
                            <button type="submit" name="Submit" class="btn btn-primary btn-lg">Add Trip</button>
							
						
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
if(isset($_POST["Submit"])) 
{
$location_name =  $_POST["location_name"];
$city =  $_POST["city"];
$country =  $_POST["country"];
$location_type =  $_POST["location_type"];

 $name = $_FILES['file']['name'];
  $target_dir = "../upload/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);

  // Select file type
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Valid file extensions
  $extensions_arr = array("jpg","jpeg","png","gif");
  $image ="";

  // Check extension
  if( in_array($imageFileType,$extensions_arr) ){
 
    // Convert to base64 
    $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
    $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
    // Upload file
    move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
  }
  
	$con = mysqli_connect('database-1.cnd6jrd2s2pq.us-east-1.rds.amazonaws.com', 'root', 'koppala123','travel_journey');
		if (!$con){
			die("Database Connection Failed" . mysqli_error($connection));
		}
	$query1="select attraction_id,count(*) from attractions where place_name='" . $location_name . "' and city='" . $city . "' and country='" . $country . "' and location_type='" . $location_type . "'";
			
	$exec=mysqli_query($con,$query1);
	$data=mysqli_fetch_array($exec);
	$count=$data[1];
	
	
	if ($count == 1){
	
	$attraction_id = $data[0];
	
	$sql="insert into  trips(user_id,attraction_id,date,story,photo) values('" . $_SESSION['user_id'] ."','".$attraction_id. "','" . $_POST["date"] . "','" . $_POST["story"] . "','".$image. "')";
	$exec=mysqli_query($con,$sql);
    echo "<script>alert('Trip added successfully')</script>";	
	}
	else{
		$sql="insert into attractions(place_name, city, country, location_type) values('" . $_POST["location_name"] . "','" . $_POST["city"] . "','" . $_POST["country"] . "','" . $_POST["location_type"] . "')";
		$attr=mysqli_query($con,$sql);
		$exec=mysqli_query($con,$query1);
		$data=mysqli_fetch_array($exec);
		$attraction_id = $data[0];
	
		$sql="insert into  trips(user_id,attraction_id,date,story,photo) values('" . $_SESSION['user_id'] ."','".$attraction_id. "','" . $_POST["date"] . "','" . $_POST["story"] . "','".$image. "')";
		$exec=mysqli_query($con,$sql);
		echo "<script>alert('Trip added successfully')</script>";
		
	}
	
}
?>

</body>
</html>
