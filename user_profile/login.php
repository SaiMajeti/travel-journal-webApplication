<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body, html {
  height: 100%;
  font-family: Arial, Helvetica, sans-serif;
}

* {
  box-sizing: border-box;
}

.bg-img {
  /* The image used */
  background-image: url("family.jpeg");

  height: 100%;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}
.container {
  position: absolute;
  text-align:center;
  color:white;
  width:100%;
}
/* The navbar */
.topnav {
  overflow: hidden;
  background-color: #333;
}

/* Navbar links */
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Add styles to the form container */
.formcontainer {
  position: absolute;
  top:25%;
  right: 40%;
  margin: 20px;
  max-width: 300px;
  padding: 16px;
  background-color: rgb(238, 213, 213);
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit button */
.btn {
  background-color:rgb(160, 18, 65) ;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.btn:hover {
  opacity: 1;
}

</style>
</head>

<body>
<div class="bg-img">
    <div class="container">
    	<div class="topnav">
            <a href="../home.html">Home</a>
            <div> <h3 >TRAVEL JOURNAL</h3></div>
         </div>
         
   </div>
  <form  method="post" class="formcontainer">
    <h1>Login</h1>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="Email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button type="submit" class="btn">Login</button>
    <div class="Registration-help">
        <p>Not Yet Registered? <a href=Registration1.php>Click here to Register</a>.</p>
      </div>
      </div>
  </form>
</div>
</body>
</html>

<?php

SESSION_START();
$connection = mysqli_connect('database-1.cnd6jrd2s2pq.us-east-1.rds.amazonaws.com', 'root', 'koppala123');
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
	echo "Database Connection Failed";
}
$select_db = mysqli_select_db($connection, 'travel_journey');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}

if (isset($_POST['Email']) and isset($_POST['password'])){
	
// Assigning POST values to variables.
$Email = $_POST['Email'];
$password = $_POST['password'];
$hashed_password = md5($password);
// CHECK FOR THE RECORD FROM TABLE

$query = "SELECT * FROM users WHERE Email='$Email' and password='$hashed_password'";
 
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$row = mysqli_fetch_assoc($result);
$count = mysqli_num_rows($result);
     

if ($count == 1){
    
    $_SESSION['Name'] = $row["Fname"];
    $_SESSION['user_id'] = $row["user_id"];
 echo "<script>location.replace('../homepageAfterLogin.php');</script>";


}
else{
echo "<script type='text/javascript'>alert('Invalid Login Credentials')</script>";

}
}
?>
