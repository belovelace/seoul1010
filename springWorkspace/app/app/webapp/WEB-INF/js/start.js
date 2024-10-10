// src/main/resources/static/js/start.js

document.addEventListener('DOMContentLoaded', function() {
    const startButton = document.querySelector('.start-btn');
    const message = document.getElementById('startMessage');

    startButton.addEventListener('click', function() {
        message.textContent = "시작 버튼이 클릭되었습니다!";
        alert("시작 버튼을 클릭했습니다.");
    });

    const adminLoginForm = document.getElementById('adminLoginForm');
    adminLoginForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const adminId = document.getElementById('adminId').value;
        const adminPassword = document.getElementById('adminPassword').value;

        // 간단한 로그인 로직 (예시)
        if(adminId === "admin" && adminPassword === "password") {
            alert("로그인 성공!");
            // 추가적인 로직을 여기에 추가
        } else {
            alert("아이디 또는 비밀번호가 올바르지 않습니다.");
        }
    });
});
