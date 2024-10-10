<?php

header("Access-Control-Allow-Origin: *"); // 모든 출처 허용
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // 허용할 HTTP 메서드
header("Access-Control-Allow-Headers: Content-Type"); // 허용할 헤더

// 데이터베이스 정보 설정
$servername = "localhost"; // 서버명
$username = "root"; // XAMPP의 기본 사용자 이름
$password = "1111"; // 비밀번호 (기본적으로 비어 있음)
$dbname = "seoul2024"; // 사용할 데이터베이스 이름

// 데이터베이스 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

// SQL 쿼리 실행
$sql = "
SELECT 
    m.CODE AS Machine_Code,  -- 기계 코드
    s.state_content AS State_Content  -- 상태 내용
FROM 
    machine m
JOIN 
    state s ON m.STATE_NUM = s.state_code  -- machine과 state 테이블을 state_code로 조인
WHERE 
    s.state_code = 1;  -- state_code가 1인 상태만 조회

";

$result = $conn->query($sql);

// 오류 처리
if (!$result) {
    die("SQL 오류: " . $conn->error);
}

// 결과를 JSON 형식으로 반환
$data = [];

if ($result->num_rows > 0) {
    // 결과를 배열에 추가
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    $data = ["message" => "결과가 없습니다."];
}

// JSON 형태로 응답
header('Content-Type: application/json');
echo json_encode($data);

// 연결 종료
$conn->close();
?>
