<?php
header("Access-Control-Allow-Origin: *"); // 모든 출처 허용
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // 허용할 HTTP 메서드
header("Access-Control-Allow-Headers: Content-Type"); // 허용할 헤더

// 데이터베이스 정보 설정
$servername = "localhost"; // 서버명
$username = "root"; // XAMPP의 기본 사용자 이름
$password = "1111"; // 비밀번호 (기본적으로 비어 있음)
$dbname = "seoul2024"; // 사용할 데이터베이스 이름

$db = null; // $db 변수를 초기화

try {
    // PDO를 이용한 데이터베이스 연결
    $db = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // 오류 예외 설정
} catch (PDOException $e) {
    // 연결 오류 처리
    echo "Connection failed: " . $e->getMessage();
    exit();
}


// SQL 쿼리 작성
$query = "
    SELECT 
        m.CODE AS machine_code, 
        CASE 
            WHEN SUBSTRING(m.CODE, 3, 1) = '2' THEN '여자화장실' 
            WHEN SUBSTRING(m.CODE, 3, 1) = '1' THEN '남자화장실' 
            ELSE '정보 없음' 
        END AS gender, 
        m.STATE_NUM, 
        s.STATE_CONTENT 
    FROM machine m 
    LEFT JOIN toilet t ON m.CODE = t.MACHINE_NUM 
    LEFT JOIN state s ON m.STATE_NUM = s.STATE_CODE;
";



// 쿼리 실행 및 결과 가져오기
try {
    $result = $db->query($query);
    $data = $result->fetchAll(PDO::FETCH_ASSOC); // 연관 배열로 가져오기
} catch (PDOException $e) {
    // 쿼리 실행 오류 처리
    echo "Query failed: " . $e->getMessage();
    exit();
}

// JSON 형식으로 결과 반환
header('Content-Type: application/json'); // JSON 응답 헤더 설정
echo json_encode($data); // 데이터를 JSON 형식으로 출력
?>
