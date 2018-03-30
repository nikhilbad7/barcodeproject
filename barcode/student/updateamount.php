<?php
session_start();
$id=$_SESSION['id'];
$card=$_SESSION['cardno'];
$payid=$_GET['payid'];
$flag=$_GET['flag'];
$duedate=$_GET['due'];
//echo "<script>alert($flag)</script>";
//echo "<script>alert($duedate)</script>";
//echo "<script>alert($payid)</script>";
$c=mysqli_connect('localhost','root','','cashdigi');
$query="select * from std_amount where cardno='$card'";
$rs=mysqli_query($c,$query);
if($rs){
	while($row=mysqli_fetch_array($rs)){
		$currentamount=$row['amount'];

	}
	//echo "<script>alert($currentamount)</script>";
}
$amounttopay=0;
$actualcharge=0;
$dueamount=0;
//mysqli_close($c);

//$connect=mysqli_connect('localhost','root','','cashdigi');

$q= "select
 			*
  	  from
  		 student_charge
  	  where 
  		 (paytype_id ='$payid') AND
  		 (cardno = '$card') AND 
  		 (duedate = '$duedate')";
$rs=mysqli_query($c,$q);
if($rs){
	//echo $rs;
	while($r=mysqli_fetch_array($rs)){
		$actualcharge=$r['amount'];
		$dueamount=$r['dueamount'];

	}

}

if($flag==1){
	
	$amounttopay=$actualcharge+ $dueamount;

	//echo "<script>alert($amounttopay)</script>";
}
else if ($flag==0) {
	$amounttopay=$actualcharge;
	//echo "<script>alert($amounttopay)</script>";

	# code...
}

 if($currentamount > $amounttopay){

 	$currentamount= $currentamount - $amounttopay;
 	$updatequery= " update std_amount set amount=' $currentamount' where cardno='$card'";
 	$res= mysqli_query($c,$updatequery);
 	if($res){
 		$upquery= " update
 				    	student_charge
 				    set  
 				    	status=1 , statustext='paid'
 				    where 
 				    	(cardno='$card') AND ( paytype_id =' $payid') AND  (duedate=' $duedate')";
 		$result= mysqli_query($c,$upquery);
$chargequery= "select
 			*
  	  from
  		 student_charge
  	  where 
  		 (paytype_id ='$payid') AND
  		 (cardno = '$card') AND 
  		 (duedate = '$duedate')";
$rs1=mysqli_query($c,$chargequery);
if($rs1){
	//echo $rs;
	while($rsnew=mysqli_fetch_array($rs1)){
		$charge_id=$rsnew['id'];
		

	}

}

		$currentdate= date('d-M-y');
 		$transactionquery="insert into transaction values('NULL','$card','$charge_id','$amounttopay','$currentdate')";
 		$rs2=mysqli_query($c,$transactionquery);
 		echo "1";
 		//echo "<script>alert('paid SUCCESSFULLY')</script>";
 	}
 	else{
 		echo "0";
 		//echo "<script>alert('error paying')</script>";
 	}
 }
 elseif( $currentamount < $amounttopay){
 	echo "2";
 	//echo "<script>alert(' Sorry , You Dont have sufficient  balance to pay')</script>";
 }

//echo "<script>alert($currentdate)</script>";
//$interval = date_diff($finalduedate, $currentdate);
 //if($interval->format('%a')>0){
//echo "<script>alert('due amount has to be added')</script>";
//}
//else{
//	echo "<script>alert(' NO due')</script>";
//}
/*$q="update student_charge set status='1' where paytype_id='$payid'  and duedate='$duedate'";
$rs=mysqli_query($c,$q);
if($rs){
	echo "SUCCESSFULLY UPDATED";
} */ 
?>