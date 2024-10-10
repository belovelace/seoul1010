<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8"%>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>휴지 상태 확인</title>
    <link rel="stylesheet" href="/css/searchCode.css"> <!-- CSS 파일 경로 -->
</head>
<body>

<!-- 헤더 섹션 -->
<%@include file="util/header.jsp"%>


<main>
    <section class="search-section">
        <input type="text" id="searchInput" placeholder="기기 코드로 검색..." />
        <button onclick="searchMachineCode()">검색</button> <!-- 검색 버튼 추가 -->
    </section>

    <section class="tissue-list" id="tissueList">
        <!-- 동적으로 추가될 화장실 정보 -->
    </section>
</main>

<%@include file="util/footer.jsp"%>
<script src="/js/searchCode.js"></script> <!-- JavaScript 파일 경로 -->
</body>
</html>
