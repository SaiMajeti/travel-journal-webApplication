<html>
<head>
<style>
.card {
        margin: 0 auto; /* Added */
        float: none; /* Added */
        margin-bottom: 10px; /* Added */
}
</style>

<h2>Personal Diary Entries</h2>
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
$query = "SELECT entry_id, date, diary_entry FROM personal_diary where userid=" . $_SESSION["user_id"] . "";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

$rowscount=mysqli_num_rows($result);

echo "<h1 class='display-5 text-center mt-2'>My Daily Journal Entries</h1>";
if($rowscount > 0)
{
while($record = mysqli_fetch_array($result)){

?>

<div class="card mt-4" style="align: center; width: 50rem;">
  <div class="card-body">
    <h5 class="card-title"><i class="fas fa-book"></i></i><?php echo "	$record[2]" ?><h6 class="card-subtitle mb-2 text-right"><?php echo "$record[1]" ?></h6></h5>
    <h6 class="card-subtitle mb-2 text-muted"></h6>
	<a  href=<?php echo 'update_diary_entry.php?id=',$record['entry_id'],''?> class="btn btn-info btn-sm">
	<span class="far fa-edit"></span> Edit
	 </a>
	 <a  href=<?php echo 'delete_diary_entry.php?id=',$record['entry_id'],''?> class="btn btn-danger btn-sm">
	<span class="fas fa-trash-alt"></span> Delete
	</a>	
  </div>
</div>
<?php
}
?>
<div class="col text-center">
      <a  href=<?php echo 'insert_diary_entry.php'?> class="btn btn-info btn-center btn-lg">
	<span class="fas fa-plus"> Add Diary Entry!</span>
	</a>
</div>
<?php
}
else
{
	echo "<h1 class='display-5 text-center mt-4'>No Entries added yet!</h1>";
?>
    <div class="col text-center">
      <a  href=<?php echo 'insert_diary_entry.php'?> class="btn btn-info btn-center btn-lg">
	<span class="fas fa-plus"> Add Diary Entry!</span>
	</a>
    </div>
<?php
}
mysqli_close($connection);
?>

</body>
</html>