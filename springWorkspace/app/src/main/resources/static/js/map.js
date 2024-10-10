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

    var imageSrc = 'https://cdn-icons-png.flaticon.com/512/2840/2840372.png', // 마커이미지의 주소입니다
        imageSize = new kakao.maps.Size(64, 69), // 마커이미지의 크기입니다
        imageOption = {offset: new kakao.maps.Point(27, 69)}; // 마커이미지의 옵션입니다. 마커의 좌표와 일치시킬 이미지 안에서의 좌표를 설정합니다.

    // 마커의 이미지정보를 가지고 있는 마커이미지를 생성합니다
    var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imageOption);

    // 마커를 표시할 위치와 내용을 가지고 있는 객체 배열입니다 -> 추후에는 ajax로 넘기면 될듯
    var positions = [
        {
            content: '<div class="customoverlay">' +
                '  <a href="https://map.kakao.com/link/map/11394059" target="_blank">' +
                '    <span class="title">구의야구공원</span>' +
                '  </a>' +
                '</div>',
            latlng: new kakao.maps.LatLng(37.54699, 127.09598)
        },
        {
            content: '<div class="customoverlay">' +
                '  <a href="https://map.kakao.com/link/map/11394059" target="_blank">' +
                '    <span class="title">복우물공원</span>' +
                '  </a>' +
                '</div>',
            latlng: new kakao.maps.LatLng(37.455059, 127.128223)
        },
        {
            content: '<div class="customoverlay">' +
                '  <a href="https://map.kakao.com/link/map/11394059" target="_blank">' +
                '    <span class="title">효창공원</span>' +
                '  </a>' +
                '</div>',
            latlng: new kakao.maps.LatLng(37.544806, 126.959170)
        },
        {
            content: '<div class="customoverlay">' +
                '  <a href="https://map.kakao.com/link/map/11394059" target="_blank">' +
                '    <span class="title">평화의공원</span>' +
                '  </a>' +
                '</div>',
            latlng: new kakao.maps.LatLng(37.562035, 126.894650)
        }
    ];

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
        // 예: 커스텀 오버레이를 클릭 시 토글
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
}







