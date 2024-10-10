document.addEventListener("DOMContentLoaded", function() {
    // 버튼 클릭 시 URL로 이동하는 함수
    var homeButton = document.getElementById("viewGoHome");

    if (homeButton) {  // null 체크
        homeButton.addEventListener("click", function() {
            // 지정된 URL로 이동
            window.location.href = "http://127.0.0.1:8787/start";
        });
    } else {
        console.error("viewGoHome 버튼을 찾을 수 없습니다.");
    }
});
