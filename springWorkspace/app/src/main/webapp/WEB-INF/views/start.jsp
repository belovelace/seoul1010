<%@ page language="java" contentType="text/html; charset=UTF-8"
         pageEncoding="UTF-8"%>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>잘 풀리는 팀 start</title>
    <link rel="stylesheet" href="/css/start.css">
    <!-- Google Fonts 추가 (선택 사항) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Black+Han+Sans&family=Grandiflora+One&display=swap" rel="stylesheet">
</head>
<body>

<div class="container">
    <header class="header">
        <h1>잘풀리는 팀</h1>
        <p class="message" id="startMessage"></p> <!-- 메시지 요소 -->
    </header>
    <div class="content">
        <button class="start-btn">시작</button>
    </div>

    <!-- 관리자 로그인 폼 추가 -->
    <form id="adminLoginForm" class="admin-login-form">
        <input type="text" id="adminId" placeholder="아이디" required />
        <input type="password" id="adminPassword" placeholder="비밀번호" required />
        <button type="submit" class="login-btn"> 관리자 로그인</button>
    </form>
</div>

<script src="/js/start.js"></script>
</body>
</html>