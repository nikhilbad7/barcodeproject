<?php
    
    include('../config.php');
	
/*	 if (   ($_SESSION['id']== NULL  &&  $_SESSION['salt']==NULL )  || ( $_SESSION['id'] !=  $_SESSION['salt'] )  )
    {
        header('Location:logout.php');
		exit();
    }
*/	
	  if(isset($_POST['addpaytype']))
	{
		$c=mysqli_connect('localhost','root','','cashdigi');
		$paytype = strtoupper(trim($_POST['paytype']));
		$paytype = $paytype==''?NULL:$paytype;
		if( trim($paytype) == NULL)
		{
			$err=" PAYTYPE REQUIRED !!!";
			
		}
		elseif(is_numeric($paytype))
		{
				$err="ONLY ALPHABET!!!!!!";
		}
		else
		{
			$query = "insert into pay_types values(NULL,'$paytype')";
			$rs = mysqli_query($query);
			if($rs==1)
			{
				$err="<span style='color:green;'>SUCCESSFULLY INSERTED!!!!</span>";
			}
			else
			{
					$err="<span style='color:red;'>Already Created!!!!</span>";
			}
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
		#paytype{
			position: fixed;
			top: 200px;
			left:600px;
		}
	</style>
	<div style="width: 100%;height: 1000px;">

	<div style="background-color: #B22222; width: 100%; height: 100px; position: fixed; top:0px; ">
		<h1 align="center">ADD PAY TYPE</h1>
	</div>
	<div style="background-color: #f9ebae;  width: 100%; height: 800px; position: fixed; top: 100px;">


 <?php if ( isset($err) ){  ?>   
 <div id="msg" style="background-color:#F96; color:#0CF; height:25px; width:100%;" align="center"><?php echo $err;unset($err); ?></div>
  <?php } ?> <h4 style="position: fixed; top:180px; left:500px;">PAY TYPE</h4>
 <form id="paytype" method="post" action="">
<table align="center">
<tr>
	<td>PAY TYPE</td>
    <td ><input type="text" id="paytype" name="paytype" /></td>
</tr>
<tr></tr><tr></tr><tr></tr><tr></tr>
<tr>
	<td><input type="submit" id="addpaytype" name="addpaytype" /></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
    <td><input type="button" id="back" onclick="form.reset(); window.location='home.php'" value="BACK" /></td>
</tr>
</table>
</form>
</div>
</div>
</body>
</html>