<?php
include 'connection/connect.php';
include 'connection/db_connect.php';
include 'connection/function.php';

if(empty($_REQUEST['method'])){
         $An=$_REQUEST['an'];
     $Hn = $_REQUEST['hn'];
     $sql = mysqli_query($db,"select p.*,m.name as mrname,a.an,a.pdx,a.dx0,a.dx1,a.dx2,a.dx3,a.dx4,a.dx5,w.name AS ward_name,w.ward as ward 
from patient p 
LEFT OUTER JOIN an_stat a ON a.hn=p.hn
LEFT OUTER JOIN ward w ON w.ward=a.ward
left outer join marrystatus m on p.marrystatus=m.code 
where a.hn = '$Hn' and a.an='$An'");

}else{
if ($_REQUEST['method'] == 'select') {
    $An=$_REQUEST['an'];
    $Hn = $_REQUEST['patient'];
     $sql = mysqli_query($db,"select p.*,m.name as mrname,a.an,a.pdx,a.dx0,a.dx1,a.dx2,a.dx3,a.dx4,a.dx5,w.name AS ward_name,w.ward as ward 
from patient p 
LEFT OUTER JOIN an_stat a ON a.hn=p.hn
LEFT OUTER JOIN ward w ON w.ward=a.ward
left outer join marrystatus m on p.marrystatus=m.code 
where a.hn = '$Hn' and a.an='$An'");
 } elseif($_REQUEST['method'] == 'opd') {
     $Vn=$_REQUEST['vn'];
     $Hn = $_REQUEST['patient'];
     $sql = mysqli_query($db,"select p.*,m.name as mrname,v.vn,v.pdx,v.dx0,v.dx1,v.dx2,v.dx3,v.dx4,v.dx5 
from patient p 
LEFT OUTER JOIN vn_stat v ON v.hn=p.hn
left outer join marrystatus m on p.marrystatus=m.code 
where v.hn = '$Hn' and v.vn='$Vn'");
}}
 
$show = mysqli_fetch_assoc($sql);
$fullname = "$show[pname]$show[fname] $show[lname]";
include 'plugins/funcDateThai.php';
?>
<section class="content-header">
            <h1><img src='images/adduser.ico' width='40'><font color='blue'>  ระบบส่งผู้ป่วย </font></h1>   
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
              <li><a href="index.php?page=transfer/transfer"><i class="fa fa-home"></i> ส่งบำบัด</a></li>
              <li class="active"><i class="fa fa-gear"></i> ส่งรับการบำบัด</li>
            </ol>
</section>
<section class="content">
<div class="col-lg12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-star"></i> ข้อมูลคนไข้</h3>
        </div>
        <div class="panel-body" align="center">
            <?php if(empty($_REQUEST['method'])){ ?>
            <form class="navbar-form navbar-left" role="form" action='index.php?page=process/confirm' enctype="multipart/form-data" method='post' onSubmit="return Check_txt()">            
            <?php }elseif ($_REQUEST['method'] == 'select') {?>
            <form class="navbar-form navbar-left" role="form" action='index.php?page=process/prc_transfer' enctype="multipart/form-data" method='post' onSubmit="return Check_txt()">
            <?php }?>
            
                <table width="100%" border="0">
                    <tr>
                        <td width="65%"> <b><h4>HN :
  <?= $show['hn'] ?>
                                    <?php if(empty($_REQUEST['method'])){ ?>
                                    &nbsp;&nbsp; &nbsp;&nbsp; AN : <?= $show['an'] ?>&nbsp;&nbsp; &nbsp;&nbsp; WARD : <?= $show['ward_name'] ?>
                        </h4>
                                <?php }elseif ($_REQUEST['method'] == 'opd') {?>
                            &nbsp;&nbsp; &nbsp;&nbsp; VN : <?= $show['vn'] ?></h4>
                                <?php }?> </b>  
                        </td>
                        <td width="35%" rowspan="10" align="center" valign="top">
                            
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
                        <td><h4>การวินิจฉัยโรค : <?= $show['pdx']?>&nbsp;&nbsp; <?= $show['dx0']?>&nbsp;&nbsp; 
                            <?= $show['dx1']?>&nbsp;&nbsp; <?= $show['dx2']?>&nbsp;&nbsp; <?= $show['dx3']?>&nbsp;&nbsp; <?= $show['dx4']?>&nbsp;&nbsp; <?= $show['dx5']?></h4></td>
                    </tr>
                    <tr>
                        <?php
                       if(empty($_REQUEST['method']) or $_REQUEST['method'] == 'opd'){ 
            $sql_pre=  mysqli_query($db,"select t.*,c.name as clinic,d.name as doctor,
(select d.name from doctor d where d.code=t.re_name) re_name,
(select d.name from doctor d where d.code=t.tr_name) tr_name
from jvlmatrix_transfer t
left outer join clinic c on c.clinic=t.clinic
left outer join doctor d on d.code=t.doctor
where t.hn='$Hn'");
            $preview=  mysqli_fetch_assoc($sql_pre);
        ?>
                            
                    <td valign="top">
                                <b>ส่งให้&nbsp;&nbsp;</b> <?=$preview['clinic']?>
    				
                             </td>
                      </tr>
                      <tr>
                          <td>
                                <b>ส่งมาเพื่อ&nbsp;&nbsp;</b> <?=$preview['reason']?>
                          </td>
                      </tr>
                      <tr>
                          <td>
                <b>สาเหตุที่ส่ง/อาการ/ความจำเป็น&nbsp;&nbsp;</b> <?=$preview['note']?>
                          </td>
                          <td rowspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td valign="top">
                                <b>แพทย์เจ้าของไข้&nbsp;&nbsp;</b>  <?=$preview['doctor']?>
                            </td>
                      </tr>
                      <tr>
                          <td>
                              <b>ผู้ส่งบำบัด&nbsp;&nbsp;</b> <?=$preview['tr_name']?>
                          </td>
                      </tr>
                      <tr>
                          <td>
                      <div class="form-group"> 
                <label>สรุป : ความเห็น / ผลจากการให้คำปรึกษา</label>
                <TEXTAREA value='' NAME="re_transfer" id="re_transfer"  class="form-control" cols="30" rows=""><?php if(isset($edit_person['empnote'])){ echo $edit_person['empnote'];} ?></TEXTAREA>
                    </div>

                          </td>
                      </tr>
                      
                      
                      <tr>
                        <td colspan="2" align="center">
                            <br>
                       <?php }
                       if(empty($_REQUEST['method'])){ ?>
                            <input type="hidden" name="hn" value="<?=$Hn?>">
                            <input type="hidden" name="an" value="<?=$An?>">
                            <input type="submit" class="btn btn-success" name="method" value="submit">
                            <input type="submit" class="btn btn-danger" name="method" value="cancle">
                       <?php }elseif($_REQUEST['method'] == 'opd') {?>
                            <a href="index.php?page=regis/detial&hn=<?=$Hn?>&method=opd" class="btn btn-success">ลงทะเบียน</a>
                         <?php }elseif($_REQUEST['method']=='cancle'){?>
                        </td>
                      </tr>
                      <tr>
                          <td>
                        <b>สรุป : ความเห็น / ผลจากการให้คำปรึกษา&nbsp;&nbsp;</b>  <?=$preview['re_transfer']?>                    

                          </td>
                      </tr>
                      <tr>
                          <td>
                              <b>ผู้ให้คำปรึกษา&nbsp;&nbsp;</b> <?=$preview['re_name']?>
                          </td>
                      </tr>
                         <?php }elseif ($_REQUEST['method'] == 'select') {?>
                        <td valign="top">
                            <div class="form-group">
                                <label>ส่งให้&nbsp;&nbsp;</label>
    				<select name="clinics" id="clinics" required  class="form-control">
                                    <?php
                                    $sql = mysqli_query($db,"SELECT *  FROM clinic where chronic='Y'");
                                    echo "<option value=''>--เลือกคลินิค--</option>";
                                    while ($result = mysqli_fetch_assoc($sql)) {
                                        if ($result['clinic'] == $interview['alcohol_type']) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        echo "<option value='".$result['clinic']."' $selected>".$result['name']." </option>";
                                    }
                                    ?>
				 </select>
                     </div>
                            </td>
                      </tr>
                      <tr>
                          <td height="62">
                              <div class="form-group">
                                  <label for="reason">ส่งมาเพื่อ</label>
                                <textarea value='' name="reason" id="reason"  class="form-control" cols="72" rows=""><?php if(isset($edit_person['empnote'])){ echo $edit_person['empnote'];} ?></textarea>
                              </div>
                          </td>
                      </tr>
                      <tr>
                          <td height="64">
                      <div class="form-group"> 
                          <label for="note">สาเหตุที่ส่ง/อาการ/ความจำเป็น</label>
                <TEXTAREA value='' NAME="note" id="note"  class="form-control" cols="50" rows=""><?php if(isset($edit_person['empnote'])){ echo $edit_person['empnote'];} ?></TEXTAREA>
                    </div>

                          </td>
                          <td rowspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td valign="top">
                            <div class="form-group">
                                <label>แพทย์เจ้าของไข้&nbsp;&nbsp;</label>
    				<select name="doctor" id="doctor" required  class="form-control">
                                    <?php
                                    $sql = mysqli_query($db,"SELECT *  FROM opduser where groupname='DOCTOR'");
                                    echo "<option value=''>--เลือกผู้ส่ง--</option>";
                                    while ($result = mysqli_fetch_assoc($sql)) {
                                        if ($result['doctorcode'] == $interview['alcohol_type']) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        echo "<option value='".$result['doctorcode']."' $selected>".$result['name']." </option>";
                                    }
                                    ?>
				 </select>
                     </div>
                            </td>
                      </tr>
                      <tr>
                        <td colspan="2" align="center">
                            <br>
                            <input type="hidden" name="method" value="transfer">
                            <input type="hidden" name="an" value="<?= $show['an'];?>">
                            <input type="hidden" name="ward" value="<?= $show['ward'];?>">
                            <input type="hidden" name="hn" value="<?= $show['hn'];?>">
                            <input type="submit" name="submit" id="submit" class="btn btn-success" value="ส่งรับการบำบัด">
    <?php }?></td>
                      </tr>

                    </table>
                        </form>
                    <p>&nbsp;</p>
  </div></div>
</div></section>  
