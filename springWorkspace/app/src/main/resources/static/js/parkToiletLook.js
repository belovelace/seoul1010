document.addEventListener('DOMContentLoaded', () => {
    fetchTissueData(); // 페이지 로드 시 데이터 가져오기
});

// 데이터 가져오기 함수
function fetchTissueData() {
    fetch('http://localhost/php/parkToiletLook.php') // PHP 파일의 경로
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // JSON 데이터로 변환
        })
        .then(data => {
            displayTissueData(data); // 데이터 표시
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
}


function displayTissueData(data) {
    const tissueList = document.getElementById('tissueList');
    tissueList.innerHTML = ''; // 기존 내용 초기화

    data.forEach(item => {
        const tissueItem = document.createElement('div');
        tissueItem.className = 'tissue-item';
        tissueItem.innerHTML = `
            <div class="tissue-detail">
                <h3 class="restroom-code">기기 코드: <span>${item.machine_code}</span></h3>
                <p class="gender">성별: <span>${item.gender}</span></p>
                <p class="tissue-status">휴지 잔여 상태: <span>${item.STATE_CONTENT}</span></p>
            </div>
        `;
        tissueList.appendChild(tissueItem); // 리스트에 추가
    });
}


// 필터링 함수
function filterTissueStatus() {
    const input = document.getElementById('searchInput');
    const filter = input.value.toLowerCase();
    const tissues = document.getElementById('tissueList').getElementsByClassName('tissue-item');

    for (let i = 0; i < tissues.length; i++) {
        const code = tissues[i].getElementsByClassName('restroom-code')[0].innerText.toLowerCase();
        const park = tissues[i].getElementsByClassName('park-name')[0].innerText.toLowerCase();
        const gender = tissues[i].getElementsByClassName('gender')[0].innerText.toLowerCase();
        if (code.includes(filter) || park.includes(filter) || gender.includes(filter)) {
            tissues[i].style.display = "";
        } else {
            tissues[i].style.display = "none";
        }
    }
}
