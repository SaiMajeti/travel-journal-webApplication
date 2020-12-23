<html>
<head>
<style>
.card {
        margin: 0 auto; /* Added */
        float: none; /* Added */
        margin-bottom: 10px; /* Added */
}
</style>
</head>
<script src="https://kit.fontawesome.com/ad3c8f1f60.js" crossorigin="anonymous"></script>
<body>
<?php include('navbar.html');  ?>
<?php
SESSION_START();
if ($_SESSION['Name']=="") {
    header('Location:../user_profile/login.php');
}
$connection = mysqli_connect('database-1.cnd6jrd2s2pq.us-east-1.rds.amazonaws.com', 'root', 'koppala123','travel_journey');
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$query = "SELECT trip_id,attraction_id,date,story,photo FROM trips where user_id=" . $_SESSION["user_id"] . "";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$rowscount=mysqli_num_rows($result);

if($rowscount > 0)
{
?>
<h1 class='display-4 text-secondary text-center'>Travel Journal Entries</h1>
<div class="col text-center">
      <a  href=<?php echo 'insert_travel_entry.php'?> class="btn btn-info btn-center btn-lg">
	<span class="fas fa-plus"> Add Trip!</span>
	</a>
</div> 
<?php
while($record = mysqli_fetch_array($result))
{
$attraction_id = $record[1];
$query2 = "SELECT place_name,city,country,location_type FROM attractions where attraction_id= '".$attraction_id. "' ";
$exec=mysqli_query($connection,$query2);
$data=mysqli_fetch_array($exec);
?>

<div class="card mt-4" style="align: center; width: 50rem;">
  <div class="card-body">
    <h5 class="card-title">Trip to <?php echo "$data[1], $data[2]." ?></h5>
    <h6 class="card-subtitle mb-2 text-muted"><?php echo "$data[3]: $data[0]." ?></h6>
	<img class="card-img-top border" src="<?php echo "$record[photo]"?>">
	<p></p>
	<h6 class="card-subtitle mb-2 text-muted"><?php echo "$record[2]" ?></h6>
    <p class="card-text"><?php echo "$record[3]." ?></p>
    <a  href=<?php echo 'update_trip.php?id=',$record['trip_id'],''?> class="btn btn-info btn-lg">
	<span class="far fa-edit"></span> Edit
	 </a>
	 <a  href=<?php echo 'delete_trip.php?id=',$record['trip_id'],''?> class="btn btn-danger btn-lg">
	<span class="fas fa-trash-alt"></span> Delete
	</a>
  </div>
</div>

<?php
}
}
else
{
	echo "<h1 class='display-5 text-center mt-4'>No Trips added yet!</h1>";
?>
    <div class="col text-center">
      <a  href=<?php echo 'insert_travel_entry.php'?> class="btn btn-info btn-center btn-lg">
	<span class="fas fa-plus"> Add Trip!</span>
	</a>
    </div>
<?php
}
mysqli_close($connection);
?>
</body>
</html>