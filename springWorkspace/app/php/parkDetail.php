<?php
header("Access-Control-Allow-Origin: *"); // 모든 출처 허용
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // 허용할 HTTP 메서드
header("Access-Control-Allow-Headers: Content-Type"); // 허용할 헤더
header('Content-Type: application/json'); // JSON 응답 헤더 설정

// 데이터베이스 정보 설정
$servername = "localhost"; // 서버명
$username = "root"; // 데이터베이스 사용자 이름
$password = "1111"; // 데이터베이스 비밀번호
$dbname = "seoul2024"; // 사용할 데이터베이스 이름

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 공원 ID 가져오기
$id = isset($_GET['id']) ? $_GET['id'] : null; // ID가 없으면 null로 설정

if ($id === null) {
    echo json_encode(["error" => "공원 ID가 제공되지 않았습니다."]); // 오류 메시지 출력
    exit();
}

// SQL 쿼리 작성
$sql = "SELECT CODE, NAME, LATITUDE, LONGITUDE, TOILET_NUM FROM park WHERE CODE = ?";

// 준비된 문 사용
$stmt = $conn->prepare($sql); // SQL 문 준비
$stmt->bind_param("i", $id); // ID가 정수형이라 가정하고 바인딩


$stmt->execute(); // 쿼리 실행
$result = $stmt->get_result(); // 결과 가져오기

// 결과 확인
if ($result->num_rows > 0) {
    $parkDetail = $result->fetch_assoc(); // 공원 정보를 배열로 가져옴
    echo json_encode($parkDetail); // JSON 형식으로 출력
} else {
    echo json_encode(["error" => "해당 공원을 찾을 수 없습니다."]); // 공원이 없을 경우 메시지 출력
}

// 연결 종료
$stmt->close();
$conn->close();
?>
