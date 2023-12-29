<?php
$host = 'localhost';
$username = 'id21613839_vytien';
$pass = '0962995917Vy@';
$dbname = 'id21613839_vytien';

$conn = mysqli_connect($host, $username, $pass, $dbname);
mysqli_set_charset($conn, 'utf8');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Đảm bảo rằng dữ liệu đã được gửi lên
    $data = json_decode(file_get_contents("php://input"));

    // Lấy dữ liệu từ ứng dụng Android
    $email = $data->Email;
    $password = $data->PassWord;
    
    // Thực hiện câu lệnh SQL để thêm thông tin người dùng vào CSDL
    $insertSql = "INSERT INTO User (Email, PassWord) VALUES (?, ?)";
    $insertQuery = mysqli_prepare($conn, $insertSql);

    if ($insertQuery === false) {
        die('Lỗi truy vấn SQL: ' . mysqli_error($conn));
    }

    // Bỏ phần hash mật khẩu và truyền trực tiếp mật khẩu vào
    mysqli_stmt_bind_param($insertQuery, 'ss', $email, $password);
    mysqli_stmt_execute($insertQuery);

    // Kiểm tra và trả kết quả về ứng dụng Android
    if (mysqli_stmt_affected_rows($insertQuery) > 0) {
        echo json_encode(array("message" => "TC"));
    } else {
        echo json_encode(array("message" => "KTC"));
    }

    mysqli_stmt_close($insertQuery);
    exit;
}
?>
