
<body id="review">
    <div id="app">
        <input type="radio" name="menu" id="menu_on">
        <input type="radio" name="menu" id="menu_off" checked>
        <input type="radio" name="sns" id="sns_on">
        <input type="radio" name="sns" id="sns_off" checked>
        <header class="flex">
            <div class="logo flex">
                <a href="./index.html">
                    <img src="./img/slogan.png" alt="sloganImg" title="sloganImg">
                </a>
                <button class="open_btn">후기작성</button>
            </div>
            <div class="menus flex">
                <div class="menu">
                    <label for="menu_on" class="menu_on">
                        <i class="fa fa-align-justify"></i>
                    </label>
                </div>
                <div class="sns">
                    <label for="sns_on" class="sns_on">
                        <i class="fa fa-ellipsis-v"></i>
                    </label>
                    <label for="sns_off" class="sns_off">
                        <i class="fa fa-close"></i>
                    </label>
                    <div class="sns_box flex">
                        <img src="./img/icon1.png" alt="iconImg1" title="iconImg1">
                        <img src="./img/icon2.png" alt="iconImg2" title="iconImg2">
                        <img src="./img/icon3.png" alt="iconImg3" title="iconImg3">
                    </div>
                </div>
            </div>
        </header>
        <section class="review sub">
            <h3 class="prev side">PREV</h3>
            <h3 class="next side">NEXT</h3>
            <h3 class="title">고객이 작성하는 구매후기</h3>
            <div class="anno">
                <img src="./img/review_anno.png" alt="reviewAnnoImg" title="reviewAnnoImg">
                <!-- <fieldset>
                    <legend><span class="high">경상남도</span> 특산품의 <span class="high">소중한 구매 후기</span>를 찾습니다.</legend>
                    <p>경상남도 특산품을 <span class="high">사랑하는 고객님</span>의 소중한 경험을 <span class="high">공유</span>함으로써, <span class="high">지역 특산품</span>을 홍보하고 판매를 <span class="high">증진</span>시켜, 경상남도 농가의 <span class="high">소득 증대</span>는 물론, 품질이 <span class="high">좋은 특산품</span>을 보다 많은 고객분들과 공유하기 위해 구매 후기를 <span class="high">모집</span>합니다.</p>
                </fieldset> -->
            </div>
            <div class="review-container grid">
                <!-- <div class="item">
                    <p class="name">wnsdn</p>
                    <p class="date">2022-04-01</p>
                    <div class="photo">
                        <img src="./(웹디자인)선수제공파일/사진/photo (1).jpg" alt="reviewImg" title="reviewImg">
                    </div>
                    <div class="score_box">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <p class="product">구매품: 사과</p>
                    <p class="shop">구매처: 온라인 홈쇼핑</p>
                    <p class="content">내용: Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ipsum velit blanditiis iusto sed quis impedit eos ducimus qui mollitia! Voluptatum.</p>
                </div> -->
            </div>
        </section>
        <footer>
            <p>Copyright (C) Gyeongsangbuk-do.All Rights Reserved.</p>
        </footer>
        <div class="menu_popup flex">
            <div class="popup-menu flex">
                <label for="menu_off" class="close">
                    <i class="fa fa-close"></i>
                </label>
                <nav>
                    <ul>
                    <li><a href="/sub1">특산품 안내</a></li>
                        <li><a href="/sub2">이벤트</a></li>
                        <li class="high"><a href="/sub3">구매후기</a></li>
                        <li><a href="/admin_specialty">특산품 관리</a></li>
                        <li><a href="/admin_event">이벤트 관리</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        
        <div class="review_modal flex">
            <form method="post" class="grid">
                <button type="button" class="close">닫기</button>
                <label>
                    이름
                    <input type="text" name="name">
                </label>
                <label>
                    구매품
                    <input type="text" name="product">
                </label>
                <label>
                    구매처
                    <input type="text" name="shop">
                </label>
                <label>
                    구매일
                    <input type="date" name="purchase-date">
                </label>
                <label>
                    내용
                    <textarea name="contents"></textarea>
                </label>
                <label>
                    별점
                    <div class="score_container">
                        <i class="fa fa-star-o"></i
                        ><i class="fa fa-star-o"></i
                        ><i class="fa fa-star-o"></i
                        ><i class="fa fa-star-o"></i
                        ><i class="fa fa-star-o"></i>
                    </div>
                    <input type="hidden" name="score" value="0">
                </label>
                <label class="photo_box">
                    사진
                    <button type="button" class="add_photo">사진추가</button>
                </label>
                <input type="submit" value="후기등록">
            </form>
        </div>
        

        <script src="./js/script.js"></script>
    </div>
</body>


