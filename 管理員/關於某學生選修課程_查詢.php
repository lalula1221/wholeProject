<?php
session_start();
$host = 'localhost';
$user = $_SESSION['Account'];
$passwd = $_SESSION['Password'];
$database = 'midTest';
$connect = new mysqli($host, $user, $passwd, $database);
$Number=$_POST['Number'];
$Elective=$Number."_選修";
$Sem=$_POST['Sem'];
$check="SELECT Number,Authority FROM user WHERE Number='$Number'";
$checked=$connect->query($check);
$checkdata=$checked->fetch_row();
if($checked->num_rows==0||$checkdata[1]=="教授"||$checkdata[1]=="administrator"){
    echo('error');
}
else{
    $select="SELECT Class FROM $Sem WHERE $Elective='是'";
    $memberdata=$connect->query($select);
    echo json_encode($memberdata->fetch_all());
}
?>
