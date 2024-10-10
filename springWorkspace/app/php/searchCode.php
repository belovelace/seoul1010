<?php
// CORS 및 응답 헤더 설정
header("Access-Control-Allow-Origin: *"); // 모든 출처 허용 (보안상 필요 시 특정 도메인으로 제한)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // 허용할 HTTP 메서드
header("Access-Control-Allow-Headers: Content-Type"); // 허용할 헤더
header('Content-Type: application/json'); // JSON 응답 헤더 설정

// 데이터베이스 정보 설정
$servername = "localhost"; // 서버명
$username = "root"; // 데이터베이스 사용자 이름
$password = "1111"; // 데이터베이스 비밀번호
$dbname = "seoul2024"; // 사용할 데이터베이스 이름

try {
    // PDO를 이용한 데이터베이스 연결
    $db = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // 오류 예외 설정
} catch (PDOException $e) {
    // 연결 오류 처리
    echo json_encode(["error" => "Connection failed: " . $e->getMessage()]);
    exit();
}

// 기기 코드 검색을 위한 쿼리 파라미터 가져오기
$machineCode = isset($_GET['machine_code']) ? trim($_GET['machine_code']) : ''; // 기기 코드

// 디버깅용 로그 추가 (개발 환경에서만 사용, 배포 시 제거)
file_put_contents('php_debug.log', "Received machine_code: " . $machineCode . "\n", FILE_APPEND);

// 기기 코드 형식 검증 (예: 4자리 숫자)
if (!empty($machineCode)) {
    if (!preg_match('/^\d{4}$/', $machineCode)) {
        echo json_encode(["error" => "Invalid machine_code format. It should be a 4-digit number."]);
        exit();
    }
} else {
    // machine_code가 없으면 빈 배열 반환
    echo json_encode([]);
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
    LEFT JOIN state s ON m.STATE_NUM = s.STATE_CODE
    WHERE m.CODE = :machine_code
";

try {
    $stmt = $db->prepare($query); // 준비된 쿼리 사용
    $stmt->bindValue(':machine_code', $machineCode, PDO::PARAM_STR); // 바인딩 (bindValue 사용)
    $stmt->execute(); // 쿼리 실행
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC); // 연관 배열로 가져오기

    // 디버깅용 로그 추가 (개발 환경에서만 사용, 배포 시 제거)
    file_put_contents('php_debug.log', "Fetched rows: " . count($data) . "\n", FILE_APPEND);
} catch (PDOException $e) {
    // 쿼리 실행 오류 처리
    echo json_encode(["error" => "Query failed: " . $e->getMessage()]);
    exit();
}

// 결과 반환
echo json_encode($data); // 데이터를 JSON 형식으로 출력
?>
