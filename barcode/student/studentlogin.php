<?php

	session_start();
	if(isset($_POST['studentcode']))
	{
		$_SESSION["card"] = $_POST['studentcode'];
		$c=mysqli_connect('localhost','root','','cashdigi')or die("Connection Problem");			
		$studentcode = $_POST['studentcode'];
		$query = "select * from student_detail where cardno = '$studentcode'";
		$rs = mysqli_query($c,$query);
		
		if($row=mysqli_fetch_array($rs))
		{
			$_SESSION['number']=$row['phno'];
		}
		
		if(mysqli_num_rows($rs))
		{
			
			$_SESSION['salt'] = session_id().time().$_SERVER['REMOTE_ADDR'] ; //to make unique
			$_SESSION['id']=$_SESSION['salt'];
			$_SESSION['cardno'] = $studentcode;
			header("Location:studenthome.php");
			exit();	
		}
		else
		{
			$err="Invalid Student Code !!! ";
		}
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
	<style type="text/css">
		body{
			margin: 0px;
		}
		#studentcode{
			position: fixed;
			left:600px;
		}
	</style>

	<div>
		<div  style="background-color: #B22222; width: 100%; height: 100px; position: fixed; top: 0px;">
<h1 align="center"> STUDENT LOGIN </h1>
</div>
 
 <?php if ( isset($err) ){  ?>   
 <div id="msg" style="background-color:#F96; color:#0CF; height:25px; width:100%;" align="center"><?php echo $err;unset($err); ?></div>
  <?php } ?> 
  <div style="height: 800px; width: 100%; background-color: #f9ebae; position: fixed; top: 100px;">
  	<p style="position: fixed; top:240px; left: 450px;"> <b>SCAN HERE :</b> </p>

<form action="" method="post" id="studentlogin" style="margin-top:150px">
<table width="300px"  align="center">
	<tr>
		<td><input type="text" name="studentcode" id="studentcode" placeholder="SCAN YOUR ID" /></td>
    </tr>
</table>
</form>
</div>
</div>
</body>
</html>