// searchCode.js

// 데이터 가져오기 함수
function fetchTissueData(machineCode = '') {
    // 기기 코드가 있을 경우 쿼리 파라미터 추가
    const url = machineCode
        ? `http://localhost/php/parkToiletLook.php?machine_code=${encodeURIComponent(machineCode)}`
        : 'http://localhost/php/parkToiletLook.php';

    console.log(`Fetching data from: ${url}`); // 디버깅용 로그

    // 로딩 메시지 표시
    const tissueList = document.getElementById('tissueList');
    tissueList.innerHTML = '<p>로딩 중...</p>';

    fetch(url) // PHP 파일의 경로
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // JSON 데이터로 변환
        })
        .then(data => {
            console.log('Received data:', data); // 디버깅용 로그
            if (data.error) {
                console.error('Server Error:', data.error);
                displayError(data.error);
            } else {
                displayTissueData(data); // 데이터 표시
            }
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
            displayError(error.message);
        });
}

// 데이터 표시 함수
function displayTissueData(data) {
    const tissueList = document.getElementById('tissueList');
    tissueList.innerHTML = ''; // 기존 내용 초기화

    if (data.length === 0) {
        tissueList.innerHTML = '<p>검색 결과가 없습니다.</p>';
        return;
    }

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

// 에러 표시 함수
function displayError(message) {
    const tissueList = document.getElementById('tissueList');
    tissueList.innerHTML = `<p class="error-message">${message}</p>`;
}

// 검색 버튼 클릭 시 데이터 가져오기
function searchMachineCode() {
    const input = document.getElementById('searchInput').value.trim();

    // 입력값 유효성 검사: 4자리 숫자
    const machineCodePattern = /^\d{4}$/;
    if (!machineCodePattern.test(input)) {
        displayError('기기 코드는 4자리 숫자여야 합니다.');
        return;
    }

    console.log(`Searching for machine_code: ${input}`); // 디버깅용 로그
    fetchTissueData(input); // 기기 코드로 검색
}

// Enter 키로도 검색 가능하도록 이벤트 리스너 추가
document.getElementById('searchInput').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        searchMachineCode();
    }
});
