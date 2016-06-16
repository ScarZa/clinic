<?php include ("connection/connect.php");?>
<section class="content-header">
    <h1><img src='images/adduser.ico' width='40'><font color='blue'>  ระบบส่งผู้ป่วย OPD</font></h1>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
              <li class="active"><i class="fa fa-gear"></i> ส่งบำบัด</li>
            </ol>
</section>
<section class="content">
        <div class="col-lg12">
            <div class="box box-success box-solid">
                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-star"></i> รายชื่อคนไข้ที่จะส่ง(OPD)</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <div class="col-lg-10"></div>
                        <div class="form-group col-lg-2" align="right">
                            <form action='index.php?page=transfer/transfer_opd' name='person' method='post' id="person" enctype="multipart/form-data">
                                <div class="form-group input-group">
                                    <input type="date" name='vn_date' id='vn_date' value='' class="form-control" size="2">
                                <span class="input-group-btn">
                                    <input type='hidden' name='method' id='search' value="search">
                                    <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i> ค้นหา</button> 
                                </span>
                                </div></form></div>
                        <div class="col-lg-10"></div>
                        <div class="form-group col-lg-2" align="right">
                            <form action='index.php?page=transfer/transfer_opd' name='person' method='post' id="person" enctype="multipart/form-data">
                                <div class="form-group input-group">
                                    <input type="text" name='patient' id='patient' value='' class="form-control" size="2" placeholder="HN/VN/ชื่อ">
                                <span class="input-group-btn">
                                    <input type='hidden' name='method' id='search' value="search">
                                    <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i> ค้นหา</button> 
                                </span>
                                </div></form></div>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr bgcolor='#898888'>
                                    <th align="center">ลำดับ </th>
                                    <th>vn </th>
                                     <th>hn </th>
                                      <th>หมายเลบัตรประชาชน </th>
                                    <th>ชื่อ - นามสกุล </th>
                                    <th>ที่อยู่ </th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php 
                                if(isset($_POST['method'])){
                                if(!empty($_POST['vn_date'])){
                                    $date=$_POST['vn_date'];
                                    $code="where v.vstdate between '$date' and '$date'";
                                    }elseif (!empty ($_POST['patient'])) {
                                    $Hn=$_POST['patient'];
                                    $code="where v.hn like '%$Hn' or p.fname like '%$Hn%' or v.vn like '%$Hn'";    
    }
                                    $sql=mysqli_query($db,"select CONCAT(p.pname,p.fname,' ',p.lname) as fullname,v.vn,v.hn,p.cid,p.informaddr from patient p 
                                            left outer join vn_stat v on v.hn=p.hn
                                            $code
                                            order by v.vn desc");
                                
                                $i=1;
                                    while ($select = mysqli_fetch_assoc($sql)) {
                                ?><tr>
                                        <td><center><?php echo $i; ?></center></td>
                                        <td><a href="index.php?page=transfer/detial_transfer&patient=<?= $select['hn']?>&vn=<?= $select['vn']?>&method=opd"><?php echo $select['vn']; ?></a></td>
                                        <td><a href="index.php?page=transfer/detial_transfer&patient=<?= $select['hn']?>&vn=<?= $select['vn']?>&method=opd"><?php echo $select['hn']; ?></a></td>
                                        <td><center><a href="index.php?page=transfer/detial_transfer&patient=<?= $select['hn']?>&vn=<?= $select['vn']?>&method=opd"><?php echo $select['cid']; ?></a></center></td>
                                        <td><a href="index.php?page=transfer/detial_transfer&patient=<?= $select['hn']?>&vn=<?= $select['vn']?>&method=opd"><?php echo $select['fullname']; ?></a></td>
                                        <td><?php echo $select['informaddr']; ?></td>
                                </tr>
        <?php
        $i++;
                                }}
    ?>
                                </tbody>
                        </table>
                                      </div>
                </div></div></div>
</section>