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
$sql = "
 
";

// 준비된 문 사용
$stmt = $conn->prepare($sql); // SQL 문 준비
$searchCode = $id . '%'; // 공원 ID에 기반한 코드 검색 (공원 ID + 와일드카드)
$stmt->bind_param("s", $searchCode); // 바인딩 (문자열로)

$stmt->execute(); // 쿼리 실행
$result = $stmt->get_result(); // 결과 가져오기

if ($result->num_rows > 0) {
    $toilets = [];
    while ($toilet = $result->fetch_assoc()) { // 각 화장실 정보를 배열에 저장
        $toilets[] = $toilet;
    }
    echo json_encode($toilets); // JSON 형태로 화장실 정보 출력
} else {
    echo json_encode(["error" => "해당 화장실을 찾을 수 없습니다."]); // 오류 메시지 출력
}

$stmt->close(); // 쿼리문 종료
$conn->close(); // 데이터베이스 연결 종료
?>
