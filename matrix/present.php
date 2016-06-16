<?php include ("connection/connect.php"); 
include 'plugins/funcDateThai.php';?>
<section class="content-header">
    <h1><img src='images/adduser.ico' width='40'><font color='blue'>  ระบบคลินิคทานตะวัน </font></h1> 
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
              <li class="active"><i class="fa fa-gear"></i> ทะเบียนคลินิคทานตะวัน</li>
            </ol>
</section>
<section class="content">
<div class="col-lg12">
    <div class="box box-success box-solid">
                <div class="box-header">
            <h3 class="box-title"><i class="fa fa-star"></i> ทะเบียนคนไข้คลินิคทานตะวัน</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped" width="100%">
                            <thead>
                        <tr bgcolor='#898888'>
                            <th align="center">ลำดับ </th>
                            <th>hn </th>
                            <th>วันที่ลงทะเบียน </th>
                            <th>ชื่อ - นามสกุล </th>
                            <th>รับการรักษา </th>
                            <th>สถานะการรักษา </th>
                            <th>สัมภาษณ์สุรา </th>
                            <th>สัมภาษณ์ยาเสพติด </th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = mysqli_query($db,"select j1.hn,concat(p.pname,p.fname,' ',p.lname) as fullname,p.cid as cid,p.informaddr as informaddr ,j1.m_type as type,j1.regdate,
                                        c.clinic_member_status_name as clinic_status,j1.matrix_id as regmatrix,i.matrix_id as intmatrix
                                        from jvlmatrix_register j1
					LEFT OUTER JOIN jvlmatrix_alcohol_interview i on i.matrix_id=j1.matrix_id
                                        left outer join patient p on p.hn=j1.hn
                                        left outer join clinic_member_status c on c.clinic_member_status_id=j1.m_status
                                        order by j1.matrix_id desc");
                        $i = 1;
                        while ($select = mysqli_fetch_assoc($sql)) {
                            ?><tr>
                                <td><a href='index.php?page=matrix/report_patient&hn=<?= $select['hn'] ?>'><center><?php echo $i; ?></center></a></td>
                                <td><a href='index.php?page=matrix/report_patient&hn=<?= $select['hn'] ?>'><center><?php echo $select['hn']; ?></center></a></td>
                                <td><a href='index.php?page=matrix/report_patient&hn=<?= $select['hn'] ?>'><center><?= DateThai1($select['regdate']); ?></center></a></td>
                                <td><a href='index.php?page=matrix/report_patient&hn=<?= $select['hn'] ?>'><?php echo $select['fullname']; ?></a></td>
                                
                                <td><center><?php
                                            if ($select['type'] == '1') {
                                                echo 'สุรา';
                                            } elseif ($select['type'] == '2') {
                                                echo 'ยาเสพติด';
                                            }
                                            ?></center></td>
                                <td><center><?= $select['clinic_status']; ?></center></td>
                                <td><?php
                                 if($select['type']=='1'){
                                if($select['regmatrix']!=$select['intmatrix']){?>
                                    <a href='index.php?page=matrix/interview&hn=<?= $select['hn'] ?>'><center><img src="images/beer.ico" width="30"></center></a>
                                <?php }else{?>
                                    <center><img src="images/Symbol_-_Check.ico" width="30"></center>
                                 <?php }}else{?>
                                    <center><img src="images/button_cancel.ico" width="30"></center>
                        <?php }?>
                </td>
                                 <td><?php if($select['type']=='2'){?>
                                <a href='#?hn=<?= $select['hn'] ?>'><center><img src="images/Skull_and_bones.ico" width="30"></center></a>
                        <?php }else{?>
                                 <center><img src="images/button_cancel.ico" width="30"></center>
                        <?php }?>
                                 </td>
                            </tr>
    <?php
    $i++;
}
?>
                    </tbody>
                </table>
            </div>
        </div></div></div>
</section>