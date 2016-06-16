<form name="form3" class="navbar-form navbar-left" role="form" action='index.php?page=process/prc_interview' enctype="multipart/form-data" method='post' onSubmit="return Check_txt()">
<div class="well well-sm">
    16.เหตุผลที่คุณเข้ารับการบำบัดรักษาครั้งนี้ &nbsp;&nbsp;
<div class="form-group">
    				<select name="cause_therapy" id="cause_therapy" required  class="form-control">
                                    <?php
                                    $sql = mysqli_query($db,"SELECT *  FROM jvlmatrix_alcohol_reason");
                                    echo "<option value=''>--เลือกเหตุผล--</option>";
                                    while ($result = mysqli_fetch_assoc($sql)) {
                                        if ($result['reason_id'] == $interview['cause_therapy']) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        echo "<option value='".$result['reason_id']."' $selected>".$result['reason_name']." </option>";
                                    }
                                    ?>
				 </select>
</div></div>
    <div class="well well-sm">
                     17.คุณคิดเห็นอย่างไรเกี่ยวกับการื่มสุราของคุณ <br>
<div class="form-group">
    				<select name="about_drink" id="about_drink" required  class="form-control">
                                    <?php
                                    $sql = mysqli_query($db,"SELECT *  FROM jvlmatrix_alcohol_review");
                                    echo "<option value=''>--เลือกความคิดเห็น--</option>";
                                    while ($result = mysqli_fetch_assoc($sql)) {
                                        if ($result['review_id'] == $interview['about_drink']) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        echo "<option value='".$result['review_id']."' $selected>".$result['review_name']." </option>";
                                    }
                                    ?>
				 </select>
                     </div><font color="red"> * หากเลือกอื่นๆโปรดระบุ</font>
                        <div class="form-group">
                            <input value="<?= $interview['about_other']; ?>" type="text" name="about_other" id="about_other" size="30" class="form-control">
                        </div></div>
    <div class="well well-sm">
            <b>ให้เลือกตัวเลข ว่าการดื่มของคุณมีปัญหาน้อยหรือมากเท่าไหร่ (จาก 1 ถึง 10)</b>&nbsp;&nbsp;
            <div class="form-group">
                <input value="<?= $interview['score']; ?>" class="form-control" type="number" name="score" min="1" max="10" placeholder="1" size="1">
            </div></div>
    <div class="well well-sm">
            18.สิ่งที่คาดหวังจากการบำบัดครั้งนี้ คือ&nbsp;&nbsp;
            <div class="form-group">
                <input value="<?= $interview['expect']; ?>" type="text" name="expect" id="expect" class="form-control" size="80">
            </div></div>
    <div class="well well-sm">
            19.ผลกระทบจากการดื่มสุราที่เกิดขึ้นกับคุณ<br>
            <?php if($interview['effect_body']=='1'){?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ด้านสุขภาพร่างกาย &nbsp;&nbsp;&nbsp;
            <input type="radio" name="effect_body" id="effect_body" value="0" /> ไม่มี&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="effect_body" id="effect_body" value="1" checked/> มี&nbsp;&nbsp;
            ระบุ &nbsp;<div class="form-group">
                <input value="<?= $interview['body']; ?>" type="text" name="body" id="body" class="form-control" size="40">
            <?php }else{?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ด้านสุขภาพร่างกาย &nbsp;&nbsp;&nbsp;
            <input type="radio" name="effect_body" id="effect_body" value="0" checked/> ไม่มี&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="effect_body" id="effect_body" value="1" /> มี&nbsp;&nbsp;
            ระบุ &nbsp;<div class="form-group">
                <input type="text" name="body" id="body" class="form-control" size="40">
            <?php }?>
            </div><br><p></p>
            <?php if($interview['effect_heart']=='1'){?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ด้านสุขภาพจิต &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="effect_heart" id="effect_heart" value="0" /> ไม่มี&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="effect_heart" id="effect_heart" value="1" checked/> มี&nbsp;&nbsp;
            ระบุ &nbsp;<div class="form-group">
                <input value="<?= $interview['heart']; ?>" type="text" name="heart" id="heart" class="form-control" size="40">
            <?php }else{?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ด้านสุขภาพจิต &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="effect_heart" id="effect_heart" value="0" checked/> ไม่มี&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="effect_heart" id="effect_heart" value="1" /> มี&nbsp;&nbsp;
            ระบุ &nbsp;<div class="form-group">
                <input type="text" name="heart" id="heart" class="form-control" size="40">
            <?php }?>
            </div><br><p></p>
            <?php if($interview['effect_social']=='1'){?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ด้านสังคม (การงาน/การเรียน/กฎหมาย/การเงิน/ชีวิตครอบครัว/ความสัมพันธ์)<br> 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="effect_social" id="effect_social" value="0" /> ไม่มี&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="effect_social" id="effect_social" value="1" checked/> มี&nbsp;&nbsp;
            ระบุ &nbsp;<div class="form-group">
                <input value="<?= $interview['social']; ?>" type="text" name="social" id="social" class="form-control" size="40">
            <?php }else{?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ด้านสังคม (การงาน/การเรียน/กฎหมาย/การเงิน/ชีวิตครอบครัว/ความสัมพันธ์)<br> 
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="effect_social" id="effect_social" value="0" checked/> ไม่มี&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="effect_social" id="effect_social" value="1" /> มี&nbsp;&nbsp;
            ระบุ &nbsp;<div class="form-group">
                <input type="text" name="social" id="social" class="form-control" size="40">
            <?php }?>
            </div></div>
            <div class="well well-sm">
            20.คุณเคยตื่นนอน แล้วมีอาการสั่น กระวนกระวายหรือไม่ (อาการเริ่มแรกของการขาดเหล้า)<br>
            <?php if($interview['shake']=='1'){?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="shake" id="shake" value="0" /> ไม่มี <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="shake" id="shake" value="1" checked="checked"/> มี 
            <?php }else{?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="shake" id="shake" value="0" checked="checked"/> ไม่มี <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="shake" id="shake" value="1" /> มี 
            <?php }?>
            </div>
            <div class="well well-sm">
                        21.ภายหลังจากที่ดื่มสุราจัด หรือดื่มติดต่อกันทุกวันเป็นเวลาหลายวัน แล้วลดปริมาณการดื่มลง (ดื่มน้อยกว่าที่เคยดื่ม) มีอาการดังต่อไปนี้หรือไม่<br>
                   <div class="form-group">
    				<select name="effect" id="effect" required  class="form-control">
                                    <?php
                                    $sql = mysqli_query($db,"SELECT *  FROM jvlmatrix_alcohol_effect");
                                    echo "<option value=''>--เลือกอาการ--</option>";
                                    while ($result = mysqli_fetch_assoc($sql)) {
                                        if ($result['effect_id'] == $interview['effect']) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        echo "<option value='".$result['effect_id']."' $selected>".$result['effect_name']." </option>";
                                    }
                                    ?>
				 </select>
                   </div></div>
            <div class="well well-sm">
                     22.ผลตรวจทางห้องปฏิบัติการ &nbsp;&nbsp;
                     <div class="form-group">
                <input value="<?= $interview['lab']; ?>" type="text" name="lab" id="lab" class="form-control" size="50">
                     </div></div>
            <div class="well well-sm">
            23.การดื่มสุรามีผลกระทบต่อคุณหรือคนรอบข้างอย่างไรบ้าง &nbsp;&nbsp;
                     <div class="form-group">
                <input value="<?= $interview['effect_around']; ?>" type="text" name="effect_around" id="effect_around" class="form-control" size="50">
                     </div></div>
            <div class="well well-sm">
            24.ความคิดเห็นและความรู้สึกของคุณต่อการื่มสุรา<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1.ผลดีของการดื่มสุราที่คุณชอบ &nbsp;&nbsp;
                     <div class="form-group">
                <input value="<?= $interview['good']; ?>" type="text" name="good" id="good" class="form-control" size="50">
            </div><br><p></p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2.ผลกระทบของสุราที่คุณเคยประสบ &nbsp;&nbsp;
                     <div class="form-group">
                <input value="<?= $interview['bad']; ?>" type="text" name="bad" id="bad" class="form-control" size="50">
            </div><br><p></p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 3.โทษร้ายของสุราที่คุณกลัวที่สุด &nbsp;&nbsp;
                     <div class="form-group">
                <input value="<?= $interview['effect_bad']; ?>" type="text" name="effect_bad" id="effect_bad" class="form-control" size="50">
            </div><br><p></p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 4.อะไรจะเกิดขึ้นหากคุณไม่เปลี่ยนแปลงการดื่ม หรือหยุดดื่มสุรา &nbsp;&nbsp;
                     <div class="form-group">
                <input value="<?= $interview['result']; ?>" type="text" name="result" id="result" class="form-control" size="50">
            </div><br><p></p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 5.คุณอยากหยุดดื่มเพราะ &nbsp;&nbsp;
                     <div class="form-group">
                <input value="<?= $interview['because_stop']; ?>" type="text" name="because_stop" id="because_stop" class="form-control" size="50">
            </div><br><p></p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 6. "อะไรทำให้คุณคิดว่า คุณเปลี่ยนแปลงการดื่มได้" &nbsp;&nbsp;
                     <div class="form-group">
                <input value="<?= $interview['change_mi']; ?>" type="text" name="change" id="change" class="form-control" size="50">
            </div><br><p></p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 7. คุณรู้สึกพอใจกับชีวิตปัจจุบันของคุณ? &nbsp;&nbsp;
                     <div class="form-group">
    				<select name="delight" id="delight" required  class="form-control">
                                    <?php
                                    $sql = mysqli_query($db,"SELECT *  FROM jvlmatrix_level");
                                    echo "<option value=''>--เลือกระดับ--</option>";
                                    while ($result = mysqli_fetch_assoc($sql)) {
                                        if ($result['level_id'] == $interview['delight']) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        echo "<option value='".$result['level_id']."' $selected>".$result['level_name']." </option>";
                                    }
                                    ?>
				 </select>
                     </div><br><p></p>
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 8. คุณรู้สึกว่าคุณเป็น<b>ที่รัก</b>ของครอบครัว? &nbsp;&nbsp;
                     <div class="form-group">
    				<select name="love" id="love" required  class="form-control">
                                    <?php
                                    $sql = mysqli_query($db,"SELECT *  FROM jvlmatrix_level");
                                    echo "<option value=''>--เลือกระดับ--</option>";
                                    while ($result = mysqli_fetch_assoc($sql)) {
                                        if ($result['level_id'] == $interview['love']) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        echo "<option value='".$result['level_id']."' $selected>".$result['level_name']." </option>";
                                    }
                                    ?>
				 </select>
                     </div><br><p></p>
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 9. คุณรู้สึกว่าคุณเป็น<b>ที่ยอมรับ</b>ของคนอื่น? &nbsp;&nbsp;
                     <div class="form-group">
    				<select name="accept" id="accept" required  class="form-control">
                                    <?php
                                    $sql = mysqli_query($db,"SELECT *  FROM jvlmatrix_level");
                                    echo "<option value=''>--เลือกระดับ--</option>";
                                    while ($result = mysqli_fetch_assoc($sql)) {
                                        if ($result['level_id'] == $interview['accept']) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        echo "<option value='".$result['level_id']."' $selected>".$result['level_name']." </option>";
                                    }
                                    ?>
				 </select>
                     </div><br><p></p>
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 10. คุณรู้สึกว่าเพื่อนๆหรือคนในชุมชนให้ความ<b>นับถือ</b>คุณ? &nbsp;&nbsp;
                     <div class="form-group">
    				<select name="esteem" id="esteem" required  class="form-control">
                                    <?php
                                    $sql = mysqli_query($db,"SELECT *  FROM jvlmatrix_level");
                                    echo "<option value=''>--เลือกระดับ--</option>";
                                    while ($result = mysqli_fetch_assoc($sql)) {
                                        if ($result['level_id'] == $interview['esteem']) {
                                            $selected = 'selected';
                                        } else {
                                            $selected = '';
                                        }
                                        echo "<option value='".$result['level_id']."' $selected>".$result['level_name']." </option>";
                                    }
                                    ?>
				 </select>
                     </div></div>
                     <div class="form-group">
                <input type="hidden" name="hn" value="<?=$show['hn'] ?>">
                <input type="hidden" name="matrix_id" value="<?= $show['matrix_id'] ?>">
                <input type="hidden" name="method" value="interview_mi">
                <?php if(empty($interview['mi'])) {?>
                <input type="submit" name="submit" id="submit" class="btn btn-success" value="บันทึก">
                <?php }?>
            </div>
</form>

