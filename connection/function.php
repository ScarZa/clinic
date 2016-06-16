<?php
function canaccess($right)
{
$result=false;
$accessright=getsqldata('select accessright as cc from opduser where loginname="'.$_SESSION['loginname'].'" limit 1');

if (strpos(strtoupper($accessright),strtoupper($right)) || strpos(strtoupper($accessright),'ADMIN')>0)  
	$result=true;
if ($result<>true)
	{	echo "<script> ";
		echo "alert('Access Dinied !!  ต้องการสิทธิ์ ".$right." ')";
		echo "</script> ";
	//	
	echo "<ul data-role='listview' data-inset='true' align='center'>   ";
	echo "			<li data-role='list-divider' ><font sixe ='+3' color>Access Denied !! </font> </li> ";
	echo "			<li><a href='javascript:history.back();' data-role='button' data-theme='c' data-icon='back'  >Back</a></li> ";
	echo "		</ul> ";
	exit;
	}
}
function GetFulNameByHn($hn)
{
return getsqldata("select concat(p.pname,' ',p.fname,' ',p.lname) As cc from patient p where hn='".$hn."'");
}
function GetHnByAn($an)
{
return getsqldata("select hn as cc from ipt where an='".$an."'");
}


function getserialnumber($para)
{
return getsqldata("select get_serialnumber('".$para."') as cc " );
}

function getsqldata($sql)
{
$obj = null;
db_loadObject($sql,$obj);
return $obj->cc;
}

function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		if ($strHour>0) 
		return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
		else
		return "$strDay $strMonthThai $strYear";
	}

function getsqlsubquerydata($sql)	
{	$text=''; 
	$obj_detail = null;
	$obj_detail = db_loadList(  $AppUI,$sql, NULL );
	$row=0;
	foreach($obj_detail as $key_detail)
	 	{
		if ($row>0)
			$text =$text.",'".$key_detail[cc]."'";
		else
			$text="'".$key_detail[cc]."'";	
		$row=$row+1;
		}
	return $text;	
}
?>