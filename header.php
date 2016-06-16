<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ระบบคลินิคโรงพยาบาลจิตเวชเลยฯ</title>
    <LINK REL="SHORTCUT ICON" HREF="images/logo.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <!-- Date Picker -->
    <!--<link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <script src="plugins/excellentexport.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
		function popup(url,name,windowWidth,windowHeight){    
				myleft=(screen.width)?(screen.width-windowWidth)/2:100;	
				mytop=(screen.height)?(screen.height-windowHeight)/2:100;	
				properties = "width="+windowWidth+",height="+windowHeight;
				properties +=",scrollbars=yes, top="+mytop+",left="+myleft;   
				window.open(url,name,properties);
	}
</script>
<script type="text/javascript">
            $(document).ready(function () {

                $('a[id^="chart"]').fancybox({
                    'width': 1000,
                    'height': 1300,
                    'autoScale': false,
                    'transitionIn': 'fade',
                    'transitionOut': 'fade',
                    'type': 'iframe',
                    /*afterClose	:	function() {
                     parent.location.reload(true); 
                     }*/
                });
                $('a[id^="chart3"]').fancybox({
                    'width': 1000,
                    'height': 1300,
                    'autoScale': false,
                    'transitionIn': 'fade',
                    'transitionOut': 'fade',
                    'type': 'iframe',
                    /*afterClose	:	function() {
                     parent.location.reload(true); 
                     }*/
                });
            });
        </script>
<script type="text/javascript">
            function getRefresh() {
                $("#auto").show("slow");
                $("#autoRefresh").load("alert_regis.php", '', callback);
            }

            function callback() {
                $("#autoRefresh").fadeIn("slow");
                setTimeout("getRefresh();", 1000);
            }

            $(document).ready(getRefresh);
</script>
<script language="JavaScript">
            var HttPRequest = false;
            function doCallAjax(Sort) {
                HttPRequest = false;
                if (window.XMLHttpRequest) { // Mozilla, Safari,...
                    HttPRequest = new XMLHttpRequest();
                    if (HttPRequest.overrideMimeType) {
                        HttPRequest.overrideMimeType('text/html');
                    }
                } else if (window.ActiveXObject) { // IE
                    try {
                        HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
                    } catch (e) {
                        try {
                            HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e) {
                        }
                    }
                }
                if (!HttPRequest) {
                    alert('Cannot create XMLHTTP instance');
                    return false;
                }
                var url = 'alert_regis.php';
                var pmeters = 'mySort=' + Sort;
                HttPRequest.open('POST', url, true);
                HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                HttPRequest.setRequestHeader("Content-length", pmeters.length);
                HttPRequest.setRequestHeader("Connection", "close");
                HttPRequest.send(pmeters);
                HttPRequest.onreadystatechange = function ()
                {
                    if (HttPRequest.readyState == 3)  // Loading Request
                    {
                        document.getElementById("mySpan").innerHTML = "Now is Loading...";
                    }
                    if (HttPRequest.readyState == 4) // Return Request
                    {
                        document.getElementById("mySpan").innerHTML = HttPRequest.responseText;
                    }
                }
            }
        </script>

  </head>
  <body class="hold-transition skin-purple fixed sidebar-collapse sidebar-mini" Onload="bodyOnload();">>
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>C</b>linic</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>CLINIC-</b>System v.1</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          
          <div class="navbar-custom-menu">
              
            <ul class="nav navbar-nav">
                <?php if(empty($_SESSION['status_user'])){?>
                
                
                                
                <li class="dropdown messages-menu">
                    
                        <a href="#" onClick="return popup('login_page.php', popup, 300, 330);" title="เข้าสู่ระบบบุคลากร">
                            <img src="images/key-y.ico" width="18"> เข้าสู่ระบบ
                  </a>
                   
                </li>
                <?php }else{
                    include 'connection/connect.php';
                $sql = mysqli_query($db,"SELECT COUNT(transfer_id) as count_regis FROM jvlmatrix_transfer where ISNULL(status)");
                                    $result = mysqli_fetch_assoc($sql);
                                    echo mysqli_error($db);
                                ?>
                <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <font color="yellow"><i class="fa fa-bell"></i></font>
                  <span class="label label-danger"><?php echo $result['count_regis']; ?></span>
                </a>
                    <ul class="dropdown-menu">
                        <li class="header">มีรายการใหม่ <?php echo $result['count_regis']; ?> รายการ</li>
                        <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                                            <?php
                                            $sql2 = mysqli_query($db,"select c.name  AS detail,t.hn,t.an  from jvlmatrix_transfer t
                                                            inner join clinic c on c.clinic=t.clinic
                                                        WHERE ISNULL(t.status) GROUP BY t.transfer_id order by t.transfer_id DESC");
                                            while ($result2 = mysqli_fetch_assoc($sql2)) {
                                                ?>
                        <li><a href="index.php?page=transfer/detial_transfer&hn=<?= $result2['hn']?>&an=<?= $result2['an']?>"><img src="images/Old_Iron_Man_Mask.ico" width="30"> <?php echo $result2['detail']; ?> </a></li>
                                            <?php } ?>
                                            <li class="divider"></li>
                                            <li><a href="index.php?page=transfer/Therapy">ดูทั้งหมด</a></li>
                    </ul>
                    </li>
                    </ul>
                </li>             
                   <?php include 'connection/connect.php';
                                    $user_id = $_SESSION['status_user'];
                                    /*if (!empty($user_id)) {
                                        $sql = $db->prepare("select em.photo,po.posname ,d1.depName from emppersonal em 
                                                        INNER JOIN posid po on em.posid=po.posId
                                                        INNER JOIN department d1 on em.depid=d1.depId
                                                        WHERE empno=?");
                                        $sql->bind_param("i",$user_id);
                                        $sql->execute();
                                        $sql->bind_result($empno_photo,$posname,$depname);
                                        $sql->fetch();
                                        if (empty($empno_photo)) {
                                    $photo = 'person.png';
                                    $fold = "images/";
                                } else {
                                    $photo = $empno_photo;
                                    $fold = "photo/";
                                }
                                        $db->close();
                                    }*/
                                    
                    ?>
                <script language="JavaScript">
                                            function bodyOnload()
                                            {
                                                doCallAjax('CustomerID')
                                                setTimeout("doLoop();", 2000);
                                            }
                                            function doLoop()
                                            {
                                                bodyOnload();
                                            }
                                        </script>
                                       <!--<li class="dropdown alerts-dropdown" id="mySpan"></li>
              <!-- User Account: style can be found in dropdown.less -->
              
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?= $fold.$photo?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?= $_SESSION['name_user']?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?= $fold.$photo?>" class="img-circle" alt="User Image">
                    <!--<p>
                      <?= $posname?>
                      <small><?= $depname?></small>
                    </p>-->
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">ข้อมูลส่วนตัว</a>
                    </div>
                    <div class="pull-right">
                        <a href="index.php?page=process/logout" class="btn btn-default btn-flat">ออกจากระบบ</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
                <?php }?>
            </ul>
          </div>
        </nav>
      </header>
        <?php include 'connection/connect.php';
//===ชื่อโรงพยาบาล
                    $sql = "select * from  hospital";
                    $query=  mysqli_query($db, $sql);
                    $resultHos = mysqli_fetch_assoc($query);
                    if ($resultHos['logo'] != '') {
                                    $pic = $resultHos['logo'];
                                    $fol = "logo/";
                                } else {
                                    $pic = 'agency.ico';
                                    $fol = "images/";
                                }
                                $db->close();
                    ?>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $fol.$pic?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>โรงพยาบาลจิตเวชเลยฯ</p>
              <a href="#"><i class="fa fa-circle text-success"></i> ระบบคลินิค</a>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">เมนูหลัก</li>
            <li class=""><a href="index.php">
                    <img src="images/gohome.ico" width="20"> <span>หน้าหลัก</span></a>
            </li>
            <?php if(isset($_SESSION['status_user'])){
            if($_SESSION['status_user']=='ADMIN' or $_SESSION['clinic_user']=='006'){ ?>
            <li class="treeview">
              <a href="#">
                  <img src="images/kuser.ico" width="20">
                <span>ระบบคลินิคทานตะวัน</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li><a href="index.php?page=matrix/present"><i class="fa fa-circle-o text-green"></i> คลินิคทานตะวัน</a></li>
                <!--<li><a href="index.php?page=personal/pre_person"><i class="fa fa-circle-o text-green"></i> ข้อมูลบุคลากร</a></li>
                <li><a href="index.php?page=personal/pre_educate"><i class="fa fa-circle-o text-green"></i> ประวัตฺการศึกษา</a></li>
                <li><a href="index.php?page=personal/resign_person"><i class="fa fa-circle-o text-green"></i> ข้อมูลบุคลากรย้าย/ลาออก</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o text-blue"></i> รายงาน <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="index.php?page=personal/statistics_person"><i class="fa fa-circle-o text-aqua"></i> สถิติบุคลากร</a></li>
                    <li><a href="#" onClick="window.open('personal/detial_type.php','','width=400,height=350'); return false;" title="สถิติประเภทพนักงาน"><i class="fa fa-circle-o text-aqua"></i> สถิติประเภทพนักงาน</a></li>
                    <li><a href="#" onClick="window.open('personal/detial_position.php','','width=600,height=680'); return false;" title="สถิติตำแหน่งพนักงาน"><i class="fa fa-circle-o text-aqua"></i> สถิติตำแหน่งพนักงาน</a></li>
                    </ul>
            </li>-->
              </ul>
            </li>
            <?php }
            if ($_SESSION['status_user']=='ADMIN' or $_SESSION['clinic_user']=='005') { ?>
                
            <li class="treeview">
              <a href="#">
                  <img src="images/Letter.png" width="20">
                <span>ระบบคลินิคนักจิต</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                  <li><a href="index.php?page=leave/receive_leave"><i class="fa fa-circle-o text-red"></i> บันทึกทะเบียนรับใบลา</a></li>
                <li><a href="index.php?page=leave/pre_leave"><i class="fa fa-circle-o text-red"></i> บันทึกการลาบุคลากร</a></li>
                <li><a href="pages/layout/fixed.html"><i class="fa fa-circle-o text-red"></i> ยกเลิกใบลา</a></li>
                <li><a href="pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o text-red"></i> การลาชั่วโมง</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o text-orange"></i> รายงาน <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> สถิติการลาแยกหน่วยงาน</a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> สถิติการลา</a></li>
                    </ul>
                </li>
              </ul>
            </li>
            <?php }
            if ($_SESSION['status_user']=='ADMIN' or $_SESSION['clinic_user']=='010') {?>
            <li class="treeview">
              <a href="#">
                  <img src="images/training.ico" width="20">
                <span>ระบบคลินิคเด็ก</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o text-maroon"></i> บันทึกโครงการฝึกอบรมภายนอก</a></li>
                <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o text-maroon"></i> บันทึกการฝึกอบรมภายนอก</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o text-fuchsia"></i> รายงาน <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o text-fuchsia"></i> สถิติการฝึกอบรมภายนอก</a></li>
                    </ul>
                </li>
              </ul>
            </li>
            <?php }
            if ($_SESSION['status_user']=='ADMIN' or $_SESSION['clinic_user']=='008') {?>
            <li class="treeview">
              <a href="#">
                  <img src="images/trainin.ico" width="20">
                <span>ระบบคลินิคซาเทียร์</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="pages/charts/chartjs.html"><i class="fa fa-circle-o text-purple"></i> บันทึกโครงการฝึกอบรมภายใน</a></li>
                <li><a href="pages/charts/morris.html"><i class="fa fa-circle-o text-purple"></i> บันทึกการฝึกอบรมภายใน</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o text-maroon"></i> รายงาน <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o text-fuchsia"></i> สถิติการฝึกอบรมภายใน</a></li>
                    </ul>
                </li>
              </ul>
            </li>
            <?php }
            if (!empty($_SESSION['status_user'])) {?>
            <li>
                <a title="ระบบส่งผู้ป่วย">
                    <img src="images/Calendar.ico" width="20"> <span>ระบบส่งผู้ป่วย</span><i class="fa fa-angle-left pull-right"></i>
              </a>
                <ul class="treeview-menu">
                <li><a href="index.php?page=transfer/transfer"><i class="fa fa-circle-o text-purple"></i> ส่งบำบัด IPD</a></li>
                <li><a href="index.php?page=transfer/transfer_opd"><i class="fa fa-circle-o text-purple"></i> ส่งบำบัด OPD</a></li>
                <li>
                  <a href="#"><i class="fa fa-circle-o text-maroon"></i> รายงาน <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="index.php?page=transfer/Therapy"><i class="fa fa-circle-o text-fuchsia"></i> รอรับบำบัด</a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-fuchsia"></i> รับแล้ว</a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-fuchsia"></i> ส่งคืน</a></li>
                    </ul>
                </li>
              </ul>
            </li>
            <?php }}?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
                <?php
                    function insert_date(&$take_date_conv,&$take_date)
                    {
                        $take_date=explode("/",$take_date_conv);
			 $take_date_year=$take_date[2]-543;
			 $take_date="$take_date_year-$take_date[1]-$take_date[0]";
                    }
?>
      <div class="content-wrapper">
