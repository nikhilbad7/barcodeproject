<?php


	include('../config.php');
	session_start();
	
    if (   ($_SESSION['id']== NULL  &&  $_SESSION['salt']==NULL )  ||  ($_SESSION['id'] !=  $_SESSION['salt'])  )
    {
        header('Location:logout.php');
		exit();
    }
	
	$c=mysqli_connect('localhost','root','','cashdigi');
	$charge = "select * from student_charge where cardno =".$_SESSION['cardno'];
	
	$detail = "select * from student_detail where cardno =".$_SESSION['cardno'];
	$studentcharge = mysqli_query($c,$charge);
	$studentdetail =  mysqli_query($c,$detail);
	$queryname="select sname from student_detail where cardno =".$_SESSION['cardno'];
	$studentname =  mysqli_query($c,$queryname);
	while($name=mysqli_fetch_assoc($studentname))
		{
	$username=$name['sname'];
}
?>
<script src="<?php echo JQLIB_PATH_HTML?>jquery-1.11.0.js"></script>
<script src="../jqlib/jquery-1.9.1.js"></script>
<script type="text/javascript" src="../jsfiles/studenthomejs.js"></script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Free CSS template by ChocoTemplates.com</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
</head>
<body>

<noscript>

	<meta http-equiv="refresh" content="0;url=..\javascripterror.php">
    
</noscript>

<!-- Header -->
<div id="header">
	<div class="shell">
		<!-- Logo + Top Nav -->
		<div id="top">
			<h1><a href="#">Cash-Digi Student Panel</a></h1>
			<div id="top-navigation">
				Welcome <?php echo $username ?>
				<span>|</span>
				<a href="studenthelp.php">Help</a>
				<span>|</span>
				<a href="profile_update.php">Profile Settings</a>
				<span>|</span>
				<a href="logout.php">Log out</a>
			</div>
		</div>
		<!-- End Logo + Top Nav -->
		
		<!-- Main Nav -->
		<div id="navigation">
			<ul>
			    <!--<li><a href="home.php" class="active"><span>Dashboard</span></a></li>
			    <li><a href="insertbarcode.php"><span>Insert Barcode</span></a></li>
			    <li><a href="insertstudentdetail.php"><span>Issue Card</span></a></li>
			    <li><a href="recharge.php"><span>Recharge Card</span></a></li>
			    <li><a href="userdetail.php"><span>Products</span></a></li>
			    <li><a href="addusertype.php"><span>Add UserType</span></a></li>
                <li><a href="insertcharge.php"><span>Insert Charge</span></a></li>-->
			</ul>
		</div>
		<!-- End Main Nav -->
	</div>
</div>
<!-- End Header -->


<table border="1" width="100%">
<tr>
	<td align="center" colspan="7">STUDENT DETAIL</td>
</tr>
<tr>
	<td align="center">CARD NUMBER</td>
    <td align="center">ROLL NUMBER</td>
    <td align="center">NAME</td>
    <td align="center">YEAR OF ADMISSION</td>
    <td align="center">BRANCH</td>
    <td align="center">CONTACT NUMBER</td>
    <td align="center">IMAGE</td>
</tr>
<?php 
	if(mysqli_num_rows($studentdetail))
	{
		
	    while($r=mysqli_fetch_assoc($studentdetail))
		{
			
			
			
			?>
             <tr>
               <td align="center"><?php echo $r['cardno']?></td>
               <td align="center"><?php echo $r['rollno']?></td>
               <td align="center"><?php echo $r['sname']?></td>
               <td align="center"><?php echo $r['year']?></td>
               <td align="center"><?php echo $r['branch']?></td>
               <td align="center"><?php echo $r['phno']?></td>
               <td align="center"><img src="../admin/studentimage/<?php echo $r['studentimage']?>" style="height:100px; width:100px;"></td>
            </tr>
       	    <?php
		 } 
	}
?>
</table>
<br/><br/><br/>
<hr color="lightgray" /><br/><br/><br/>
<table border="1" width="100%">
<tr>
	<td colspan="5" align="center">CHARGE DETAILS<td>
</tr>
<tr>
	<td align="center">TYPE OF CHARGE</td>
    <td align="center">DUEDATE</td>
    <td align="center">AFTER DUEDATE CHARGE</td>
    <td align="center">TOTAL CHARGE</td>
    <td align="center">STATUS</td>
    <td align="center">PAY</td>
</tr>



<?php 
//$statusquery=" select * from student_charge where (paytype_id='$pid') AND (cardno=".$_SESSION['cardno'].") AND ( duedate = '')";
	function getpayname($id)
	{
		$c=mysqli_connect('localhost','root','','cashdigi');
		$typequery = "select types from pay_types where id = '$id' ";
		$paytype=mysqli_query($c,$typequery);
		if($paytype){
		while($arr=mysqli_fetch_array($paytype)){
			$ptype=$arr['types'];
		}
	    return $ptype;
		}
		
	}
	
	if(mysqli_num_rows($studentcharge))
	{
	
	    while($r=mysqli_fetch_assoc($studentcharge))
		{
			/*if($r['status']==0){
			$status="unpaid";
		} */

			$pid=$r['paytype_id'];
			//$duedate="select DATE(duedate) from student_charge where cardno=".$_SESSION['cardno']."and paytype_id=".$pid;
			//$dueresult= mysqli_query($c,$duedate);
  			//if($dueresult){
  				//$dd=$r['duedate'];
  			//}

			
			//echo "<script>alert($dd)</script>";
			//echo "<script>alert($pid)</script>";
			

			?>
             <tr>
               <td align="center"><?php echo getpayname( $r['paytype_id'])?>
                 </td>
               <td align="center" class='date'><?php echo $r['duedate']?></td>
               <td align="center"><?php echo $r['dueamount']?></td>
               <td align="center"><?php echo $r['amount']?></td>
               <td align="center" class='stat'><?php echo $r['statustext'] ?></td>
               <td align="center"><?php $numm=$_SESSION['number']; echo "<input type='button' class='pay' onclick='update(this,$pid,$dd)'  id=$numm value='Pay'"; ?> /></td>
           
            </tr>
       	    <?php
		 } 
	}
	
?>

</table>
<script>
	function update(N,p,d){
		var duedate = $(N).closest('tr').find('.date').text();
		var statustextpay= $(N).closest('tr').find('.stat').text();
		if(statustextpay=="paid"){
			alert("already paid");
			exit();
		}
		
		//alert(' paytype is'+p);
var flag= 1;

var today= new Date();

var date=duedate;
var arr=date.split("-");
var someotherday= new Date(arr[0],(arr[1]-1),arr[2]);
if(today > someotherday){
 flag=1;
}
else if(someotherday> today){
flag=0;
}

		
		var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    		var statusstring=this.responseText;
    		var status= parseInt(statusstring);
    		
    		if(status==1){
    			alert("successfully paid");
    			var id=$(N).attr('id');
				//alert(id);
			/*$.post('sms.php',{id:id},function(data){
					alert(data);
					window.location='studenthome.php'
					alert("SMS Sent to "+id);
					
					
			}); */
    			//$status="paid";
    			//$(N).closest('tr').find('.stat').val('paid');
    			location.reload();
    		    }
    		    else if(status==0){
    			alert("error  paying");
    			//$status="paid";
    			//$(N).closest('tr').find('.stat').val('paid');
    			location.reload();
    		    }
    		    else if(status==2){
    			alert("Sorry , You Dont have sufficient  balance to pay");
    			//$status="paid";
    			//$(N).closest('tr').find('.stat').val('paid');
    			location.reload();
    		    }
    		}
      };
  xhttp.open("GET", "updateamount.php?payid="+p+"&flag="+flag+"&due="+duedate, true);
  xhttp.send();  
		}  	
/*$(document).ready(function(){
	$('.pay').click(function(){
		
	var id=$(this).attr('id');
	alert(id);
			$.post('sms.php',{id:id},function(data){
					alert(data);
					window.location='studenthome.php'
					alert("SMS Sent to "+id);
					
					
			});
	});

}); */
</script>
<!-- Footer -->
<!-- End Footer -->
	
</body>
</html>