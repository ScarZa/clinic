<?php
include 'connection/connect.php';
include 'connection/db_connect.php';
include 'connection/function.php';
?>
<?php
if (empty($_SESSION['usermatrix'])) {
    echo "<meta http-equiv='refresh' content='0;url=index.php'/>";
    exit();
}
//$matrix_Id=$_REQUEST['matrix_id'];
$Hn = $_REQUEST['hn'];
$sql = mysqli_query($db, "select p.*,m.name as mrname,j1.address as address,j1.tell1,j1.person1,j1.tell2,j1.person2,j1.tell3,j1.person3,
        j1.matrix_id as matrix_id,a.pdx,a.dx0,a.dx1,a.dx2,a.dx3,a.dx4,a.dx5
        from patient p
        left outer join an_stat a on a.hn=p.hn
        left outer join marrystatus m on p.marrystatus=m.code 
        left outer join jvlmatrix_register j1 on j1.hn=p.hn 
	where j1.hn = '$Hn'");
$show = mysqli_fetch_assoc($sql);
$fullname = $show['pname'] . $show['fname'] . ' ' . $show['lname'];

include_once ('plugins/funcDateThai.php');
?>
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
        <li><a href="index.php?page=matrix/present"><i class="fa fa-gear"></i> ทะเบียนคลินิคทานตะวัน</a></li>
        <li class="active"><i class="fa fa-gear"></i> ข้อมูลผู้ป่วยที่รับบำบัด</li>
    </ol>
</section><br>
<section class="content">
     <div class="col-lg12">
    <div class="box box-primary box-solid">
                <div class="box-header">
                    <h3 class="box-title">ข้อมูลผู้ป่วย</h3>
                </div>
                <div class="box-body">
            <div class="box box-success box-solid">
                <div class="box-header">
                    <h3 class="box-title">ข้อมูลผู้ป่วยที่รับบำบัด</h3>
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
        

            <div class="box box-warning box-solid">
                <div class="box-header">
                    <h3 class="box-title">ข้อมูลการบำบัด</h3>
                </div>
                <div class="box-body">
                    <h2 id="nav-tabs"></h2>
                    <div class="bs-example">
                        <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                            <li class="active"><a href="#home" data-toggle="tab">สัมภาษณ์</a></li>
                            <li><a href="#search" data-toggle="tab">การค้นหาความเสี่ยง</a></li>
                            <li><a href="#analyze" data-toggle="tab">การวิเคราะห์ความเสี่ยง</a></li>
                            <li><a href="#manage" data-toggle="tab">การจัดการความเสี่ยง</a></li>
                            <li><a href="#evaluation" data-toggle="tab">การประเมินผล</a></li>
                            <li><a href="#savety" data-toggle="tab">การจัดการให้ปลอดภัย</a></li>
                            <!-- 
                             <li class="dropdown"> 
                               <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                 Dropdown <span class="caret"></span>
                               </a>
                               <ul class="dropdown-menu">
                                 <li><a href="#dropdown1" data-toggle="tab">Action</a></li>
                                 <li class="divider"></li>
                                 <li><a href="#dropdown2" data-toggle="tab">Another action</a></li>
                               </ul>
                             </li>
                            -->
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane fade active in" id="home">
<?php include 'matrix/interview_data.php'; ?>
                            </div>
                            <div class="tab-pane fade" id="search">
                                <p><label>เราสามารถค้นหาความเสี่ยงได้จาก</label> <br />
                                    1.  เรียนรู้จากบทเรียนของผู้อื่น เช่น รายงานจากสื่อมวลชน การพูดคุยกับผู้เชี่ยวชาญ การเรียนรู้จากโรงพยาบาลอื่น <br />
                                    2.  ทบทวนความรู้ทางวิชาการ เช่น การทบทวนวรรณกรรม (รวมทั้ง patient safety guide :SIMPLE) <br />
                                    3.  ทบทวนบทเรียนของเราเอง <br />
                                    • เหตุการณ์ที่เคยเกิดขึ้นแล้ว เช่น รายงานอุบัติการณ์ การทบทวนเวชระเบียน กิจกรรมทบทวนทางคลินิก ตัวชี้วัดต่าง ๆ บันทึกต่าง ๆ	 <br />		
                                    • เหตุการณ์ที่ยังไม่เคยเกิดขึ้น เช่น การวิเคราะห์กระบวนการ, การตามรอยทางคลินิก, การสำรวจในสถานที่จริง, การตามรอยกระบวนการ, การวิเคราะห์ FMEA (โอกาสที่จะเกิดปัญหาขึ้นในอนาคตในระบบงานใหม่ เครื่องมือใหม่ สถานที่ปฏิบัติงาน โดยตั้งคำถาม”จะเป็นอย่างไรถ้า.....”) <br />
                                    •  ค้นหาจากประสบการณ์ของบุคคล <br />
                                </p>
                            </div>
                            <div class="tab-pane fade" id="analyze">
                                <p> รายการความเสี่ยงที่ค้นหาได้ อาจรวบรวมไว้ในบัญชีรายการความเสี่ยงของหน่วยงานหรือตารางเก็บข้อมูลเพื่อนำมาวิเคราะห์ความสำคัญของความเสี่ยง
                                    อาจจัดหมวดหมู่ของความเสี่ยงเพื่อจะได้ค้นหาได้ครอบคลุม เช่น ด้านอันตรายต่อผู้ป่วย ด้านอันตรายต่อเจ้าหน้าที่ ด้านสิ่งแวดล้อม ด้านข้อมูลข่าวสาร<br /><br />
                                    <img src='images/risk_matrix2.jpg' /> <br /><br />
                                    <img src='images/risk_matrix3.jpg' /> <br />
                                </p>
                            </div>
                            <div class="tab-pane fade" id="manage">
                                <p>
                                <h1><small>การจัดการความเสี่ยงก่อนเกิดเหตุ</small></h1>
                                <label>ก.  นำรายการความเสี่ยงที่สำคัญจากข้อ 1  มาจัดทำบัญชีความเสี่ยงของหน่วยงาน</label>  โดยรายการความเสี่ยงที่มีระดับความสำคัญสูง และปานกลาง  ต้องมีแผนการจัดการความเสี่ยง ทุกรายการ <br />

                                <label>ข.  วิธีการควบคุมความเสี่ยง</label> <br />
                                1)   หลีกเลี่ยงความเสี่ยง <br />
                                2)   ถ่ายโอนความเสี่ยง <br />
                                3)   การแบ่งแยกความเสี่ยง <br />
                                4)   การป้องกันความเสี่ยง <br />
                                &nbsp;&nbsp;&nbsp;-  การปกป้อง การใช้เครื่องป้องกัน <br />
                                &nbsp;&nbsp;&nbsp;-  การมีระบบบำรุงรักษาเชิงป้องกันและมาตรฐานเกี่ยวกับเครื่องมือ <br />
                                &nbsp;&nbsp;&nbsp;-  การมีระเบียบปฏิบัติและวิธีปฏิบัติในการทำงาน <br />
                                &nbsp;&nbsp;&nbsp;-  การควบคุมกำกับ <br />
                                &nbsp;&nbsp;&nbsp;-  การให้ความรู้ ทักษะแก่เจ้าหน้าที่ <br />

                                <label>ค.  การจัดทำมาตรการจัดการความเสี่ยง</label> <br />
                                1)   แนวทางป้องกัน การจัดระบบป้องกันความผิดพลาด      <br />
                                &nbsp;&nbsp;&nbsp;-   การเตรียมคน<br />
                                &nbsp;&nbsp;&nbsp;-   การเตรียมอุปกรณ์เครื่องมือ<br />
                                &nbsp;&nbsp;&nbsp;-   การเตรียมข้อมูลข่าวสาร<br />
                                &nbsp;&nbsp;&nbsp;-   วิธีปฏิบัติงานที่รัดกุม<br />
                                &nbsp;&nbsp;&nbsp;-   การควบคุมกระบวนการ<br />
                                2)   แนวทางปฏิบัติเมื่อเกิดปัญหา<br />
                                &nbsp;&nbsp;&nbsp;-  การตรวจพบปัญหา จะตรวจพบปัญหาให้เร็วที่สุดได้อย่างไร โดยใคร เป็นการจัดการวิธีค้นหาความผิดพลาดเหล่านั้นให้ปรากฏเพื่อเราจะได้หยุดได้ทัน<br />
                                &nbsp;&nbsp;&nbsp;-  การลดความเสียหาย จะแก้ปัญหาอย่างไร  โดยใคร เป็นการจัดระบบที่ลดความรุนแรงของความเสียหายเมื่อความผิดพลาดดังกล่าวไม่สามารถหยุดได้ทัน<br />
                                &nbsp;&nbsp;&nbsp;-  การรายงาน ควรรายงานให้ผู้บังคับบัญชาทราบถึงระดับใด วิธีใด<br />
                                <h1><small>การจัดการความเสี่ยงเมื่อเกิดเหตุ</small></h1>
                                <label>ก.  การระงับเหตุ</label>
                                -  เมื่อสถานการณ์ความเสี่ยงเกิดขึ้น ให้ผู้ประสบเหตุ เข้าระงับเหตุทันที  ถ้าไม่สามารถระงับเหตุได้ แจ้งหัวหน้าหน่วยงานทันที เฉพาะเหตุที่เกี่ยวข้องกับความปลอดภัยในชีวิตและทรัพย์สิน ให้แจ้งเจ้าหน้าที่รักษาความปลอดภัยทันที
                                -  กรณีหัวหน้าฝ่ายงาน ระงับเหตุไม่ได้ ให้รายงานแพทย์เวรหรือแพทย์เจ้าของไข้ พิจารณาสั่งการระงับเหตุทางการแพทย์  หรือให้รายงานหัวหน้าฝ่ายบริหารงานทั่วไป พิจารณาสั่งการระงับเหตุด้านอื่น ๆ <br />
                                <label>ข.  การรายงานอุบัติการณ์</label><br />
                                -  ผู้ประสบเหตุ เป็นผู้เขียนบันทึกอุบัติการณ์ รายงานหัวหน้าหน่วยงานทราบภายใน 24 ชั่วโมง<br />
                                -  กรณีมีผู้ประสบเหตุหลายคน ให้ผู้ที่เป็นหัวหน้าเวร เป็นผู้เขียนบันทึก<br />
                                -  กรณีเป็นคำร้องเรียน ผู้รับคำร้องเรียนเป็นผู้เขียนบันทึกอุบัติการณ์<br />
                                -  กรณีเป็นเรื่องที่อาจเกิดการฟ้องร้องหรือเสื่อมเสียชื่อเสียงของโรงพยาบาลหรือบุคคล ให้รายงานด้วยใบบันทึกอุบัติการณ์และเก็บรักษาในที่ปลอดภัย<br />
                                -  กรณีเหตุการณ์รุนแรงระดับGHIขึ้นไปหรือเป็นเหตุการณ์ที่เฝ้าระวังเป็นพิเศษ ให้มีการรายงานด้วยวาจาก่อนทันทีที่ทำได้ กรณีอุบัติการณ์มีความรุนแรงสูง ให้รายงานผู้อำนวยการทันที<br />							
                                <label>ค.  หัวหน้าหน่วยงาน ตรวจสอบ วิเคราะห์ความรุนแรง  สาเหตุเบื้องต้นและสาเหตุเชิงระบบ Root  cause  analysis(RCA) และวางแผนการปรับปรุงตามความสำคัญของเหตุการณ์</label><br /><br /> 
                                <img src='images/risk_matrix4.jpg' /> <br />
                                </p>
                            </div>				
                            <div class="tab-pane fade" id="evaluation">
                                <label>การนำเหตุการณ์ และความสูญเสียที่เกิดขึ้นมาตรวจสอบทบทวนสาเหตุโดยให้ความสำคัญกับอุบัติการณ์ที่เกิดขึ้นซ้ำ หรือรุนแรงคำถามที่ต้องถามคือ</label>
                                <ul>
                                    <li>อุบัติการณ์นี้เกิดขึ้นได้อย่างไรทั้งที่มีมาตรการป้องกันแล้ว</li>   
                                    <li>อุบัติการณ์นี้มีสาเหตุจากระบบหรือไม่  มีโอกาสที่จะเกิดขึ้นอีกได้หรือไม่</li>  
                                    <li>สาเหตุราก หรือ รากเหง้าของปัญหา คืออะไร </li>     	              
                                </ul> 
                                -   การทบทวนว่ากลยุทธ์ที่ใช้อยู่นั้นได้ผลดีหรือไม่ โดยการติดตามแนวโน้มของการเกิดอุบัติการณ์ การเกิดซ้ำ ความรุนแรง ติดตามแผนการแก้ไขปรับปรุงตามสาเหตุราก และตรวจสอบว่า มาตรการที่ใช้ป้องกัน เหมาะสมหรือไม่<br />
                                -   ตรวจสอบความเสี่ยงที่เกิดขึ้นใหม่<br />
                                -   การประเมินผลเป็นการสะท้อนกลับ( feedback) ซึ่งจะก่อให้เกิดการปรับปรุงอย่างต่อเนื่อง หรือการแก้ไขกิจกรรมที่ดำเนินการไปแล้ว<br />
                                -   การหาสาเหตุราก<br />
                            </div>

                            <div class="tab-pane fade" id="savety">	
                                <label>ความผิดพลาดนั้นเป็นคุณสมบัติที่สำคัญของมนุษย์  ดังนั้นการจัดการเพื่อความปลอดภัยของผู้ป่วยจึงยึดหลักว่า  แม้ว่าเราไม่สามารถเปลี่ยนแปลงพฤติกรรมของมนุษย์ที่ทำให้เกิดความผิดพลาด  แต่เราสามารถออกแบบระบบที่ลดความผิดพลาดเพื่อให้ผู้ป่วยได้รับความปลอดภัย
                                    โดยมียุทธศาสตร์ที่สำคัญในการจัดระบบสามประการ  ได้แก่ </label><br />
                                1. การจัดระบบป้องกันความผิดพลาด  เช่นการใช้คอมพิวเตอร์  ระงับการจ่ายยาที่ผู้ป่วยมีประวัติแพ้ยา  การใช้  CareMap  ในการสั่งการรักษาโรคที่มีรายละเอียดมาก  เป็นต้น<br />
                                2. การจัดการวิธีค้นหาความผิดพลาดเหล่านั้นให้ปรากฏเพื่อเราจะได้หยุดได้ทัน  เช่น  การตรวจซ้ำในเรื่องชนิด  และขนาดของยาอันตรายที่จะให้ผู้ป่วย   การรายงานอุบัติการณ์ความผิดพลาดโดยยังไม่เกิดอันตรายกับผู้ป่วย  การทบทวนการดูแลผู้ป่วย  เป็นต้น<br />
                                3. การจัดระบบที่ลดความรุนแรงของความเสียหายแม้ความผิดพลาดดังกล่าวไม่สามารถหยุดได้ทันจนทำให้เกิดอุบัติการณ์ที่ไม่พึงประสงค์  เช่น  การเตรียม  antidote  ให้พร้อมใช้หากมีการใช้ยาอันตราย  ผิดพลาด  การเตรียมพร้อมเพื่อช่วยฟื้นคืนชีพผู้ป่วย  เป็นต้น<br /><br />
                                <label>เทคนิค  ในการจัดการเพื่อลดความผิดพลาด  และเหตุการณ์ไม่พึงประสงค์  ได้แก่</label><br />
                                1. การลดการพึงพาความจำ  เช่น  การใช้  checklist,  protocol,  CPG,  CareMap  ในขั้นตอนที่เสี่ยงสูง  หรือผิดพลาดได้ง่าย<br />
                                2. การใช้ข้อมูลที่สะดวก  เช่น  การออกแบบเวชระเบียนที่สะดวกต่อการหาข้อมูลจำเป็นของผู้ป่วย  การรายงานอุบัติการณ์ที่ไม่ยุ่งยาก<br />
                                3. ระบบความป้องกันความผิดพลาด  เช่น  มีระบบที่แจ้งเตือน  หรือระบบห้ามสั่งยาที่ผู้ป่วยแพ้ <br />
                                4. การปรับให้ระบบงานเป็นมาตรฐานเดียวกัน  เช่น  การจัดทำวิธีปฏิบัติงาน <br />
                                5. การฝึกอบรมให้บุคลากรมีความรู้อย่างเพียงพอในเรื่องที่จำเป็น  เช่น  การอบรมการบริหารความเสี่ยง  การอบรมความรู้เรื่องโรคหรือหัตถการที่มีความเสี่ยงสูง<br />
                                6. การทบทวนกระบวนการ เพื่อลดความซับซ้อน  หรือขั้นตอน  ทางเลือก  เวลา <br />
                                7. การลดความเสี่ยงหากมีความเปลี่ยนแปลงระบบ  เช่น  กำหนดข้อควรระวัง  ทดลองปฏิบัติ  ติดตามผลลัพธ์<br />
                                8. การลดความเครียดในการทำงาน  เช่น  การจัดสิ่งแวดล้อมที่ช่วยลดความกังวล  หรือเหนื่อยล้าเกินไป<br />
                            </div>
                            <!-- 
            <div class="tab-pane fade" id="dropdown1"> 
              <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork.</p>
            </div>
            <div class="tab-pane fade" id="dropdown2">
              <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater.</p>
            </div>
                            -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.row -->
     </div>             
</section>