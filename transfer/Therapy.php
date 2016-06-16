<?php include ("connection/connect.php"); 
    include 'plugins/funcDateThai.php';?>
<section class="content-header">
    <h1><img src='images/adduser.ico' width='40'><font color='blue'>  ระบบส่งผู้ป่วย </font></h1> 
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
              <li class="active"><i class="fa fa-gear"></i> รอรับการบำบัด</li>
            </ol>
</section>
<section class="content">
<div class="col-lg12">
    <div class="box box-success box-solid">
                <div class="box-header">
            <h3 class="box-title"><i class="fa fa-star"></i> รายชื่อคนไข้ที่รอรับการบำบัด</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">
<table id="example1" class="table table-bordered table-striped">
    <thead>
                                <tr bgcolor='#898888'>
                            <th align="center">ลำดับ </th>
                            <th>an </th>
                            <th>hn </th>
                            <th>วันที่ลงทะเบียน </th>
                            <th>ชื่อ - นามสกุล </th>
                            <th>หมายเลบัตรประชาชน </th>
                            <th>รับการบำบัดที่ </th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php
                            $sql = mysqli_query($db,"select t.an,t.hn,concat(p.pname,p.fname,' ',p.lname) as fullname,p.cid as cid,t.tr_date,c.name as clinic_name
                                        from jvlmatrix_transfer t
                                        left outer join clinic c on c.clinic=t.clinic
                                        left outer join patient p on p.hn=t.hn
                                        where ISNULL(t.status)
                                        order by t.transfer_id desc limit 100");
                         $i = 1;
                        while ($select = mysqli_fetch_assoc($sql)) {
                            ?><tr>
                                <?php if($_SESSION['clinic_user']!='' or $_SESSION['status_user']=='ADMIN'){?>
                                <td><a href='index.php?page=transfer/detial_transfer&hn=<?= $select['hn'] ?>&an=<?= $select['an']?>'><center><?php echo $i; ?></center></a></td>
                                <td><a href='index.php?page=transfer/detial_transfer&hn=<?= $select['hn'] ?>&an=<?= $select['an']?>'><?php echo $select['an']; ?></a></td>
                                <td><a href='index.php?page=transfer/detial_transfer&hn=<?= $select['hn'] ?>&an=<?= $select['an']?>'><center><?php echo $select['hn']; ?></center></a></td>
                                <td><a href='index.php?page=transfer/detial_transfer&hn=<?= $select['hn'] ?>&an=<?= $select['an']?>'><center><?= DateThai1($select['tr_date']); ?></center></a></td>
                                <td><a href='index.php?page=transfer/detial_transfer&hn=<?= $select['hn'] ?>&an=<?= $select['an']?>'><?php echo $select['fullname']; ?></a></td>
                                <td><a href='index.php?page=transfer/detial_transfer&hn=<?= $select['hn'] ?>&an=<?= $select['an']?>'><center><?php echo $select['cid']; ?></center></a></td>
                                <td><a href='index.php?page=transfer/detial_transfer&hn=<?= $select['hn'] ?>&an=<?= $select['an']?>'><center><?=$select['clinic_name']?></center></a></td>
                                <?php }else{?>
                                <td><center><?php echo $i; ?></center></td>
                                <td><?php echo $select['an']; ?></td>
                                <td><center><?php echo $select['hn']; ?></center></td>
                                <td><center><?= DateThai1($select['tr_date']); ?></center></td>
                                <td><?php echo $select['fullname']; ?></td>
                                <td><center><?php echo $select['cid']; ?></center></td>
                                <td><center><?=$select['clinic_name']?></center></td>
                                <?php }?>
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