<?php

header("Access-Control-Allow-Origin: *"); // 모든 출처 허용
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // 허용할 HTTP 메서드
header("Access-Control-Allow-Headers: Content-Type"); // 허용할 헤더
header('Content-Type: application/json'); // JSON 응답으로 설정

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

// 공원 ID 가져오기
$id = isset($_GET['id']) ? $_GET['id'] : null; // ID가 없으면 null로 설정

if ($id === null) {
    echo json_encode(["error" => "공원 ID가 제공되지 않았습니다."]); // 오류 메시지 출력
    exit();
}

// 기기 코드 생성 (예: 'XXXX', 첫 자리 공원 ID, 세번째 자리 남자화장실은 1, 여자화장실은 2)
// 버튼 클릭에 따라 세 번째 자리를 다르게 설정
$maleMachineCode = sprintf('%04d', $id) . '1'; // 남자화장실 기기 코드
$femaleMachineCode = sprintf('%04d', $id) . '2'; // 여자화장실 기기 코드

// 화장실 정보 조회 쿼리
$sql = "SELECT * FROM machine WHERE CODE IN (?, ?)"; // 남자 및 여자 기기 코드 모두 조회
$stmt = $conn->prepare($sql); // SQL 문 준비
$stmt->bind_param("ss", $maleMachineCode, $femaleMachineCode); // 두 개의 코드 바인딩
$stmt->execute(); // 쿼리 실행
$result = $stmt->get_result(); // 결과 가져오기

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row; // 화장실 정보 가져오기
    }
    echo json_encode($data); // JSON 형태로 화장실 정보 출력
} else {
    echo json_encode(["error" => "해당 화장실 정보를 찾을 수 없습니다."]); // 오류 메시지 출력
}

$stmt->close(); // 쿼리문 종료
$conn->close(); // 데이터베이스 연결 종료
?>
