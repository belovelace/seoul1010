<?php

header("Access-Control-Allow-Origin: *"); // 모든 출처 허용
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // 허용할 HTTP 메서드
header("Access-Control-Allow-Headers: Content-Type"); // 허용할 헤더

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

// 공원 정보를 데이터베이스에서 가져오기 위한 SQL 쿼리
$sql = "SELECT NAME, LATITUDE, LONGITUDE FROM park";
$result = $conn->query($sql);

// 쿼리 실패 시 에러 확인
if (!$result) {
    die("Query failed: " . $conn->error); // 에러 메시지를 출력하고 스크립트 중단
}

$parks = array(); // 공원 정보를 저장할 배열

if ($result->num_rows > 0) {
    // 각 공원 정보를 배열에 추가
    while ($row = $result->fetch_assoc()) {
        $parks[] = array(
            'name' => $row['NAME'],
            'latitude' => $row['LATITUDE'],
            'longitude' => $row['LONGITUDE']
        );
    }
}

// JSON 형식으로 변환하여 출력
echo json_encode($parks);

$conn->close();
?>