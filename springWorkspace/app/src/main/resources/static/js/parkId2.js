document.addEventListener('DOMContentLoaded', function() {
    fetchTissueStatus(); // 페이지 로드 시 데이터 가져오기
});

// AJAX 요청을 통해 화장실 상태 가져오기
function fetchTissueStatus() {
    fetch('http://localhost/php/park/parkId2.php') // 데이터 가져올 PHP 파일
        .then(response => {
            if (!response.ok) { // 응답이 정상인지 확인
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            console.log(data); // 데이터가 어떻게 나오는지 확인
            const tissueList = document.getElementById('tissueList');
            tissueList.innerHTML = ''; // 기존 내용 초기화

            // 각 화장실 정보를 동적으로 추가
            data.forEach(item => {
                const tissueItem = document.createElement('div');
                tissueItem.className = 'tissue-item';

                tissueItem.innerHTML = `
                    <div class="tissue-details">
                        <h3>기계 코드: ${item.Machine_Code}</h3>
                        <p>성별: ${item.Gender}</p>
                        <p>상태 : ${item.State_Content}</p>
                    </div>
                `;
                tissueList.appendChild(tissueItem); // 생성한 요소를 리스트에 추가
            });
        })
        .catch(error => {
            console.error('데이터를 가져오는 중 오류 발생:', error);
        });
}
