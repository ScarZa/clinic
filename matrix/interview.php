<?php 
include 'connection/connect.php';
include 'connection/db_connect.php';
include 'connection/function.php';
?>
<?php
if(empty($_SESSION['usermatrix'])){echo "<meta http-equiv='refresh' content='0;url=index.php'/>";exit();} 
if(!empty($_REQUEST['matrix_id'])){
$matrix_Id=$_REQUEST['matrix_id'];}
$Hn = $_REQUEST['hn'];
$sql = mysqli_query($db,"select p.*,m.name as mrname,j1.address as address,j1.tell1,j1.person1,j1.tell2,j1.person2,j1.tell3,j1.person3,
        j1.matrix_id as matrix_id,a.pdx,a.dx0,a.dx1,a.dx2,a.dx3,a.dx4,a.dx5
        from patient p
        left outer join an_stat a on a.hn=p.hn
        left outer join marrystatus m on p.marrystatus=m.code 
        left outer join jvlmatrix_register j1 on j1.hn=p.hn 
	where j1.hn = '$Hn'");
$show = mysqli_fetch_assoc($sql);
$fullname = $show['pname'].$show['fname'].'' .$show['lname'];

    include_once ('plugins/funcDateThai.php');
    ?>
<section class="content-header">
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
              <?php if(!empty($_REQUEST['method'])=='interview2'){?>
              <li><a href="index.php?page=matrix/report_patient&hn=<?=$Hn?>"><i class="fa fa-gear"></i> ข้อมูลผู้ป่วยรับบำบัด</a></li>
              <?php }else{ ?>
              <li><a href="index.php?page=matrix/present"><i class="fa fa-gear"></i> ทะเบียนคลินิคทานตะวัน</a></li>
              <?php } ?>
              <li class="active"><i class="fa fa-gear"></i> แบบสัมภาษณ์ผู้ป่วยจากแอลกอฮอล์</li>
            </ol>
</section><br>
<section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-primary box-solid">
                <div class="box-header">
            <h3 class="box-title">แบบสัมภาษณ์ผู้ป่วยจากแอลกอฮอล์</h3>
                    </div>
                    <div class="box-body">
                        <div class="box box-info box-solid">
                <div class="box-header">
            <h3 class="box-title">ข้อมูลส่วนบุคคล</h3>
                            </div>
                            <div class="box-body">
                                <?php
                                if (!empty($Detial['photo'])) {
                                    $pic = $Detial['photo'];
                                    $fol = "photo/";
                                } else {
                                    $pic = 'person.png';
                                    $fol = "images/";
                                }
                                ?>
                                <div class="text-right">
                                    <right></right>
                                </div>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                       <td width="30%">HN :
                                <?= $show['hn'] ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                       <td width="32%">หมายเลขบัตรประชาชน :&nbsp;                                         <?= $show['cid'] ?>                                       </td>
                                        <td width="38%" rowspan="8" align="right" valign="top">
                                <img src="show_image.php?hn=<?= $Hn ?>" width="250" /></td>
                                    </tr>
                                    <tr>
                                        <td>ชื่อ นามสกุล :
                                      <?= $fullname ?>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td>วัน เดือน ปีเกิด :
                                        <?= DateThai1($show['birthday']); ?>                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">ตามบัตรปะชาชนที่อยู่ :
                                            <?= $show['informaddr'] ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">ที่อยู่ที่ติดต่อได้ :
                                            <?= $show['address'] ?>                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">โทรศัพท์1 :
                                            <?= $show['tell1']; ?>                                            &nbsp;&nbsp; บุคคลติดต่อ1 :
                                            <?= $show['person1']; ?>                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">โทรศัพท์2 :
                                            <?= $show['tell2']; ?>                                            &nbsp;&nbsp; บุคคลติดต่อ2 :
                                            <?= $show['person2']; ?>                                        </td>
                                    </tr>
                                    <tr valign="top">
                                        <td colspan="2">โทรศัพท์3 :
                                            <?= $show['tell3']; ?>                                            &nbsp;&nbsp; บุคคลติดต่อ3 :
                                            <?= $show['person3']; ?>                                        </td>
                                    </tr>
                                    <tr valign="top">
                                        <td colspan="2">การวินิจฉัย : &nbsp;&nbsp;<?= $show['pdx']; ?>&nbsp;&nbsp;<?= $show['dx0']; ?>&nbsp;&nbsp;<?= $show['dx1']; ?>&nbsp;&nbsp;<?= $show['dx2']; ?>
                                        &nbsp;&nbsp;<?= $show['dx3']; ?>&nbsp;&nbsp;<?= $show['dx4']; ?>&nbsp;&nbsp;<?= $show['dx5']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <?php
                        if(!empty($_REQUEST['method'])=='interview2'){
                            $sql_inter=  mysqli_query($db,"select * from jvlmatrix_alcohol_interview where matrix_id='$matrix_Id' and hn='$Hn'");
                            $interview=  mysqli_fetch_assoc($sql_inter);
                        }
                        ?>
                        <div class="box box-danger box-solid">
                <div class="box-header">
            <h3 class="box-title">ประวัติการดื่มสุรา</h3>
                            </div>
                            <div class="box-body">
                                <form name="form2" class="navbar-form navbar-left" role="form" action='index.php?page=process/prc_interview' enctype="multipart/form-data" method='post' onSubmit="return Check_txt()">
                                    <div class="well well-sm " >
                                    1.เริ่มดื่มครั้งแรกอายุ
                                 <div class="form-group"> 
                                     <input value='<?php if(!empty($_REQUEST['method'])){ echo $interview['begin'];} ?>' type="text" class="form-control" size="2" name="begin" id="begin" placeholder="อายุ" required>
             	</div>
                     &nbsp;&nbsp;ชนิดเครื่องดื่มแอลกอฮอล์
                     <div class="form-group">
    				<select name="alcohol_type" id="alcohol_type" required  class="form-control">
                                    <?php
                                    $sql = mysqli_query($db,"SELECT *  FROM jvlmatrix_alcohol_type   ");
                                    echo "<option value=''>--เลือกชนิดแอลกอฮอล์--</option>";
                                    while ($result = mysqli_fetch_assoc($sql)) {
                                        if ($result['al_id'] == $interview['alcohol_type']) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        echo "<option value='".$result['al_id']."' $selected>".$result['name']." </option>";
                                    }
                                    ?>
				 </select>
                     </div><br>
                                    </div>
                                    <div class="well well-sm">
                    2.คุณดื่มบ่อยเพียงใด
                     <div class="form-group">
    				<select name="alcohol_volume" id="alcohol_volume" required  class="form-control">
                                    <?php
                                    $sql = mysqli_query($db,"SELECT *  FROM jvlmatrix_alcohol_period   ");
                                    echo "<option value=''>--ดื่มบ่อยเพียงใด--</option>";
                                    while ($result = mysqli_fetch_assoc($sql)) {
                                        if ($result['period_id'] == $interview['alcohol_volume']) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        echo "<option value='".$result['period_id']."' $selected>".$result['period_name']." </option>";
                                    }
                                    ?>
				 </select>
                     </div>
                                    </div>
                                    <div class="well well-sm">
                    3.ดื่มครั้งสุดท้ายเมื่อวันที่ 
                     <div class="form-group">
                         <input type="date" value="<?php if(!empty($_REQUEST['method'])){ echo $interview['last_drink'];}?>" name="last_drink" id="last_drink" class="form-control" placeholder="วันที่ดื่มครั้งสุดท้าย" required>
                         </div>
                    </div>
                                    <div class="well well-sm">
                    4.รวมระยะเวลาที่ดื่มสุราอย่างต่อเนื่อง    
                        <div class="form-group"> 
                <input value='<?php if(!empty($_REQUEST['method'])){ echo $interview['total_time'];} ?>' type="text" class="form-control" size="4" name="total_time" id="total_time" placeholder="ระยะเวลา" required>
             	</div>
                    <div class="form-group">
    				<select name="range_time" id="range_time" required  class="form-control">
                                    <?php
                                    $sql = mysqli_query($db,"SELECT *  FROM jvlmatrix_range   ");
                                    echo "<option value=''>--เลือกระยะเวลา--</option>";
                                    while ($result = mysqli_fetch_assoc($sql)) {
                                        if ($result['range_id'] == $interview['range_time']) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        echo "<option value='".$result['range_id']."' $selected>".$result['range_name']." </option>";
                                    }
                                    ?>
				 </select>
                    </div></div>
                                    <div class="well well-sm">
                    5.ชนิดของการดื่มเครื่องดื่มแอลกอฮอล์ที่ดื่มบ่อย 
                    <script language=JavaScript>
function drink1()
{
	var req; 
	if (window.XMLHttpRequest) { 
		// For Netscape, FireFox and not IE
          		req = new XMLHttpRequest();
	}
	else if(window.ActiveXObject){ 
		// For IE
          		req = new ActiveXObject("Microsoft.XMLHTTP"); 
	}
	else {
		alert("Browser error");
		return false;
	}
	req.onreadystatechange = function()
	{
		if(req.readyState == 4)	
			document.form2.degree.value = req.responseText;
                }
                var num1,query;
	num1 = document.form2.alcohol.value;
	query = "?";
	query+="cc="+num1;
                req.open("GET", "matrix/degree.php"+query, true);
	req.send(null); 
            }
        </script>
                    <script language=JavaScript>
function drink()
{
	var req; 
	if (window.XMLHttpRequest) { 
		// For Netscape, FireFox and not IE
          		req = new XMLHttpRequest();
	}
	else if(window.ActiveXObject){ 
		// For IE
          		req = new ActiveXObject("Microsoft.XMLHTTP"); 
	}
	else {
		alert("Browser error");
		return false;
	}
	req.onreadystatechange = function()
	{
		if(req.readyState == 4)	
			document.form2.answer.value = req.responseText;
                }
                var num1, num2,num3, query;
	num1 = document.form2.degree.value;
	num2 = document.form2.volume.value;
        num3 = document.form2.amount.value;
	query = "?";
	query+="cc="+num1;
	query+="&";
	query+="degree="+num2;
        query+="&";
	query+="amount="+num3;
                req.open("GET", "matrix/calculate.php"+query, true);
	req.send(null); 
            }
        </script>
        <div class="form-group">
            <select name="alcohol" id="alcohol" class="form-control">
                <option value="">เลือกชนิด</option>
                <?php $sql = mysqli_query($db,"select * from jvlmatrix_alcohol_type");
                while ($Sql = mysqli_fetch_array($sql)) {
                    if ($Sql['al_id'] == $interview['type_freq']) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                    echo "<option value='".$Sql['al_id']."' $selected>".$Sql['name']." </option>";
 } ?>
            </select>
            </div>
        <div class="form-group">
            <input class="btn btn-success" type="button" name="button1" id="button1" value="คำนวณdegree" onClick="drink1();">
            </div>
             <div class="form-group">
                 <input type="text" name="degree" class="form-control" size="5">
            </div>
                                    </div>
                                    <div class="well well-sm">
            6.ปริมาณที่ดื่ม(โดยเฉลี่ย)
            <div class="form-group">
            <select name="volume" id="volume" class="form-control">
                <option value="">เลือกขนาด</option>
                <?php $sql2 = mysqli_query($db,"select * from jvlmatrix_alcohol_volume");
                while ($Sql2 = mysqli_fetch_array($sql2)) {
                    ?>
                    <option value="<?= $Sql2['cc'] ?>"><?= $Sql2['volume_type'] ?></option>    
<?php } ?>
            </select>
                </div>
            จำนวน
            <div class="form-group">
                <input type="text" name="amount" id="amount" value="1" size="2" class="form-control">
            </div>
            <div class="form-group">
            <input class="btn btn-success" type="button" name="button" id="button" value="คำนวณดื่มมาตรฐาน" onClick="drink();">
            </div>
             <div class="form-group">
                 <input type="text" name="answer" class="form-control" size="5" value="<?php if(!empty($_REQUEST['method'])){ echo $interview['drink'];}?>">
             </div>(ตามสูตร)</div>
                                    <div class="well well-sm">
            7.สาเหตุการดื่ม (ระบุข้อสำคัญที่สุดเพียงข้อเดียว)
                        <div class="form-group">
    				<select name="cause" id="cause" required  class="form-control">
                                    <?php
                                    $sql = mysqli_query($db,"SELECT *  FROM jvlmatrix_alcohol_cause   ");
                                    echo "<option value=''>--เลือกสาเหตุ--</option>";
                                    while ($result = mysqli_fetch_assoc($sql)) {
                                        if ($result['drink_cause_id'] == $interview['cause']) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        echo "<option value='".$result['drink_cause_id']."' $selected>".$result['cause_name']." </option>";
                                    }
                                    ?>
				 </select>
                        </div><font color="red"> * หากเลือกอื่นๆโปรดระบุ</font>
                        <div class="form-group">
                            <input type="text" name="cause_other" id="cause_other" size="25" class="form-control" value="<?php if(!empty($_REQUEST['method'])){ echo $interview['cause_other'];}?>">
                        </div></div>
                                    <div class="well well-sm">
            8.ช่วงเวลาใดที่คุณชอบดื่ม(ในระยะ 2-3เดือนที่ผ่านมา)
            <div class="form-group">
    				<select name="range" id="range" required  class="form-control">
                                    <?php
                                    $sql = mysqli_query($db,"SELECT *  FROM jvlmatrix_alcohol_range   ");
                                    echo "<option value=''>--เลือกช่วงเวลา--</option>";
                                    while ($result = mysqli_fetch_assoc($sql)) {
                                        if ($result['range_id'] == $interview['ranger']) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        echo "<option value='".$result['range_id']."' $selected>".$result['range_name']." </option>";
                                    }
                                    ?>
				 </select>
            </div></div>
                                    <div class="well well-sm">
            9.สถานที่ ที่คุณดื่มบ่อยๆ 
            <div class="form-group">
    				<select name="place" id="place" required  class="form-control">
                                    <?php
                                    $sql = mysqli_query($db,"SELECT *  FROM jvlmatrix_alcohol_place   ");
                                    echo "<option value=''>--เลือกสถานที่--</option>";
                                    while ($result = mysqli_fetch_assoc($sql)) {
                                        if ($result['place_id'] == $interview['place']) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        echo "<option value='".$result['place_id']."' $selected>".$result['place_name']." </option>";
                                    }
                                    ?>
				 </select>
                        </div><font color="red"> * หากเลือกอื่นๆโปรดระบุ</font>
                        <div class="form-group">
                            <input type="text" name="place_other" value="<?php if(!empty($_REQUEST['method'])){ echo $interview['place_other'];}?>" id="place_other" size="50" class="form-control">
                        </div></div>
                                    <div class="well well-sm">
            10.คุณมักจะดื่มกับใคร
            <div class="form-group">
    				<select name="join" id="join" required  class="form-control">
                                    <?php
                                    $sql = mysqli_query($db,"SELECT *  FROM jvlmatrix_alcohol_join   ");
                                    echo "<option value=''>--เลือกดื่มกับใคร--</option>";
                                    while ($result = mysqli_fetch_assoc($sql)) {
                                        if ($result['join_id'] == $interview['joint']) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        echo "<option value='".$result['join_id']."' $selected>".$result['join_name']." </option>";
                                    }
                                    ?>
				 </select>
            </div></div>
                                    <div class="well well-sm">
                        11.คุณเคยหยุดดื่มอย่างตั้งใจหรือไม่<br>
                        <?php if(!empty($_REQUEST['method'])=='interview2' and $interview['stop']=='1'){?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="stop" id="stop" value="0" /> ไม่เคยหยุด <font color="red">(ข้ามไปตอบข้อ12)</font><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="stop" id="stop" value="1" checked="checked"/> เคย โดยวิธี
                        <?php }else{?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="stop" id="stop" value="0" checked="checked"/> ไม่เคยหยุด <font color="red">(ข้ามไปตอบข้อ12)</font><br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="stop" id="stop" value="1" /> เคย โดยวิธี
                        <?php }?>
                        <div class="form-group">
                            <input type="text" name="stop_by" id="stop_by" value="<?php if(!empty($_REQUEST['method'])){ echo $interview['stop_by'];}?>" size="50" class="form-control">
            </div> หยุดได้นานที่สุด
            <div class="form-group">
                            <input type="text" name="stop_time" id="stop_time" value="<?php if(!empty($_REQUEST['method'])){ echo $interview['stop_time'];}?>" size="2" class="form-control">
            </div>
            <div class="form-group">
    				<select name="range_stop" id="range_stop"  class="form-control">
                                    <?php
                                    $sql = mysqli_query($db,"SELECT *  FROM jvlmatrix_range   ");
                                    echo "<option value=''>--เลือกระยะเวลา--</option>";
                                    while ($result = mysqli_fetch_assoc($sql)) {
                                        if ($result['range_id'] == $interview['range_stop']) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        echo "<option value='".$result['range_id']."' $selected>".$result['range_name']." </option>";
                                    }
                                    ?>
				 </select>
                        </div><br><p></p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 11.1 อะไรเป็นสาเหตุให้คุณหยุดดื่ม 
            <div class="form-group">
    				<select name="stop_cause" id="stop_cause" class="form-control">
                                    <?php
                                    $sql = mysqli_query($db,"SELECT *  FROM jvlmatrix_alcohol_stop   ");
                                    echo "<option value=''>--เลือกสาเหตุให้คุณหยุด--</option>";
                                    while ($result = mysqli_fetch_assoc($sql)) {
                                        if ($result['stop_id'] == $interview['stop_cause']) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        echo "<option value='".$result['stop_id']."' $selected>".$result['stop_name']." </option>";
                                    }
                                    ?>
				 </select>
                        </div><font color="red"> * หากเลือกอื่นๆโปรดระบุ</font>
                        <div class="form-group">
                            <input type="text" name="stop_other" id="stop_other" value="<?php if(!empty($_REQUEST['method'])){ echo $interview['stop_other'];}?>" size="30" class="form-control">
            </div><br><p></p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 11.2 อะไรเป็นสาเหตุที่ทำให้คุณกลับไปดื่มอีก
            <div class="form-group">
    				<select name="again" id="again" class="form-control">
                                    <?php
                                    $sql = mysqli_query($db,"SELECT *  FROM jvlmatrix_alcohol_again   ");
                                    echo "<option value=''>--เลือกสาเหตุที่กลับมาดื่ม--</option>";
                                    while ($result = mysqli_fetch_assoc($sql)) {
                                        if ($result['again_id'] == $interview['again']) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        echo "<option value='".$result['again_id']."' $selected>".$result['again_name']." </option>";
                                    }
                                    ?>
				 </select>
                        </div><font color="red"> * หากเลือกอื่นๆโปรดระบุ</font>
                        <div class="form-group">
                            <input type="text" name="again_other" id="again_other" size="25" class="form-control" value="<?php if(!empty($_REQUEST['method'])){ echo $interview['again_other'];}?>">
                        </div></div>
                                    <div class="well well-sm">
            12.คุณใช้สารเสพติดอื่นหรือไม่(3เดือนที่ผ่านมา)<br>
            <?php if(!empty($_REQUEST['method'])=='interview2' and $interview['use_drug']=='1'){?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="use_drug" id="use_drug" value="0" /> ไม่ใช้ <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="use_drug" id="use_drug" value="1" checked="checked"/> ใช้ &nbsp;&nbsp;
                        <?php }else{?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="use_drug" id="use_drug" value="0" checked="checked"/> ไม่ใช้ <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="use_drug" id="use_drug" value="1" /> ใช้ &nbsp;&nbsp;
                        <?php }?>
                        <div class="form-group">
    				<select name="drug" id="drug" class="form-control">
                                    <?php
                                    $sql = mysqli_query($db,"SELECT *  FROM jvlmatrix_drug   ");
                                    echo "<option value=''>--เลือกชนิดยาเสพติด--</option>";
                                    while ($result = mysqli_fetch_assoc($sql)) {
                                        if ($result['drug_id'] == $interview['drug']) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        echo "<option value='".$result['drug_id']."' $selected>".$result['drug_name']." </option>";
                                    }
                                    ?>
				 </select>
                        </div></div>
                                    <div class="well well-sm">
                     13.ปัจจุบันคุณยังใช้สารนั้นหรือไม่<br>
                     <?php if(!empty($_REQUEST['method'])=='interview2' and $interview['now_use']=='1'){?>
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="now_use" id="now_use" value="0" /> ไม่ใช้ <br>
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="now_use" id="now_use" value="1" checked="checked"/> ใช้ &nbsp;&nbsp;บอกปริมาณที่ใช้ต่อวัน
                        <?php }else{?>
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="now_use" id="now_use" value="0" checked="checked"/> ไม่ใช้ <br>
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="now_use" id="now_use" value="1" /> ใช้ &nbsp;&nbsp;บอกปริมาณที่ใช้ต่อวัน
                     <?php }?>
                        <div class="form-group">
                            <input type="text" value="<?php if(!empty($_REQUEST['method'])){ echo $interview['volume_use'];}?>" name="volume_use" id="volume_use" size="10" class="form-control">
                        </div></div>
                                    <div class="well well-sm">
            14.ญาติของคุณมีใครที่ดื่มสุราเป็นประจำ<br>
            <?php if(!empty($_REQUEST['method'])=='interview2' and $interview['family_drink']=='1'){?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="family_drink" id="family_drink" value="0" /> ไม่มี <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="family_drink" id="family_drink" value="1" checked="checked"/> มี &nbsp;&nbsp;ระบุ
                        <?php }else{?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="family_drink" id="family_drink" value="0" checked="checked"/> ไม่มี <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="family_drink" id="family_drink" value="1" /> มี &nbsp;&nbsp;ระบุ
                        <?php }?>
                        <div class="form-group">
    				<select name="family" id="family" class="form-control">
                                    <?php
                                    $sql = mysqli_query($db,"SELECT *  FROM jvlmatrix_family   ");
                                    echo "<option value=''>--เลือกญาติ--</option>";
                                    while ($result = mysqli_fetch_assoc($sql)) {
                                        if ($result['family_id'] == $interview['family']) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        echo "<option value='".$result['family_id']."' $selected>".$result['family_name']." </option>";
                                    }
                                    ?>
				 </select>
                        </div></div>
                                    <div class="well well-sm">
                     15.คุณเคยดื่มสุราแล้วหลับไปโดยไม่รู้ตัว "เมื่อตื่นขึ้นนึกไม่ออกว่ามาอยู่ที่นี่ได้อย่างไร" (Black out:ความจำขาดช่วง)<br>
                     <?php if(!empty($_REQUEST['method'])=='interview2' and $interview['sleep']=='1'){?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="sleep" id="sleep" value="0" /> ไม่มี <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="sleep" id="sleep" value="1" checked="checked"/> มี <br><p></p>
                        <?php }else{?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="sleep" id="sleep" value="0" checked="checked"/> ไม่มี <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="sleep" id="sleep" value="1" /> มี <br><p></p>
                        <?php }?>
                                    </div>
                                    <div class="well well-sm">
                     <b><u>ประวัติการรักษา</u></b><br>
                     ก.เคยเข้ารับการบำบัดแอลกอฮอล์<br>
                     <?php if(!empty($_REQUEST['method'])=='interview2' and $interview['therapy']=='1'){?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="therapy" id="therapy" value="0" /> ไม่เคย <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="therapy" id="therapy" value="1" checked="checked"/> เคย &nbsp;&nbsp;เข้ารับการรักษาที่
                        <?php }else{?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="therapy" id="therapy" value="0" checked="checked"/> ไม่เคย <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="therapy" id="therapy" value="1" /> เคย &nbsp;&nbsp;เข้ารับการรักษาที่
                        <?php }?>
                        <div class="form-group">
                            <input type="text" name="place_therapy" id="place_therapy" size="30" class="form-control">
            </div>&nbsp;&nbsp;จำนวน
                        <div class="form-group">
                            <input type="text" value="<?php if(!empty($_REQUEST['method'])){ echo $interview['amount_therapy'];}?>" name="amount_therapy" id="amount_therapy" size="2" class="form-control">
            </div>&nbsp;ครั้ง<br><p></p>
            ข.เคยเข้ารับการรักษาอาการทางจิต/ประสาท<br>
            <?php if(!empty($_REQUEST['method'])=='interview2' and $interview['psyc']=='1'){?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="psyc" id="psyc" value="0" /> ไม่เคย <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="psyc" id="psyc" value="1" checked="checked"/> เคย &nbsp;&nbsp;เข้ารับการรักษาที่โรงพยาบาล
            <?php }else{?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="psyc" id="psyc" value="0" checked="checked"/> ไม่เคย <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="psyc" id="psyc" value="1" /> เคย &nbsp;&nbsp;เข้ารับการรักษาที่โรงพยาบาล
            <?php }?>
                        <div class="form-group">
                            <input type="text" value="<?php if(!empty($_REQUEST['method'])){ echo $interview['psyc'];}?>" name="place_psyc" id="place_psyc" size="30" class="form-control">
            </div>&nbsp;&nbsp;ปี พ.ศ.
                        <div class="form-group">
                            <input type="text" value="<?php if(!empty($_REQUEST['method'])){ echo $interview['year'];}?>" name="year" id="year" size="2" class="form-control">
                        </div><br><p></p></div>
                                    <div class="well well-sm">
            <b><u>สรุปการสัมภาษณ์</u></b><br><p></p>
            A.ให้คะแนน
            <div class="form-group">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" value="<?php if(!empty($_REQUEST['method'])){ echo $interview['brief_score'];}?>" name="brief_score" id="brief_score" value="" size="2" class="form-control">
            </div><br><p></p>
            B.การดื่มสุรา<br>
            <?php if(!empty($_REQUEST['method'])=='interview2' and $interview['brief']=='1'){?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="brief" id="brief" value="0" /> ไม่ติด <br>
                       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="brief" id="brief" value="1" checked="checked"/> ติด
            <?php }else{?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="brief" id="brief" value="0" checked="checked"/> ไม่ติด <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="brief" id="brief" value="1" /> ติด
            <?php }?>
                        <br><p></p>
                        C.เป็นผู้ป่วย 
                        <div class="form-group">
                        <select name="type_patient" class="form-control">
                            <?php if($interview['type_patient']=='IPD'){?>
                                <option value="IPD">IPD</option>
                                <option value="OPD">OPD</option>
                            <?php }  else {
                            ?> 
                            <option value="OPD">OPD</option>
                            <option value="IPD">IPD</option>
                            <?php }?>
                        </select>   
                            </div><br><p></p>
                            D.โรคร่วม<br>
                            <?php if(!empty($_REQUEST['method'])=='interview2' and $interview['diag']=='1'){?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="diag" id="diag" value="0" /> ไม่มี <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="diag" id="diag" value="1" checked="checked"/> มี
                            <?php }else{?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="diag" id="diag" value="0" checked="checked"/> ไม่มี <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="diag" id="diag" value="1" /> มี
                            <?php }?>
                        &nbsp;&nbsp;<font color="red"> * หากมีโปรดเลือก</font>
                        <div class="form-group">
    				<select name="diag2" id="diag2" class="form-control">
                                    <?php
                                    $sql = mysqli_query($db,"SELECT *  FROM jvlmatrix_diag   ");
                                    echo "<option value=''>--เลือกโรคร่วม--</option>";
                                    while ($result = mysqli_fetch_assoc($sql)) {
                                        if ($result['diag_id'] == $interview['diag2']) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        echo "<option value='".$result['diag_id']."' $selected>".$result['diag_name']." </option>";
                                    }
                                    ?>
				 </select>
                        </div></div>
            <div class="form-group">
                <input type="hidden" name="hn" value="<?=$show['hn'] ?>">
                <input type="hidden" name="matrix_id" value="<?= $show['matrix_id'] ?>">
                <input type="hidden" name="method" value="interview">
                <?php if(empty($_REQUEST['method'])){?>
                <input type="submit" name="submit" id="submit" class="btn btn-success" value="บันทึก">
                <?php }?>
            </div>
                                </form>          
                            </div>
                            </div>
                        
                        <div class="box box-warning box-solid">
                <div class="box-header">
            <h3 class="box-title">สัมภาษณ์เสริมแรงจูงใจ : MI</h3>
                            </div>
                            <div class="box-body">
                                <?php if(!empty($interview['int_id']) and $interview['mi']!='Y'){?>
                                <a href="index.php?page=matrix/interview&mi=mi&method=interview2&matrix_id=<?=$show['matrix_id']?>&hn=<?=$show['hn'] ?>">สัมภาษณ์เพิ่มเติม</a>
                                <br><p></p>
                                <?php if(isset($_REQUEST['mi'])=='mi'){
                                include 'matrix/interview_mi.php';
                                }}elseif (!empty ($interview['int_id']) and $interview['mi']=='Y') {
                                    include 'matrix/interview_mi.php';
}?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>