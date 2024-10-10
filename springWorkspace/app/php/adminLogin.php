<?php

header("Access-Control-Allow-Origin: *"); // 모든 출처 허용
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // 허용할 HTTP 메서드
header("Access-Control-Allow-Headers: Content-Type"); // 허용할 헤더

// 나머지 코드...

// 데이터베이스 정보 설정
$servername = "localhost"; // 서버명
$username = "root"; // XAMPP의 기본 사용자 이름
$password = "1111"; // 비밀번호 (기본적으로 비어 있음)
$dbname = "seoul2024"; // 사용할 데이터베이스 이름


// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// POST 방식으로 전송된 데이터 받기
$adminId = $_POST['adminId'];
$adminPassword = $_POST['adminPassword'];

// 아이디와 비밀번호 검증
$sql = "SELECT * FROM admin WHERE ID = ? AND PWD = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $adminId, $adminPassword); // 문자열 두 개 바인딩
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // 로그인 성공
    echo json_encode(["success" => true, "message" => "로그인 성공!"]);
} else {
    // 로그인 실패
    echo json_encode(["success" => false, "message" => "아이디 또는 비밀번호가 잘못되었습니다."]);
}

// 연결 종료
$stmt->close();
$conn->close();
?>
