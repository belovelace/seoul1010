document.addEventListener("DOMContentLoaded", function() {
    // 버튼 클릭 시 URL로 이동하는 함수
    var viewTrashStatusButton = document.getElementById("viewTrashStatus");
    var viewAllParksButton = document.getElementById("viewAllParks");

    if (viewTrashStatusButton) {
        viewTrashStatusButton.addEventListener("click", function() {
            // 지정된 URL로 이동
            window.location.href = "http://127.0.0.1:8787/search";
        });
    }

    if (viewAllParksButton) {
        viewAllParksButton.addEventListener("click", function() {
            // 지정된 URL로 이동
            window.location.href = "http://127.0.0.1:8787/state";
        });
    } else {
        console.error("viewAllParks 버튼을 찾을 수 없습니다.");
    }
});
