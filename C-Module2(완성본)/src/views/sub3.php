<body id="review">
    <div id="app">
        <input type="radio" name="menu" id="menu_on">
        <input type="radio" name="menu" id="menu_off" checked>
        <input type="radio" name="sns" id="sns_on">
        <input type="radio" name="sns" id="sns_off" checked>
        <!-- 헤더 영역 -->
        <header>
            <div class="logo">
                <a href="/index">
                    <img src="./img/slogan.png" alt="logoImg" title="logoimg">
                </a>
            </div>
            <div class="menus flex">
                <div class="menu">
                    <label for="menu_on">
                        <i class="fa fa-bars"></i>
                    </label>
                    <label for="menu_off">
                        <i class="fa fa-close"></i>
                    </label>
                    <div class="menu-list">
                        <ul class="flex">
                            <li><a href="/sub1">특산품 안내</a></li>
                            <li><a href="/sub2">이벤트</a></li>
                            <li class="high"><a href="/sub3">구매후기</a></li>
                            <li><a href="/admin_specialty">특산품 관리</a></li>
                            <li><a href="/admin_event">이벤트 관리</a></li>
                        </ul>
                    </div>
                </div>
                <div class="sns">
                    <label for="sns_on">
                        <i class="fa fa-external-link"></i>
                    </label>
                    <label for="sns_off">
                        <i class="fa fa-close"></i>
                    </label>
                    <div class="sns-container">
                        <img src="./img/icon1.png" alt="snsImg1" title="snsImg1">
                        <img src="./img/icon2.png" alt="snsImg2" title="snsImg2">
                        <img src="./img/icon3.png" alt="snsImg3" title="snsImg3">
                    </div>
                </div>
            </div>
        </header>
        <!-- 메인 영역 -->
        <section class="review">
            <div class="side prev">PREV</div>
            <div class="side next">NEXT</div>
            <button class="add_review">후기 작성</button>
            <h3 class="title">REVIEW</h3>
            <div class="anno">
                <!-- <fieldset class="flex">
                    <legend>경상남도 특산품의 <span class="high">소중한 구매 후기</span>를 찾습니다.</legend>
                    <p class="text"><span class="high">경상남도 특산품</span>을 사랑하는 고객님의 소중한 경험을 공유함으로써, 지역 특산품을 홍보
                        하고 판매를 증진시켜, 경상남도 농가의 소득 증대는 물론, 품질이 좋은 특산품을 보다 
                        많은 고객분들과 공유하기 위해 <span class="high">구매 후기를 모집</span> 합니다.</p>
                        <img src="./img/subImg.png" class="sub-img" alt="subImg" title="subImg">
                </fieldset> -->
                <img src="./img/review_anno.png" alt="reviewAnnoImg" title="reviewAnnoImg">
            </div>
            <div class="review-container grid">
                <!-- <div class="item">
                    <h3 class="name">wnsdn</h3>
                    <span class="date">2022-03-31</span>
                    <div class="photo">
                        <img src="./img/content2.jpg" alt="itemImg" title="itemImg">
                    </div>
                    <div class="score-container">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <p>구매처: 전통시장</p>
                    <p>구매품: 찻잎</p>
                    <p>내용 : Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur animi dolor velit nisi officia ad cumque vitae, sapiente tempora, voluptatum necessitatibus, quo atque! Libero a quibusdam quidem consequuntur totam labore!</p>
                </div> -->
     
            </div>
        </section>
        <!-- 푸터 영역 -->
        <footer>
            <p>Copyright (C) Gyeongsangbuk-do. All Rights Reserved.</p>
        </footer>
        <div class="review_modal flex none">
            <form class="grid">
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
                    <input type="date" name="date">
                </label>
                <label>
                    내용
                    <textarea name="content"></textarea>
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
                    <input type="hidden" name="score">
                </label>
                <label class="photo_box">
                    사진
                    <button type="button" class="add_photo">사진추가</button>
                </label>
                <input type="submit" value="후기 등록">
            </form>
        </div>
        <div class="review_datail_modal flex none">
            <form class="flex">
                <input type="hidden" name="key">
                <div class="btn prev"><</div>
                <div class="btn next">></div>
                <div class="btn close"><i class="fa fa-close"></i></div>
                <div class="text">
                    <label class="name">
                        이름
                        <h4>aaa</h4>
                    </label>
                    <label class="product">
                        구매품
                        <h4>aaaa</h4>
                    </label>
                    <label class="shop">
                        구매처
                        <h4>aaaa</h4>
                    </label>
                    <label class="date">
                        구매일
                        <h4>aaaa</h4>
                    </label>
                    <label class="score">
                        별점
                        <h4>aaaa</h4>
                    </label>
                    <label class="content">
                        내용
                        <p>fdsafdsafds</p>
                    </label>
                </div>
                <div class="photo">
                    <div class="main">
                        <img src="./(웹디자인)선수제공파일/특산품/사진2.jpg" alt="">
                    </div>
                    <div class="sub flex">

                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
        script("const lastKey = $key;");
    ?>
    <script src="./js/script.js"></script>
</body>