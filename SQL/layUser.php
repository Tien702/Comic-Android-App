<?php
$host ='localhost';
$username ='id21613839_vytien';
$pass='0962995917Vy@';

class User{
    function __construct($id, $email, $password) {
        $this->ID = $id;
        $this->Email = $email;
        $this->PassWord = $password;
    }
}

$conn = mysqli_connect("$host","$username","$pass","$username");
mysqli_set_charset($conn,'utf8');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Đảm bảo rằng dữ liệu đã được gửi lên
    $data = json_decode(file_get_contents("php://input"));

    // Lấy dữ liệu từ ứng dụng Android
    $userId = $data->ID;

    // Sử dụng prepared statements
    $updateSql = "UPDATE User WHERE ID = ?";
    $updateQuery = mysqli_prepare($conn, $updateSql);

    // Kiểm tra lỗi prepared statements
    if ($updateQuery === false) {
        die('Lỗi truy vấn SQL: ' . mysqli_error($conn));
    }

    // Binde tham số
    mysqli_stmt_bind_param($updateQuery, 'ii', $newRole, $userId);

    // Thực thi câu lệnh prepared statement
    mysqli_stmt_execute($updateQuery);

    // Kiểm tra và trả kết quả về ứng dụng Android
    if (mysqli_stmt_affected_rows($updateQuery) > 0) {
        echo json_encode(array("message" => "Cập nhật quyền thành công"));
    } else {
        echo json_encode(array("message" => "Cập nhật quyền không thành công"));
    }

    // Đóng statement
    mysqli_stmt_close($updateQuery);
    exit; // Kết thúc script sau khi xử lý yêu cầu POST
}

$sql = 'SELECT * FROM `User`';
$query = mysqli_query($conn, $sql);

$arr = array();

while ($row = mysqli_fetch_assoc($query)) {
    $id = $row['ID'];
    $email = $row['Email'];
    $password = $row['PassWord'];

    array_push($arr, new User($id, $email, $password));
}

$json = json_encode($arr);
echo $json;
?>