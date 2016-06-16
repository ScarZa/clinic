<?php include 'connection/connect.php';?>
<META content="text/html; charset=utf8" http-equiv=Content-Type>
<?php 
$re_name=$_SESSION['usermatrix'];
$hn=$_REQUEST['hn'];
$an=$_REQUEST['an'];
$re_transfer=$_POST['re_transfer'];
if($_REQUEST['method']=='submit'){
   $status='Y'; 
}else if($_REQUEST['method']=='cancle'){
   $status='N'; 
}
    
    $update_transfer=  mysqli_query($db,"update jvlmatrix_transfer set re_transfer='$re_transfer',status='$status',re_name='$re_name' where hn='$hn' and an='$an'");
    if($update_transfer==false){
				echo "<p>";
				echo "Insert not complete".mysqli_error($db);
				echo "<br />";
				echo "<br />";
                                echo "	<span class='glyphicon glyphicon-remove'></span>";
				echo "<a href='index.php?page=transfer/detial_transfer'>กลับ</a>";
    
}
if($_REQUEST['method']=='submit'){
echo "<meta http-equiv='refresh' content='0;url=index.php?page=regis/detial&hn=$hn' />";
}else if($_REQUEST['method']=='cancle'){
 echo "<meta http-equiv='refresh' content='0;url=index.php?page=matrix/present' />";   
}
?>