document.addEventListener("DOMContentLoaded", function() {
    // Geolocation API를 사용하여 현재 위치 정보를 가져옴
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(onGeoSuccess, onGeoError);
    } else {
        console.error("이 브라우저에서는 Geolocation이 지원되지 않습니다.");
    }
});

// Geolocation 성공 시 호출되는 함수
function onGeoSuccess(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;

    // 현재 위치의 위도와 경도로 지도 표시
    showMap(latitude, longitude);
}

// Geolocation 실패 시 호출되는 함수
function onGeoError(error) {
    console.error("Geolocation 오류 " + error.code + ": " + error.message);

    // 기본값: 서울의 위도와 경도로 지도 표시
    var latitude = 37.5665;
    var longitude = 126.9780;
    showMap(latitude, longitude);
}

////////////////////////카카오 맵 API////////////////////////////////////
function showMap(latitude, longitude) {
    var container = document.getElementById('map');
    var options = {
        center: new kakao.maps.LatLng(latitude, longitude),
        level: 3
    };

    var map = new kakao.maps.Map(container, options);

    // PHP에서 데이터를 가져오는 부분
    fetch('http://localhost/php/showMap.php') // PHP 파일 경로
        .then(response => response.json()) // JSON 형식으로 변환
        .then(data => {
            if (data.error) {
                console.error('Error from PHP:', data.error);
                return;
            }

// positions 배열을 PHP 데이터로 변환
            // positions 배열을 PHP 데이터로 변환
            var positions = data.map(park => {
                let parkId = park.code; // park.code를 parkId로 사용
                let href = 'http://127.0.0.1:8787/parkId' + parkId; // URL을 parkId에 맞게 설정

                return {
                    content: '<div class="customoverlay">' +
                        '  <a href="' + href + '" target="_blank">' + // parkId에 따라 링크 설정
                        '    <span class="title">' + park.name + '</span>' +
                        '  </a>' +
                        '</div>',
                    latlng: new kakao.maps.LatLng(park.latitude, park.longitude)
                };
            });




            // 마커와 커스텀 오버레이 생성
            var imageSrc = 'https://cdn-icons-png.flaticon.com/512/2840/2840372.png', // 마커이미지의 주소입니다
                imageSize = new kakao.maps.Size(64, 69), // 마커이미지의 크기입니다
                imageOption = {offset: new kakao.maps.Point(27, 69)}; // 마커이미지의 옵션입니다

            // 마커의 이미지
            var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imageOption);

            for (var i = 0; i < positions.length; i++) {
                // 마커를 생성합니다
                var marker = new kakao.maps.Marker({
                    map: map, // 마커를 표시할 지도
                    position: positions[i].latlng, // 마커의 위치
                    image: markerImage // 커스텀 마커 이미지
                });

                // 커스텀 오버레이에 표출될 내용으로 HTML 문자열이나 document element가 가능합니다
                var content = positions[i].content;

                // 커스텀 오버레이를 생성합니다
                var customOverlay = new kakao.maps.CustomOverlay({
                    map: map,
                    position: positions[i].latlng,
                    content: content,
                    yAnchor: 1
                });

                // 기본적으로 커스텀 오버레이는 지도에 표시됩니다. 필요에 따라 표시/숨김을 제어할 수 있습니다.
                (function(marker, customOverlay) {
                    kakao.maps.event.addListener(marker, 'click', function() {
                        if (customOverlay.getMap()) {
                            customOverlay.setMap(null);
                        } else {
                            customOverlay.setMap(map);
                        }
                    });
                })(marker, customOverlay);
            }
        })
        .catch(error => console.error('Error fetching data:', error)); // 오류 처리
}








