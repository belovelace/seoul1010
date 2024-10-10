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

// 쿼리 파라미터에서 ID 받아오기
$parkCode = isset($_GET['id']) ? $_GET['id'] : '2'; // 'id'가 없을 경우 기본값 '2' 사용

// SQL 쿼리
$sql = "
SELECT 
    p.CODE AS Park_Code,
    p.NAME AS Park_Name,
    m.CODE AS Machine_Code,
    m.STATE_NUM AS State_Num,
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
WHERE 
    p.CODE = ?;  -- Prepared statement를 사용하여 쿼리 안전하게 작성
";

// 쿼리 실행을 위한 준비
$stmt = $conn->prepare($sql);

// 오류 발생 시 메시지 출력
if (!$stmt) {
    die("SQL 준비 실패: " . $conn->error . " | 쿼리: " . $sql); // SQL 준비 실패 시 오류 메시지 출력
}

$stmt->bind_param("s", $parkCode); // 파라미터 바인딩
$stmt->execute();

// 결과 가져오기
$result = $stmt->get_result();

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

$stmt->close(); // 준비한 쿼리 닫기
$conn->close(); // 연결 닫기
?>
