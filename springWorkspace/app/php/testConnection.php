<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // CORS 설정

// 데이터베이스 연결 설정
$servername = "localhost";
$username = "root";
$password = "1111"; // application.properties에 설정한 비밀번호
$dbname = "seoul2024";

// MySQL 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// 연결 성공 시 "Connected successfully" 메시지 반환
echo json_encode(["message" => "Connected successfully"]);

// 연결 종료
$conn->close();

?>
