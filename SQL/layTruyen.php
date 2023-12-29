<?php
$host ='localhost';
$username ='id21613839_vytien';
$pass='0962995917Vy@';

class Truyen{
     function __construct($id, $ten, $chap, $anh) {
        $this->id = $id;
        $this->tenTruyen = $ten;
        $this->tenChap = $chap;
        $this->LinkAnh = $anh;
    }
}

$conn = mysqli_connect("$host","$username","$pass","$username");
mysqli_set_charset($conn,'utf8');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Đảm bảo rằng dữ liệu đã được gửi lên
    $data = json_decode(file_get_contents("php://input"));

    // Lấy dữ liệu từ ứng dụng Android
    $truyenId = $data->id;

    // Cập nhật số lần click trong cơ sở dữ liệu
    $updateQuery = mysqli_query($conn, $updateSql);

    // Kiểm tra xem cập nhật có thành công hay không và trả kết quả về ứng dụng Android
    if ($updateQuery) {
        echo json_encode(array("message" => "Cập nhật số lần click thành công"));
    } else {
        echo json_encode(array("message" => "Cập nhật số lần click không thành công"));
    }
    exit; // Kết thúc script sau khi xử lý yêu cầu POST
}

$sql ='SELECT * FROM `Truyen`';
$query = mysqli_query($conn,$sql);

$arr = array();

while ($row = mysqli_fetch_assoc($query)) {
    $id = $row['id'];
    $ten = $row['tenTruyen'];
    $chap = $row['chapMoi'];
    $anh = $row['anhTruyen'];

    array_push($arr, new Truyen($id, $ten, $chap, $anh));
}
$json = json_encode($arr);
echo $json;
?>