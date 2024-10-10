document.addEventListener('DOMContentLoaded', function() {
  // '시작' 버튼 클릭 시 이벤트
  const startButton = document.querySelector('.start-btn');
  const message = document.getElementById('startMessage');

  if (!startButton) {
      console.error("'.start-btn' 클래스를 가진 버튼을 찾을 수 없습니다.");
      return;
  }

  if (!message) {
      console.error("id 'startMessage'를 가진 요소를 찾을 수 없습니다.");
      return;
  }

  startButton.addEventListener('click', function() {
      console.log("시작 버튼 클릭됨"); // 디버깅용 로그

      if (!message.textContent) {
          message.textContent = "시작합니다!";
          message.classList.add('show');
          console.log("메시지 표시");

     // 2.5초 후에 페이지 이동 실행
    setTimeout(function() {
    location.href = 'Http://127.0.0.1:8787/user';
    }, 1500); // 2500ms = 2.5초

      } else {
          // 이미 메시지가 표시된 경우 숨기기
          message.textContent = "";
          message.classList.remove('show');
          console.log("메시지 숨김");
      }
  });
});

/////// 관리자 로그인
// 관리자 로그인
document.getElementById('adminLoginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // 기본 제출 동작 방지

    const adminId = document.getElementById('adminId').value;
    const adminPassword = document.getElementById('adminPassword').value;

    // AJAX 요청
    fetch('http://localhost/php/adminLogin.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            'adminId': adminId,
            'adminPassword': adminPassword
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('로그인 성공!');
                // 로그인 성공 후 페이지 이동
                location.href = 'home'; // 성공 후 이동할 페이지
            } else {
                alert(data.message); // 서버에서 보낸 에러 메시지 표시
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('로그인 중 오류가 발생했습니다.');
        });
});





