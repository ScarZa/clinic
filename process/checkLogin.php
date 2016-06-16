<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ระบบข้อมูลบุคคลากรโรงพยาบาล</title>
    <LINK REL="SHORTCUT ICON" HREF="images/logo.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="../plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script language="JavaScript" type="text/javascript"> 
var StayAlive = 1; // เวลาเป็นวินาทีที่ต้องการให้ WIndows เปิดออก 
function KillMe()
{ 
setTimeout("self.close()",StayAlive * 1000); 
} 
</script>
  </head>
  <body class="hold-transition skin-green fixed sidebar-mini" onLoad="KillMe();self.focus();window.opener.location.reload();">
      <section class="content">
<?php
include '../connection/connect.php';
$user_account = trim($_POST['user_account']);
$user_pwd = md5(trim($_POST['user_pwd']));
echo	 "<p>&nbsp;</p>	"; 
echo	 "<p>&nbsp;</p>	";
echo "<div class='bs-example'>
	  <div class='progress progress-striped active'>
	  <div class='progress-bar' style='width: 100%'></div>
</div>";
echo "<div class='alert alert-dismissable alert-success'>
	  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
	  <a class='alert-link' target='_blank' href='#'><center>กำลังดำเนินการ</center></a> 
</div>";

$sql = $db->prepare("select u.doctorcode as doctorcode,u.clinic as clinic,u.status_user as status_user,o.name as name 
    from jvlmatrix_user u 
INNER JOIN opduser o on o.doctorcode=u.doctorcode
where   u.username= ? && u.password= ?");
$sql->bind_param("ss", $user_account,$user_pwd);
$sql->execute();  
$sql->bind_result($doctorcode,$clinic,$status_usere,$name);
$sql->fetch();
if (empty($doctorcode)) {
$sql = $db->prepare("select doctorcode,name from opduser where   loginname= ? && passweb= ?");
$sql->bind_param("ss", $user_account,$user_pwd);
$sql->execute();  
$sql->bind_result($doctorcode,$name);
$sql->fetch();
$status_usere='HOS';
}

if (empty($doctorcode)) {
    echo "<script>alert('ชื่อหรือรหัสผ่านผิด กรุณาตรวจสอบอีกครั้ง!')</script>";
    echo "<meta http-equiv='refresh' content='0;url=./index.php'/>";
    exit();
} else {
    include '../connection/connect.php';
    $date_login = date("Y-m-d");
    $time_login = date('H:i:s');
    $sql = mysqli_query($db,"update jvlmatrix_user  set date_login='$date_login' , time_login='$time_login' 
                            where username='$user_account' and password='$user_pwd'");
    if ($sql == false) {
            echo "<p>";
            echo "Update not complete" . mysqli_error();
    }
    $_SESSION['usermatrix'] = $doctorcode;
    $_SESSION['name_user'] = $name;
    //$_SESSION['lname'] = $result[lname];
    //$_SESSION['dep'] = $result[dep];
    $_SESSION['clinic_user'] = $clinic;
    $_SESSION['status_user'] = $status_usere;

    // require'myfunction/savelog.php';
    //	  echo "<input type='hidden' name='acc_id' value='$acc_username'> ";
$db->close();
}
?>
 </section>