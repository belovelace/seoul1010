<?php

header("Access-Control-Allow-Origin: *"); // 모든 출처 허용
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // 허용할 HTTP 메서드
header("Access-Control-Allow-Headers: Content-Type"); // 허용할 헤더
header("Content-Type: application/json; charset=UTF-8"); // JSON 출력 시 Content-Type 설정

// 데이터베이스 정보 설정
$servername = "localhost"; // 서버명
$username = "root"; // XAMPP의 기본 사용자 이름
$password = "1111"; // 비밀번호 (기본적으로 비어 있음)
$dbname = "seoul2024"; // 사용할 데이터베이스 이름

// 데이터베이스 연결
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error])); // JSON 형식으로 에러 출력
}

// 'id' 파라미터 받기 및 유효성 검사
$id = isset($_GET['id']) ? $_GET['id'] : null; // id가 존재하지 않을 경우 null로 설정
if (!$id) {
    die(json_encode(["error" => "ID parameter is missing."])); // ID가 없을 경우 에러 출력
}

error_log("Received ID: " . $id); // ID 값을 로그에 기록

// 공원 정보를 데이터베이스에서 가져오기 위한 SQL 쿼리
$sql = "
SELECT 
    p.CODE AS Park_Code,        -- 공원 코드
    p.NAME AS Park_Name,        -- 공원 이름
    t.MACHINE_NUM AS Machine_Num,  -- 화장실의 기계 번호
    m.CODE AS Machine_Code,     -- 기계 코드
    m.STATE_NUM AS State_Num,   -- 상태 번호
    CASE 
        WHEN SUBSTRING(m.CODE, 3, 1) = '2' THEN '여자화장실'  -- 세 번째 자리가 2이면 여자 화장실
        WHEN SUBSTRING(m.CODE, 3, 1) = '1' THEN '남자화장실'  -- 세 번째 자리가 1이면 남자 화장실
        ELSE '정보 없음'          -- 그 외의 경우
    END AS Gender               -- 성별 구분
FROM 
    park p
JOIN 
    toilet t ON p.TOILET_NUM = t.CODE   -- 공원과 화장실 테이블 조인
JOIN 
    machine m ON FIND_IN_SET(m.CODE, REPLACE(t.MACHINE_NUM, ' ', '')) > 0   -- 기계 코드가 머신 넘버에 포함되는지 확인
WHERE 
    p.CODE = ?;  -- 원하는 공원 코드 필터링
";

// 쿼리 준비 및 실행
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die(json_encode(["error" => "SQL prepare failed: " . $conn->error])); // 쿼리 준비 실패 시 에러 출력
}

$stmt->bind_param("s", $id); // ID를 바인딩
$stmt->execute();
$result = $stmt->get_result();

// 쿼리 실패 시 에러 확인
if (!$result) {
    die(json_encode(["error" => "Query execution failed: " . $stmt->error])); // JSON 형식으로 에러 출력
}

$parks = array(); // 공원 정보를 저장할 배열

if ($result->num_rows > 0) {
    // 각 공원 정보를 배열에 추가
    while ($row = $result->fetch_assoc()) {
        $parks[] = array(
            'park_code' => $row['Park_Code'],
            'park_name' => $row['Park_Name'],
            'machine_num' => $row['Machine_Num'],
            'machine_code' => $row['Machine_Code'],
            'state_num' => $row['State_Num'],
            'gender' => $row['Gender']
        );
    }
}

// JSON 형식으로 변환하여 출력
echo json_encode($parks);

// 연결 종료
$conn->close();
?>
