<?php include 'connection/connect.php';?>
<META content="text/html; charset=utf8" http-equiv=Content-Type>
<?php 

    $hn=$_REQUEST['hn'];
    $an=$_REQUEST['an'];
    $m_type=$_POST['m_type'];
    $regdate=$_POST['regdate'];
    $m_status=$_POST['m_status'];
    $note=$_POST['note'];
    $doctor=$_SESSION['usermatrix'];
    $address=$_POST['address'];
    $tell1=$_POST['tell1'];
    $tell2=$_POST['tell2'];
    $tell3=$_POST['tell3'];
    $person1=$_POST['person1'];
    $person2=$_POST['person2'];
    $person3=$_POST['person3'];
    $clinic='006';
    $lastupdate=  date("Y-m-d H:m:s");
    $status='Y';
    $process=$_POST['process'];
    
    $select_reg=  mysqli_query($db, "select * from jvlmatrix_register where hn='$hn' and m_status='3'");
    $regis=  mysqli_fetch_assoc($select_reg);
    $num_reg=  mysqli_num_rows($select_reg);
    if($num_reg >=2){
        echo "	เคยลงทะเบียนไปแล้วครับ ";
        echo "<a href='index.php?page=regis/detial&hn=$hn&method=$process' >กลับ</a>";
    }elseif ($regis['m_type']==$m_type) {
        echo "	เคยลงทะเบียนการบำบัดประเภทนี้ไปแล้วครับ ";
        echo "<a href='index.php?page=regis/detial&hn=$hn&method=$process' >กลับ</a>";
}  else {
    
    $insert=  mysqli_query($db,"insert into jvlmatrix_register set 
        hn='$hn',doctor='$doctor',m_type='$m_type',regdate='$regdate',m_status='$m_status',note='$note',address='$address',
           tell1='$tell1',tell2='$tell2',tell3='$tell3',person1='$person1',person2='$person2',person3='$person3',process='$process' ");
    if ($insert == false) {
            echo "<p>";
            echo "Insert not complete" . mysqli_error($db);
            echo "<br />";
            echo "<br />";

            echo "	<span class='glyphicon glyphicon-remove'></span>";
            echo "<a href='index.php?page=regis/detial&hn=$hn&method=$process' >กลับ</a>";
        } else {
    $serial=mysqli_query($db,"SELECT serial_no as id, 
(SELECT serial_no FROM serial WHERE `name`='clinic-member-number-006')number
FROM serial WHERE `name`='clinicmember_id'");
    $Serial=  mysqli_fetch_assoc($serial);
    $id=$Serial['id']+1;
    $number=$Serial['number']+1;
    $insert_clinic=  mysqli_query($db,"insert into clinicmember set clinicmember_id='$id', hn='$hn',doctor='$doctor',regdate='$regdate',clinic='$clinic',"
            . "clinic_member_status_id='$m_status',number='$number',lastupdate='$lastupdate'");
    $update_serial1=mysqli_query($db,"update serial set serial_no='$id' where `name`='clinicmember_id'");
    $update_serial2=mysqli_query($db,"update serial set serial_no='$number' where `name`='clinic-member-number-006'");
    
    $db->close();
    echo "<meta http-equiv='refresh' content='0;url=index.php?page=matrix/present' />";
        }
}