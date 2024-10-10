// 예시: 공원 데이터 (각 공원에 대한 ID 및 이름)
const parks = [
    { code: '1', name: '공원 1' },
    { code: '2', name: '공원 2' },
    { code: '3', name: '공원 3' },
    { code: '4', name: '공원 4' }
];

// 공원 리스트를 동적으로 생성하는 함수
function createParkLinks() {
    const parkList = document.getElementById('parkList'); // 공원 리스트를 보여줄 HTML 요소
    parkList.innerHTML = ''; // 기존 내용 초기화

    parks.forEach(park => {
        const parkLink = document.createElement('a');
        parkLink.href = `parkId.php?id=${park.code}`; // 공원 ID를 파라미터로 추가
        parkLink.innerText = park.name;
        parkLink.target = '_blank'; // 새 탭에서 열기
        parkList.appendChild(parkLink); // 링크를 리스트에 추가
        parkList.appendChild(document.createElement('br')); // 줄바꿈 추가
    });
}

// 페이지 로드 시 공원 링크 생성
document.addEventListener('DOMContentLoaded', createParkLinks);
