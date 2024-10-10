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

// 데이터베이스 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname);

// 연결 확인
if ($conn->connect_error) {
    die("연결 실패: " . $conn->connect_error);
}

// SQL 쿼리
$sql = "
SELECT 
    p.CODE AS Park_Code,
    p.NAME AS Park_Name,
    m.CODE AS Machine_Code,
    s.state_content AS State_Content,  -- state_content로 수정
    CASE 
        WHEN SUBSTRING(m.CODE, 3, 1) = '2' THEN '여자화장실'
        WHEN SUBSTRING(m.CODE, 3, 1) = '1' THEN '남자화장실'
        ELSE '정보 없음'
    END AS Gender
FROM 
    park p
JOIN 
    toilet t ON p.TOILET_NUM LIKE CONCAT('%', t.CODE, '%')
JOIN 
    machine m ON FIND_IN_SET(m.CODE, REPLACE(t.MACHINE_NUM, ' ', '')) > 0
JOIN 
    state s ON s.state_code = m.STATE_NUM  -- state 테이블 조인
WHERE 
    p.CODE = '3';
";

// 쿼리 실행
$result = $conn->query($sql);

// 결과가 있는 경우
if ($result->num_rows > 0) {
    // 결과를 배열로 저장
    $data = [];
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data); // JSON 형식으로 출력
} else {
    echo json_encode([]); // 빈 배열 반환
}

?>
