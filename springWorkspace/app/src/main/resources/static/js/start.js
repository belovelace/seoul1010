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

        // 2.5초 후에 클릭 이벤트 실행
        setTimeout(function() {
            if (!message.textContent) {
                message.textContent = "시작합니다!";
                message.classList.add('show');
                console.log("메시지 표시");
            } else {
                // 이미 메시지가 표시된 경우 숨기기
                message.textContent = "";
                message.classList.remove('show');
                console.log("메시지 숨김");
            }

            // '시작' 버튼을 눌렀을 때 2.5초 뒤에 페이지 이동 실행
            window.location.href = 'Http://127.0.0.1:8686/home';
        }, 2500); // 2500ms = 2.5초
    });
});
