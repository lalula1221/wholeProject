<?php
session_start();
$host = 'localhost';
$user = $_SESSION['Account'];
$passwd = $_SESSION['Password'];
$database = 'midTest';
$connect = new mysqli($host, $user, $passwd, $database);
$oldNum=$_POST['oldNum'];
$check="SELECT Number FROM user WHERE Number='$oldNum'";
$checked=$connect->query($check);//確認是否存在學號
if($checked->num_rows==0){
    echo('error');
}
else{
$newName=$_POST['newName'];
$newNum=$_POST['newNum'];
$newSem=$_POST['newSem'];
$checkTwo="SELECT Number FROM user WHERE Number='$newNum'";//確認新學號是否已有人使用
$checkedTwo=$connect->query($checkTwo);
if($checkedTwo->num_rows>0){
    echo("errorTwo");
}
else{
    $modifyDataUserTable="UPDATE user set Name='$newName',Number='$newNum',EnterTime='$newSem' where Number='$oldNum'";
    $gradeOld=$oldNum."_學號";
    $gradeNew=$newNum."_學號";
    $elecOld=$oldNum."_選修";
    $elecNew=$newNum."_選修";
    $modifyDataSem109up1="ALTER TABLE 109上 CHANGE column $gradeOld $gradeNew INT(3)";
    $modifyDataSem109up2="ALTER TABLE 109上 CHANGE column $elecOld $elecNew VARCHAR(4)";
    $modifyDataSem109down1="ALTER TABLE 109下 CHANGE column $gradeOld $gradeNew INT(3)";
    $modifyDataSem109down2="ALTER TABLE 109下 CHANGE column $elecOld $elecNew VARCHAR(4)";
    $modifyDataSem110up1="ALTER TABLE 110上 CHANGE column $gradeOld $gradeNew INT(3)";
    $modifyDataSem110up2="ALTER TABLE 109下 CHANGE column $elecOld $elecNew VARCHAR(4)";
    $connect->query($modifyDataUserTable);
    $connect->query($modifyDataSem109up1);
    $connect->query($modifyDataSem109up2);
    $connect->query($modifyDataSem109down1);
    $connect->query($modifyDataSem109down2);
    $connect->query($modifyDataSem110up1);
    $connect->query($modifyDataSem110up2);

    }
}
?>