<?php
$host ='localhost';
$username ='id21613839_vytien';
$pass='0962995917Vy@';

class Truyen{
    function __construct($id,$ten,$ngaynhap){
        $this->id=$id;
        $this->tenchap=$ten;
        $this->ngaynhap=$ngaynhap;
    }
}
$idTruyen = $_GET["id"];

$conn = mysqli_connect("$host","$username","$pass","$username");
mysqli_set_charset($conn,'utf8');

$sql ="SELECT * FROM `Chap` WHERE `idtruyen` = '$idTruyen'";
$query = mysqli_query($conn,$sql);

$arr = array();

while($row = mysqli_fetch_assoc($query)){
    $id = $row['id'];
    $ten = $row['tenchap'];
    $ngaynhap = $row['ngaynhap'];

    
    array_push($arr,new Truyen($id,$ten,$ngaynhap));
}
$json = json_encode($arr);
echo $json;
?>