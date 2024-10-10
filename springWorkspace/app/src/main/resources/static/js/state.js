document.addEventListener('DOMContentLoaded', function() {
    fetch('http://localhost/php/state.php') // PHP 파일 경로 설정
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json(); // JSON 형식으로 변환
        })
        .then(data => {
            const tissueList = document.getElementById('tissueList');
            tissueList.innerHTML = ''; // 리스트 초기화

            if (data.length > 0) {
                data.forEach(item => {
                    const tissueItem = document.createElement('div');
                    tissueItem.classList.add('tissue-item');
                    tissueItem.innerHTML = `
                        <div class="tissue-details">
                            <h3>기기 코드: ${item.Machine_Code}</h3>
                            <p>상태 내용: ${item.State_Content}</p>  <!-- 상태 내용 추가 -->
                        </div>
                    `;
                    tissueList.appendChild(tissueItem);
                });
            } else {
                tissueList.innerHTML = '<div class="tissue-item">조회된 결과가 없습니다.</div>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            const tissueList = document.getElementById('tissueList');
            tissueList.innerHTML = '<div class="tissue-item">데이터를 불러오는 데 실패했습니다.</div>';
        });
});
