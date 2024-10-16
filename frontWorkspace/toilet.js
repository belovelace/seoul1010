document.addEventListener('DOMContentLoaded', () => {
  fetchTissueData(); // 페이지 로드 시 데이터 가져오기
});

// 데이터 가져오기 함수
function fetchTissueData() {
  fetch('parkToiletLook.php') // PHP 파일의 경로
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

// 데이터 표시 함수
function displayTissueData(data) {
  const tissueList = document.getElementById('tissueList');
  tissueList.innerHTML = ''; // 기존 내용 초기화

  data.forEach(item => {
      const tissueItem = document.createElement('div');
      tissueItem.className = 'tissue-item';
      tissueItem.innerHTML = `
          <h2 class="restroom-code">화장실 코드: ${item.toilet_code}</h2>
          <p class="stall-number">${item.stall_number}번 칸</p>
          <p class="tissue-status">휴지 잔여 상태: ${item.state_content}</p>
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
      const stall = tissues[i].getElementsByClassName('stall-number')[0].innerText.toLowerCase();
      if (code.includes(filter) || stall.includes(filter)) {
          tissues[i].style.display = "";
      } else {
          tissues[i].style.display = "none";
      }
  }
}
