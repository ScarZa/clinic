<?php  if(empty($_SESSION['usermatrix'])){echo "<meta http-equiv='refresh' content='0;url=index.php'/>";exit();} 
 include 'connection/connect.php';?>
<META content="text/html; charset=utf8" http-equiv=Content-Type>
<?php     
    $matrix_id=$_POST['matrix_id'];
    $hn=$_POST['hn'];
    $doctor=$_SESSION['usermatrix'];

if($_POST['method']=='interview'){
    $regdate=date("Y-m-d");
    $begin=$_POST['begin'];
    $alcohol_type=$_POST['alcohol_type'];
    $alcohol_volume=$_POST['alcohol_volume'];
    $last_drink=$_POST['last_drink'];
    $total_time=$_POST['total_time'];
    $range_time=$_POST['range_time'];
    $type_freq=$_POST['alcohol'];
    $volume=$_POST['volume'];
    $amount=$_POST['amount'];
    $cc=$volume*$amount;
    $drink=$_POST['answer'];
    $cause=$_POST['cause'];
    $cause_other=$_POST['cause_other'];
    $range=$_POST['range'];
    $place=$_POST['place'];
    $place_other=$_POST['place_other'];
    $joint=$_POST['join'];
    $stop=$_POST['stop'];
    $stop_by=$_POST['stop_by'];
    $stop_time=$_POST['stop_time'];
    $range_stop=$_POST['range_stop'];
    $stop_cause=$_POST['stop_cause'];
    $stop_other=$_POST['stop_other'];
    $again=$_POST['again'];
    $again_other=$_POST['again_other'];
    $use_drug=$_POST['use_drug'];
    $drug=$_POST['drug'];   
    $now_use=$_POST['now_use'];
    $volume_use=$_POST['volume_use'];
    $family_drink=$_POST['family_drink'];
    $family=$_POST['family'];
    $sleep=$_POST['sleep'];
    $therapy=$_POST['therapy'];
    $place_therapy=$_POST['place_therapy'];
    $amount_therapy=$_POST['amount_therapy'];
    $psyc=$_POST['psyc'];
    $place_psyc=$_POST['place_psyc'];
    $year=$_POST['year'];
    $brief_score=$_POST['brief_score'];
    $brief=$_POST['brief'];
    $type_patient=$_POST['type_patient'];
    $diag=$_POST['diag'];
    $diag2=$_POST['diag2'];
    
    $insert_interview=  mysqli_query($db,"insert into jvlmatrix_alcohol_interview set matrix_id='$matrix_id',hn='$hn',regdate='$regdate',
            doctor='$doctor',begin='$begin',alcohol_type='$alcohol_type',alcohol_volume='$alcohol_volume',last_drink='$last_drink',
            total_time='$total_time',range_time='$range_time',type_freq='$type_freq',cc='$cc',drink='$drink',cause='$cause',cause_other='$cause_other',
            ranger='$range',place='$place',place_other='$place_other',joint='$joint',stop='$stop',stop_by='$stop_by',stop_time='$stop_time',
            range_stop='$range_stop',stop_cause='$stop_cause',stop_other='$stop_other',again='$again',again_other='$again_other',use_drug='$use_drug',
            drug='$drug',now_use='$now_use',volume_use='$volume_use',family_drink='$family_drink',family='$family',sleep='$sleep',therapy='$therapy',
            place_therapy='$place_therapy',amount_therapy='$amount_therapy',psyc='$psyc',place_psyc='$place_psyc',year='$year',
            brief_score='$brief_score',brief='$brief',type_patient='$type_patient',diag='$diag',diag2='$diag2'");
    if($insert_interview==false){
				echo "<p>";
				echo "Insert not complete".mysqli_error($db);
				echo "<br />";
				echo "<br />";
                                echo "	<span class='glyphicon glyphicon-remove'></span>";
				echo "<a href='index.php?page=matrix/interview&hn=$hn' >กลับ</a>";
    
}else{
echo "<meta http-equiv='refresh' content='0;url=index.php?page=matrix/report_patient&hn=$hn&matrix_id=$matrix_id' />";
}
}elseif($_POST['method']=='interview_mi'){
    $mi='Y';
    $regdate_mi=  date("Y-m-d");
    $cause_therapy=$_POST['cause_therapy'];
    $about_drink=$_POST['about_drink'];
    $about_other=$_POST['about_other'];
    $score=$_POST['score'];
    $expect=$_POST['expect'];
    $effect_body=$_POST['effect_body'];
    $body=$_POST['body'];
    $effect_heart=$_POST['effect_heart'];
    $heart=$_POST['heart'];
    $effect_social=$_POST['effect_social'];
    $social=$_POST['social'];
    $shake=$_POST['shake'];
    $effect=$_POST['effect'];
    $lab=$_POST['lab'];
    $effect_around=$_POST['effect_around'];
    $good=$_POST['good'];
    $bad=$_POST['bad'];
    $effect_bad=$_POST['effect_bad'];
    $result=$_POST['result'];
    $because_stop=$_POST['because_stop'];
    $change=$_POST['change'];
    $delight=$_POST['delight'];
    $love=$_POST['love'];
    $accept=$_POST['accept'];
    $esteem=$_POST['esteem'];
    
        $update_interview_mi=  mysqli_query($db,"update jvlmatrix_alcohol_interview set mi='$mi',regdate_mi='$regdate_mi',cause_therapy='$cause_therapy',
         about_drink='$about_drink',about_other='$about_other',score='$score',expect='$expect',effect_body='$effect_body',body='$body',
               effect_heart='$effect_heart',heart='$heart',effect_social='$effect_social',social='$social',shake='$shake',effect='$effect',
                lab='$lab',effect_around='$effect_around',good='$good',bad='$bad',effect_bad='$effect_bad',result='$result',because_stop='$because_stop',
                  change_mi='$change',delight='$delight',love='$love',accept='$accept',esteem='$esteem',doctor_mi='$doctor' ");
        if($update_interview_mi==false){
				echo "<p>";
				echo "Update Mi not complete ".mysqli_error($db);
				echo "<br />";
				echo "<br />";
                                echo "	<span class='glyphicon glyphicon-remove'></span>";
				echo "<a href='index.php?page=matrix/interview&hn=$hn' >กลับ</a>";
    
}else{
echo "<meta http-equiv='refresh' content='0;url=index.php?page=matrix/report_patient&hn=$hn&matrix_id=$matrix_id' />";
}
}
?>