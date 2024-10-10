<%@ page language="java" contentType="text/html; charset=UTF-8"
         pageEncoding="UTF-8"%>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>휴지 상태 확인</title>
    <link rel="stylesheet" href="/css/parkId.css"> <!-- CSS 파일 경로 -->
</head>
<body>

<!-- 헤더 파일 포함 (필요 시) -->
<%@ include file="/WEB-INF/views/util/header.jsp" %>

<main>
    <section class="tissue-list" id="tissueList">
        <!-- 동적으로 추가될 화장실 정보 -->
    </section>
</main>

<script src="/js/parkId/parkId1.js"></script>
</body>
</html>
