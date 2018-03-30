<?php

	session_start();
	$usercard=$_SESSION["card"] ;
	if(isset($_POST['updateprofile']))
	{
		$c=mysqli_connect('localhost','root','','cashdigi')or die("Connection Problem");			
		$newroll = $_POST['roll'];
		$newname = $_POST['name'];
		$newbranch = $_POST['branch'];
		$newmob = $_POST['mob'];
		$query = "update student_detail set rollno='$newroll',sname='$newname',branch='$newbranch', phno='$newmob' where cardno = '$usercard '";
		$rs = mysqli_query($c,$query);
		
		
		
		if($rs)
		{
			
			echo "<script>alert('successfully updated')</script>";
			header('Location: studenthome.php');
		}
		else
		{
			echo "<script>alert('Something Went Wrong')</script>";
		}
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
</head>

<body>
	<style type="text/css">
		body{
			margin: 0px;
		}
		#updateform{
			position: fixed;
			left:500px;
			top: 200px;
		}
	</style>

	<div>
		<div  style="background-color: #B22222; width: 100%; height: 100px; position: fixed; top: 0px;">
			<div id="top">
			<h1 style="position: fixed; top: 10px;
			left: 50px;">Cash-Digi Student Panel</h1>
			<div id="top-navigation">
				<a href="studenthome.php">Back</a>
				<span>|</span>
				<a href="studenthelp.php">HELP</a>
				<span>|</span>
				<a href="logout.php">Log out</a>
			</div>
		</div>

<h1 align="center" style="position: fixed; top:40px; left: 400px; color: white; font-size: 50px;"> CHANGE YOUR PROFILE  </h1>
</div>
 
  <div style="height: 800px; width: 100%; background-color: #f9ebae; position: fixed; top: 100px;">
  	<form id="updateform" method="post">
  		<b>ROLL NUMBER:</b>&nbsp; &nbsp;&nbsp;<input type="text" placeholder="rollno" name="roll"><br/><br/>
  		<b>NAME :</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="name" placeholder="name"><br/><br/>
  		<b>BRANCH :</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="branch" placeholder="branch"><br/><br/>
  		<b>PHONE NO :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="mob" placeholder="mobile number"><br/><br/>
  		<input type="submit" name="updateprofile" value="UPDATE">
  	</form>
  	
  			</div>
</div>
</body>
</html>