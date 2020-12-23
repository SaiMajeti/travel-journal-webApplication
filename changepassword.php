<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
<title>Change Password</title>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #FF4500;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #D3D3D3;
}
</style>
</head>
<ul>
<li><a href="securehospital.php">Home</a></li>
<li style="float:right"><a href="Hospitallogout.php">Logout</a></li>    
</ul>
<body>
	<fieldset>
		<legend>Change Password</legend>
		<form method="post">
		<dl>
			<dt>
				Old Password
			</dt>
				<dd>
					<input type="password" name="old_pass" placeholder="Old Password..." value="" required />
				</dd>
		</dl>
		<dl>
			<dt>
				New Password
			</dt>
				<dd>
					<input type="password" name="new_pass" placeholder="New Password..." value=""  required />
				</dd>
		</dl>
		<dl>
			<dt>
				Retype New Password
			</dt>
				<dd>
					<input type="password" name="re_pass" placeholder="Retype New Password..." value="" required />
				</dd>
		</dl>
 
		<p align="center">
			<input type="submit" value="Reset Password" name="re_password" />
		</p>
	</form>
	</fieldset>
</body>
</html>
	 <?php 
        
	session_start();
    $hospitalid=$_SESSION['HospitalID'];
		$connection = mysqli_connect('mysqlinstance.cqhnzfhddqpz.us-east-1.rds.amazonaws.com', 'root', 'jashu7774');
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'bloodbank');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}
		if(isset($_POST['re_password']))
		{
		$old_pass=$_POST['old_pass'];
		$new_pass=$_POST['new_pass'];
		$re_pass=$_POST['re_pass'];
		$chg_pwd=("select * from Hospital_Registration where Hospital_id='$hospitalid'");
        $chg_result = mysqli_query($connection, $chg_pwd) or die(mysqli_error($connection));

		$chg_pwd1=mysqli_fetch_array($chg_result);
		$data_pwd=$chg_pwd1['Password'];
		if($data_pwd == $old_pass){
		if($new_pass == $re_pass){
			$update_pwd=("update Hospital_Registration set password='$new_pass' where Hospital_id='$hospitalid'");
            $update_pwd_result = mysqli_query($connection, $update_pwd) or die(mysqli_error($connection));
			echo "<script>alert('Update Sucessfully')</script>";
            echo "<script>location.replace('securehospital.php');</script>";
		}
		else{
			echo "<script>alert('Your new and Retype Password is not match')</script>";
		}
		}
		else
		{
		echo "<script>alert('Your old password is wrong')</script>";
		}}   
	?> 
	<?php
if ($_SESSION['HospitalID']=="") {
	
	{
		header('Location:Hospitallogin.php');
	}
    

}
?>
 
	