<?php
include '../connection/connect.php';
    $cc=$_GET['cc'];
    $select=  mysqli_query($db,"select * from jvlmatrix_alcohol_type where al_id='$cc'");
    $degree = mysqli_fetch_array($select);
    $DeGree= $degree['degree'];   
    echo $DeGree;
    
?>

