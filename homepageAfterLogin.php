<html>
<head>
<style>

</style>
</head>
<?php include('navbar.html');  ?>
<?php

SESSION_START();
if(isset($_SESSION['Name'])) {
    echo "<nav class='navbar navbar-expand-sm bg-dark navbar-dark'>
	<ul class='navbar-nav'>
    <li class='nav-item active'>
      <a class='nav-link'>Welcome to Online Journal ".$_SESSION['Name']."!</a>
    </li>    
  </ul>
	</nav>";
}
elseif ($_SESSION['Name']=="") {
	header('Location: user_profile/login.php');
}
else{
	echo "Please Login to continue...";
}
?>
<body>

<div class="container">
    <div class="card-deck mt-4 ">
        <div class="card text-center">
            <div class="card-block">
                <h4 class="card-title text-dark">Travel</h4>
                <img class="card-img-top" src="images/travel.jpg" alt="Card image cap">
            </div>
            <a href="TripJournal/insert_travel_entry.php" class="card-footer btn btn-outline-info stretched-link">Add a Travel Post!</a> 
        </div>
		<div class="card text-center">
            <div class="card-block">
                <h4 class="card-title text-dark">Diary</h4>
                <img class="card-img-top" src="images/diary.jpg" alt="Card image cap">				
            </div>
            <a href="PersonalDiary/insert_diary_entry.php" class="card-footer btn btn-outline-info stretched-link">Add a Diary Entry!</a>  
        </div>
		<div class="card text-center">
            <div class="card-block">
                <h4 class="card-title text-dark">To-Do</h4>
                <img class="card-img-top" src="images/todo.jpg" alt="Card image cap">
            </div>
            <a href="TodoList/insert_tasks_entry.php" class="card-footer btn btn-outline-info stretched-link">Add a To-Do Task!</a> 
        </div> 
    </div>    
</div>
</body>
</html>