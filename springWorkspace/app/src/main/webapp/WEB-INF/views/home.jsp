<%@ page language="java" contentType="text/html; charset=UTF-8"
         pageEncoding="UTF-8"%>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/home.css">
    <!-- Google Fonts 추가 (선택 사항) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Black+Han+Sans&family=Grandiflora+One&display=swap" rel="stylesheet">
</head>
<body>

<div class="container"></div>
<%@include file="util/header.jsp"%>

<div class="menu">
    <button id="viewAllParks">모든 공원 조회</button>
    <button id="viewTrashStatus">휴지 상태로 조회</button>
    <button id="viewGoHome">시작화면으로 이동</button>
</div>

<div class="map-container">
    <%@include file="map.jsp"%>
</div>

<%@include file="util/footer.jsp"%>
</body>
</html>