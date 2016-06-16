<?php
    $cc=$_GET['cc'];
    $degree=$_GET['degree'];
    $amount=$_GET['amount'];
        $drink=($cc*$amount*$degree*0.789)/10;
        echo $drink;
?>

