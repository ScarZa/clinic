<?php include 'connection/connect.php';?>
<META content="text/html; charset=utf8" http-equiv=Content-Type>
<?php if($_POST['method']=='transfer'){
    $an=$_POST['an'];
    $hn=$_POST['hn'];
    $tr_date=date("Y-m-d");
    $tr_name=$_SESSION['usermatrix'];
    $ward=$_POST['ward'];
    $clinics=$_POST['clinics'];
    $reason=$_POST['reason'];
    $note=$_POST['note'];
    $doctor=$_POST['doctor'];
    
     $select_reg=  mysqli_query($db, "select * from jvlmatrix_register where hn='$hn' and m_status='3'");
    $regis=  mysqli_fetch_assoc($select_reg);
    $num_reg=  mysqli_num_rows($select_reg);
    if($num_reg >=2){
        echo "	เคยลงทะเบียนไปแล้วครับ ";
        echo "<a href='index.php?page=transfer/transfer'>กลับ</a>";
    }else {
    
    $insert_transfer=  mysqli_query($db,"insert into jvlmatrix_transfer set an='$an',hn='$hn',tr_date='$tr_date',tr_name='$tr_name',
             ward='$ward',clinic='$clinics',reason='$reason',note='$note',doctor='$doctor'");
    if($insert_transfer==false){
				echo "<p>";
				echo "Insert not complete ".mysqli_error($db);
				echo "<br />";
				echo "<br />";
                                echo "	<span class='glyphicon glyphicon-remove'></span>";
				echo "<a href='index.php?page=transfer/transfer'>กลับ</a>";
    
}else{
echo "<meta http-equiv='refresh' content='0;url=index.php?page=transfer/transfer' />";
}}}
?>