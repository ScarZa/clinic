<?php ob_start(); 
        include 'connection/connect1.php';
	include 'connection/db_connect.php';
	include 'connection/function.php';
        
 	$strSQL = "select image as cc from patient_image where hn='".$_GET['hn']."' ";
	header("Content - type : image/jpeg");
	echo getsqldata($strSQL);
?>