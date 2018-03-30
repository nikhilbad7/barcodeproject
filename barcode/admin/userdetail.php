<?php

	include('../config.php');
	
	 /*if (   ($_SESSION['id']== NULL  &&  $_SESSION['salt']==NULL )  || ( $_SESSION['id'] !=  $_SESSION['salt'] )  )
    {
        header('Location:logout.php');
		exit();
    } */
	
	
	///////////////////////////////////////////////////////////
	 //To create dynamic dropdown//
	/////////////////////////////////////////////////////////////
	$c= mysqli_connect('localhost','root','','cashdigi');
	$query1 = "select * from master_usertype";
	$rs = mysqli_query($c,$query1);
	
	if(isset($_POST['userdetailaccept']))
	{
		//$usertypeid = $_POST['usertype'];
		$username = $_POST['username'];
		$userphoneno = "91".$_POST['userphoneno'];
		$useraddress = $_POST['useraddress'];
		$useremailid = $_POST['useremailid'];
		function random_password($num)
		{
			$val="asdfghjkrtyuiopqwbASDFHHGJYUOIUYUTRWQQ@%1322345456657768879765455";
			$userpassword="";
			for($i=1;$i<=$num;$i++)
			{
				$index=rand(0,strlen($val)-1);
				$userpassword=$userpassword.$val[$index];	
			}	
			
			return $userpassword;
			
		}

		$userpassword = random_password(5);
		$query = "insert into user_login values('NULL','$username','$userpassword','$userphoneno','$useraddress','$useremailid');";
		$rs = mysqli_query($c,$query);
		if($rs==1)
		{
			$err="<span style='color:green;'>SUCCESSFULLY INSERTED!!!!</span>";
		}
		else
		{
			$err="<span style='color:red;'>NOT SAVED!!!!</span>";
		}	
	}
	if(isset($_POST['cancel']))
	{
		header('Location:home.php');	
	}


?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>User Detail</title>
<script src="<?php echo JQLIB_PATH_HTML ?>/jquery-1.11.0.js"></script>
<script src="../jsfiles/userdetailjs.js"></script>
</head>

<body>
<noscript>

	<meta http-equiv="refresh" content="0;url=..\javascripterror.php">
    
</noscript>


<style type="text/css">
		body{
			margin: 0px;
		}
		#userdetail{
			position: fixed;
			top: 200px;
			left:500px;
			
		}
	</style>
	<div style="width: 100%;height: 1000px;">

	<div style="background-color: #B22222; width: 100%; height: 100px; position: fixed; top:0px; ">
		<h1 align="center">ADD USER DETAIL</h1>
	</div>
	<div style="background-color: #f9ebae;  width: 100%; height: 800px; position: fixed; top: 100px;">





<?php if ( isset($err) ){  ?>
<div id="msg" style="background-color:#F96; color:#0CF; height:25px; width:100%;" align="center"><?php echo $err;unset($err); ?></div>
<?php } ?>

<form action="" method="post" id="userdetail">
  <table align="center">
   	 <tr>
          <td><label>USER TYPE</label></td>
          <td><select name="usertype" id="usertype">
			  <?php 
                while($row=mysqli_fetch_array($rs))
				 {
               		 echo"<option value=$row[id]>$row[usertype]</option>";
              	 }
              ?>
              </select>
          </td>
    </tr>
    <tr></tr><tr></tr><tr></tr>
    <tr>
      <td><label>USER NAME</label></td>
      <td><input type="text" id="username" name="username" placeholder="NAME" /></td>
    </tr>     <tr></tr><tr></tr><tr></tr>

    <tr>
      <td><label>USER PHONE NO.</label></td>
      <td><input type="text" id="userphoneno" name="userphoneno" placeholder="PHONE NUMBER"/></td>
    </tr>
        <tr></tr><tr></tr><tr></tr>

    <tr>
      <td><label>USER ADDRESS</label></td>
      <td><input type="text" id="useraddress" name="useraddress" placeholder="ADDRESS"/></td>
    </tr>    <tr></tr><tr></tr><tr></tr>

    <tr>
      <td><label>USER EMAIL_ID</label></td>
      <td><input type="text" id="useremailid" name="useremailid" placeholder="EMAIL_ID"/></td>
    </tr>    <tr></tr><tr></tr><tr></tr>

    <tr>
      <td><input type="submit" id="userdetailaccept" name="userdetailaccept"  /></td>
      <td><input type="button" onclick="form.reset(); window.location='home.php'" id="cancel" name="cancel" value="BACK"/></td>
    </tr>     <tr></tr><tr></tr><tr></tr>

  </table>
</form>
</div>
</div>
</body>
</html>