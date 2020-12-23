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
  background-image: url("../images/wave.jpeg");
height:150%;
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
  display:block;
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
  top:5%;
  right:20%;
  margin: 20px;
  width:50%;
  padding: 14px;
  background-color: rgb(204, 226, 226);
}

/* Full-width input fields */
input[type=text], input[type=password],input[type=date] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus,input[type=date]:focus{
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit button */
.btn {
  background-color: rgb(68, 125, 231);
  color: black;

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

<div >
    <div class="container">
    	<div class="topnav">
            <a href="../home.html">Home</a>
          <div> <h3 >TRAVEL JOURNAL</h3></div>
       </div>
   </div>
  <form action="" method="post" class="formcontainer">
    <div><h2 class="header">Create Your Account</h2></div>
    <div class="row">
    <div class="col-25">
      <label for="fname">First Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="fname" name="t1" placeholder="Your name..">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="lname">Last Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="lname" name="t6" placeholder="Your last name..">
    </div>
  </div>
  <div class="row"> 
      <div class="col-25">
      <label for="gender">Gender</label>
      <input type="radio" id="male" name="sex" value="M">
    <label for="male">Male</label>
    <input type="radio" id="female" name="sex" value="F">
    <label for="female">Female</label><br><br>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="email">E-Mail</label>
    </div>
    <div class="col-75">
      <input type="text" id="email" name="t2" placeholder="Your email-id..">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="birthdate">Date Of Birth</label><br>
    </div>
    <div class="col-75">
      <input type="date" id="dob" name="date" placeholder="Your birthdate.."><br>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="password">Enter password</label>
    </div>
    <div class="col-75">
        <input type="password" id="pw" name="t3" placeholder="Your password">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="repeat password">Confirm password</label>
    </div>
    <div class="col-75">
      <input type="password" id="re:pw" name="repeat password" placeholder=" Re-type password" >
    </div>
  </div>
   <div class="row">
    <div class="col-25">
      <label for="address">Address</label>
    </div>
    <div class="col-75">
      <input type="text" id="address" name="t5" placeholder="Enter your address">
    </div>
  </div>

<div class="row">
    <div class="col-25">
      <label for="zipcode">Zipcode</label>
    </div>
    <div class="col-75">
      <input type="text" name="t4" placeholder="Enter your zipcode" >
    </div>
  </div>
  <div class="row">
    <button  type="submit" name="Submit" class="btn"><b>SUBMIT</b></button>
  </div>
  <div class="log">
    <p ><b>Already have an account?</b> <a href="login.php" >Login</a></p>
  </div>
 
  </form>
</div>

<?php
if(isset($_POST["Submit"])) 
{
	echo "inside submit";
$connection = mysqli_connect('database-1.cnd6jrd2s2pq.us-east-1.rds.amazonaws.com', 'root', 'koppala123');
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'travel_journey');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}

$passw = $_POST["t3"];
$hashed_password=md5($passw);
$Email = $_POST["t2"];
$query = "SELECT * FROM users WHERE Email='$Email'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$row = mysqli_fetch_assoc($result);
$count = mysqli_num_rows($result);
if($count == 0)
{
			$sql="insert into users(Fname, Lname, Sex, Email, DOB, Address, Zipcode, Password) values('" . $_POST["t1"] ."','" . $_POST["t6"] . "', '" . $_POST["sex"] . "', '" . $_POST["t2"] . "','" . $_POST["date"] . "','" . $_POST["t5"] . "','" . $_POST["t4"] . "','" . $hashed_password. "')";
			$result = mysqli_query($connection, $sql);
			
   echo "<script>alert('Registered Sucessfully')</script>";
            echo "<script>location.replace('login.php');</script>";
}
else
	echo "<script>alert('Email already exists')</script>";
}
else
	echo "outside if";
?> 

</body>
</html>
