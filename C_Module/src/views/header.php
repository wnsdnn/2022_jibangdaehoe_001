<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <nav class="menu">
        <ul>
            <li><a href="/">홈</a></li>
            <?php if(isset($_SESSION["admin"])): ?>
                <li><a href="/logout">관리자 로그아웃</a></li>
            <?php else: ?>
                <li><a href="/admin">관리자 로그인</a></li>
            <?php endif; ?>
            <li><a href="/specialty">특산품 페이지</a></li>
            <li><a href="/event">이벤트 등록</a></li>
            <li><a href="/review">구매후기 작성</a></li>
            <li><a href="/reviewList">구매후기 리스트</a></li>
            <li><a href="/specialty_admin">특산품 관리 (관리자 페이지)</a></li>
            <li><a href="/event_admin">이벤트 관리 (관리자 페이지)</a></li>
            <!-- <li><a href="/api/reviews?last-key=100">구매후기 리스트 api</a></li> -->
            <!-- <li><a href="/reviewTest">리뷰 기능 테스트</a></li> -->
        </ul>
    </nav>