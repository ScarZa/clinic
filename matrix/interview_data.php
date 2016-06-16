<?php
    $sql_inter_table=  mysqli_query($db,"select i.hn,i.matrix_id,i.regdate,d.name,i.type_patient from jvlmatrix_alcohol_interview i
            left outer join doctor d on d.code=i.doctor
            where i.hn='$Hn'");
?>
<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" class="divider" rules="rows" frame="below">  
                            <thead>
                                <tr bgcolor='#898888'>
                            <th align="center">ลำดับ </th>
                            <th align="center">วันที่สัมภาษณ์ </th>
                            <th align="center">ผู้สัมภาษณ์ </th>
                            <th align="center">ผู้ป่วย </th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php $i = 1;
                        while ($select = mysqli_fetch_assoc($sql_inter_table)) {
                            ?><tr>
                                <td><a href='index.php?page=matrix/interview&method=interview2&hn=<?= $select['hn'] ?>&matrix_id=<?= $select['matrix_id']?>'><center><?php echo $i; ?></center></a></td>
                                <td align="center"><a href='index.php?page=matrix/interview&method=interview2&hn=<?= $select['hn'] ?>&matrix_id=<?= $select['matrix_id']?>'><?php echo DateThai1($select['regdate']); ?></a></td>
                                <td><a href='index.php?page=matrix/interview&method=interview2&hn=<?= $select['hn'] ?>&matrix_id=<?= $select['matrix_id']?>'><center><?php echo $select['name']; ?></center></a></td>
                                <td><a href='index.php?page=matrix/interview&method=interview2&hn=<?= $select['hn'] ?>&matrix_id=<?= $select['matrix_id']?>'><center><?= $select['type_patient']; ?></center></a></td>
                            </tr>
    <?php
    $i++;
}
?>
                    </tbody>
                </table>
