<?php
$host ='localhost';
$username ='id21613839_vytien';
$pass='0962995917Vy@';

$idChap = $_GET["idChap"];

$conn = mysqli_connect("$host","$username","$pass","$username");
mysqli_set_charset($conn,'utf8');

$sql ="SELECT * FROM `Anh` WHERE `idChap` = '$idChap'";
$query = mysqli_query($conn,$sql);

$arr = array();

while($row = mysqli_fetch_assoc($query)){
    array_push($arr,$row['anh']);
}
$json = json_encode($arr);
echo $json;
?>