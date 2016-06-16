<?php include ("connection/connect.php");
      include 'plugins/funcDateThai.php';?>
<section class="content-header">
    <h1><img src='images/adduser.ico' width='40'><font color='blue'>  ระบบส่งผู้ป่วย </font></h1> 
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
              <li class="active"><i class="fa fa-gear"></i> ส่งบำบัด</li>
            </ol>
</section>
<section class="content">
        <div class="col-lg12">
            <div class="box box-success box-solid">
                <div class="box-header">
            <h3 class="box-title"><i class="fa fa-star"></i> รายชื่อคนไข้ที่จะส่ง(IPD)</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <div class="col-lg-10"></div>
                        <div class="form-group col-lg-2" align="right">
                            <form action='index.php?page=transfer/transfer' name='person' method='post' id="person" enctype="multipart/form-data">
                                <div class="form-group input-group">
                                    <input type="date" name='an_date' id='an_date' value='' class="form-control" size="2">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i> ค้นหา</button> 
                                </span>
                                </div></form></div>
                        <div class="col-lg-10"></div>
                        <div class="form-group col-lg-2" align="right">
                            <form action='index.php?page=transfer/transfer' name='person' method='post' id="person" enctype="multipart/form-data">
                                <div class="form-group input-group">
                                    <input type="text" name='patiant' id='patiant' value='' class="form-control" size="2" placeholder="HN/AN/ชื่อ">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-warning"><i class="fa fa-search"></i> ค้นหา</button> 
                                </span>
                                </div></form></div>
                        <table id="example1" class="table table-bordered table-striped"> 
                            <thead>
                                <tr bgcolor='#898888'>
                                    <th align="center">ลำดับ </th>
                                    <th>วันที่ admit </th>
                                    <th>an </th>
                                     <th>hn </th>
                                      <th>หมายเลบัตรประชาชน </th>
                                    <th>ชื่อ - นามสกุล </th>
                                    <th>ที่อยู่ </th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                if(!empty($_POST['an_date'])){
                                    $code="WHERE (dchdate>'".$_POST['an_date']."' or dchdate is null) and regdate<='".$_POST['an_date']."'";
                                }elseif (!empty($_POST['patiant'])) { $Hn=$_POST['patiant'];
                                    $code="where a.hn like '%$Hn' or p.fname like '%$Hn%' or a.an like '%$Hn' ";
                                }  else {
                                   $code="and ISNULL(a.dchdate)"; 
                                }
                                
                                $sql=mysqli_query($db,"select * from an_stat a 
                                            inner join patient p on a.hn=p.hn
                                            $code
                                            order by a.an desc");
                                $i=1;
                                    while ($select = mysqli_fetch_assoc($sql)) {
                                        $p=$select['pname'];
                                        $f=$select['fname'];
                                        $l=$select['lname'];
                                        $full="$p$f  $l";
                                ?><tr>
                                        <td><center><?php echo $i; ?></center></td>
                                        <td><a href="index.php?page=transfer/detial_transfer&patient=<?= $select['hn']?>&an=<?= $select['an']?>&method=select"><?php echo DateThai1($select['regdate']); ?></a></td>
                                        <td><a href="index.php?page=transfer/detial_transfer&patient=<?= $select['hn']?>&an=<?= $select['an']?>&method=select"><?php echo $select['an']; ?></a></td>
                                        <td><a href="index.php?page=transfer/detial_transfer&patient=<?= $select['hn']?>&an=<?= $select['an']?>&method=select"><?php echo $select['hn']; ?></a></td>
                                        <td><center><a href="index.php?page=transfer/detial_transfer&patient=<?= $select['hn']?>&an=<?= $select['an']?>&method=select"><?php echo $select['cid']; ?></a></center></td>
                                        <td><a href="index.php?page=transfer/detial_transfer&patient=<?= $select['hn']?>&an=<?= $select['an']?>&method=select"><?php echo $full; ?></a></td>
                                        <td><?php echo $select['informaddr']; ?></td>
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