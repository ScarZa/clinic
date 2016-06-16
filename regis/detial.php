<?php 
include ( "connection/connect.php" );
//require_once( "connection/connect1.php" );
require_once( "connection/db_connect.php" );
require_once( "connection/function.php" );

if(empty($_REQUEST['method'])){
    $Hn = $_REQUEST['hn'];
    $sql = mysqli_query($db,"select p.*,m.name as mrname,t.an as an from patient p 
             left outer join marrystatus m on p.marrystatus=m.code 
             left outer join jvlmatrix_transfer t on t.hn=p.hn 
             where t.hn = '$Hn'");
}elseif ($_REQUEST['method'] == 'select') {
    $Hn = $_REQUEST['patient'];
    $sql = mysqli_query($db,"select p.*,m.name as mrname from patient p 
             left outer join marrystatus m on p.marrystatus=m.code 
             where hn = '$Hn'");
}elseif ($_REQUEST['method'] == 'opd') {
    $Hn = $_REQUEST['hn'];
    $sql = mysqli_query($db,"select p.*,m.name as mrname from patient p 
             left outer join marrystatus m on p.marrystatus=m.code 
             where p.hn = '$Hn'");
 } 
 $show = mysqli_fetch_assoc($sql);
$fullname = "$show[pname]$show[fname] $show[lname]";
include_once ('plugins/funcDateThai.php');
?>
<section class="content-header">
    <h1><img src='images/adduser.ico' width='40'><font color='blue'>  ระบบลงทะเบียนรับผู้ป่วย </font></h1> 
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
              <li><a href="index.php?page=transfer/transfer"><i class="fa fa-home"></i> ส่งบำบัด</a></li>
              <li><a href="index.php?page=transfer/detial_transfer&hn=<?=$show['hn']?>&an=<?=$show['an']?>"><i class="fa fa-home"></i> ส่งรับการบำบัด</a></li>
              <li class="active"><i class="fa fa-gear"></i> ลงทะเบียนรับผู้ป่วย</li>
            </ol>
</section>
<section class="content">
<div class="col-lg12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-star"></i> ข้อมูลคนไข้</h3>
        </div>
        <div class="panel-body">
            
            <form class="navbar-form navbar-left" role="form" action='index.php?page=process/register' enctype="multipart/form-data" method='post' onSubmit="return Check_txt()">
                <div class="well well-sm">
                    <table width="100%" border="0">
                    <tr>
                        <td width="65%"> <h4>hn :
  <?= $show['hn'] ?>
                        </h4></td>
                        <td width="35%" rowspan="9" align="center" valign="top">
                            
                              <?php  //getsqldata("select image as cc from patient_image where hn='" . $Hn . "' ") ?>
                                <img src="show_image.php?hn=<?= $Hn ?>" width="300" />
</td>
                    </tr>
                    <tr>
                        <td> <h4>เลขที่บัตรประชาชน :
  <?= $show['cid'] ?>
                      </h4></td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <h4>ชื่อ-นามสกุล :
  <?= $fullname ?>
                      </h4></td>
                    </tr>
                    <tr>
                        <td valign="top">
                            <h4>ที่อยู่ :
  <?= $show['informaddr'] ?>
                      </h4></td>
                    </tr>
                    <tr>
                        <td><h4><?php if (empty($show['birthday'])) { ?>
                          วันเกิด :
                            <?= $show['birthday']; ?>
                            <?php } else { ?>
                            วันเกิด :
                            <?= DateThai1($show['birthday']); ?>
                            <?php } ?>  
                            &nbsp;&nbsp; สถานะภาพ : <?= $show['mrname']; ?>                      
                      </h4></td>
                    </tr>
                    <tr>
                        <td><h4><?php if (empty($show['firstday'])) { ?>
                          มารักษาวันแรก :
  <?= $show['firstday']; ?>
                          <?php } else { ?>
                          มารักษาวันแรก :
                          <?= DateThai1($show['firstday']); ?>
                          <?php } ?>                          &nbsp;&nbsp; 
                          <?php if (empty($show['last_visit'])) { ?>
                          มารักษาครั้งสุดท้าย :
                          <?= $show[last_visit]; ?>
                          <?php } else { ?>
                          มารักษาครั้งสุดท้าย :
                          <?= DateThai1($show['last_visit']); ?>  <?php } ?>                      </h4></td>
                    </tr>
                    <tr>
                        <td height="60" valign="top">
                            <div class="form-group"> 
                                <label>ที่อยู่ที่ติดต่อได้</label>
                                <TEXTAREA value='' NAME="address" id="address"  class="form-control" cols="66" rows=""placeholder="ที่อยู่ที่ติดต่อได้"></TEXTAREA>
                    </div>
                            </td>
                      </tr>
                      <tr>
                          <td height="50">
                              <div class="form-group"> 
                    <label>หมายเลขทรศัพท์ 1</label>
                <input value='' type="text" class="form-control" size="30" name="tell1" id="tell1" placeholder="หมายเลขทรศัพท์" required>
             	</div>
                              <div class="form-group"> 
                    <label>บุคคลที่ 1</label>
                <input value='' type="text" class="form-control" size="15" name="person1" id="person1" placeholder="เกี่ยวข้องเป็น" required>
             	</div>
                          </td>
                      </tr>
                      <tr>
                          <td height="50">
                                                            <div class="form-group"> 
                    <label>หมายเลขทรศัพท์ 2</label>
                <input value='' type="text" class="form-control" size="30" name="tell2" id="tell2" placeholder="หมายเลขทรศัพท์">
             	</div>
                                <div class="form-group"> 
                    <label>บุคคลที่ 2</label>
                <input value='' type="text" class="form-control" size="15" name="person2" id="person2" placeholder="เกี่ยวข้องเป็น">
             	</div>
                          </td>
                      </tr>
                      <tr>
                          <td height="50" colspan="2">
                                                            <div class="form-group"> 
                    <label>หมายเลขทรศัพท์ 3</label>
                <input value='' type="text" class="form-control" size="30" name="tell3" id="tell3" placeholder="หมายเลขทรศัพท์">
             	</div>
                              <div class="form-group"> 
                    <label>บุคคลที่ 3</label>
                <input value='' type="text" class="form-control" size="15" name="person3" id="person3" placeholder="เกี่ยวข้องเป็น">
             	</div>
                          </td>
                      </tr>
                     </table>
        </div>
                <div class="well well-sm">    
                     <div class="form-group"> 
                    <label>วันที่ลงทะเบียน</label>
                    <input class="form-control" type="date" name="regdate" id="regdate" placeholder="วันลงทะเบียน" size="1" required>
                     </div>
                              <div class="form-group"> 
                    <label>รับการบำบัด</label>
                    <select name="m_type" id="m_type" class="form-control" size="1">
                        <option value="0">เลือกการบำบัด</option>
                        <option value="1">สุรา</option>
                        <option value="2">ยาเสพติด</option>
                    </select>
                              </div><br><p>
                              <div class="form-group">
         			<label>สถานะการรักษา &nbsp;</label>
 				<select name="m_status" id="m_status" required  class="form-control">
                                    <?php
                                    $sql = mysqli_query($db,"SELECT *  FROM clinic_member_status order by clinic_member_status_id  ");
                                    echo "<option value=''>--เลือกสถานะ--</option>";
                                    while ($result = mysqli_fetch_assoc($sql)) {
                                        if ($result['clinic_member_status_id'] == $edit_person['in10']) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        echo "<option value='".$result['clinic_member_status_id']."' $selected>".$result['clinic_member_status_name']." </option>";
                                    }
                                    ?>
				 </select>
			 </div>
                              <br><p> 
                      <div class="form-group"> 
                <label>หมายเหตุ</label>
                <TEXTAREA value='' NAME="note" id="note"  class="form-control" cols="60" rows="" placeholder="หมายเหตุ"></TEXTAREA>
                    </div></div>
                <?php if(empty($_REQUEST['method'])){?>
                              <input type="hidden" name="hn" value="<?= $show['hn'];?>">
                              <input type="hidden" name="an" value="<?= $show['an'];?>">
                              <input type="hidden" name="process" value="ipd">
                              <input type="submit" name="submit" id="submit" class="btn btn-success" value="ลงทะเบียน">
                <?php }elseif($_REQUEST['method']=='opd'){?>
                              <input type="hidden" name="hn" value="<?= $show['hn'];?>">
                              <input type="hidden" name="an" value="<?= $show['an'];?>">
                              <input type="hidden" name="process" value="opd">
                              <input type="submit" name="submit" id="submit" class="btn btn-success" value="ลงทะเบียน">
                <?php }elseif ($_REQUEST['method'] == 'select') { ?>
                            <input type="hidden" name="hn" value="<?= $show['hn'];?>">
                            <input type="submit" name="submit" id="submit" class="btn btn-success">
    <?php } ?>
                        </form>
                    <p>&nbsp;</p>
        </div></div></div>
</section>