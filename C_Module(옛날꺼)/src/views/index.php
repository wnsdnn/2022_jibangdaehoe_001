    <div id="app" class="grid">
        <input type="radio" id="menu_on" name="menu">
        <input type="radio" id="menu_off" name="menu" checked>
        <input type="radio" id="sns_on" name="sns">
        <input type="radio" id="sns_off" name="sns" checked>
        <header class="flex">
            <div class="logo">
                <img src="./img/slogan.png" alt="sloganImg" title="sloganImg">
            </div>
            <div class="menu"><label for="menu_on">MENU</label></div>
            <div class="sns">
                <label class="sns_on" for="sns_on">SNS</label>
                <label class="sns_off" for="sns_off">X</label>
                <div class="sns_box flex">
                    <img src="./img/icon1.png" alt="snsImg1" title="snsImg1">
                    <img src="./img/icon2.png" alt="snsImg2" title="snsImg2">
                    <img src="./img/icon3.png" alt="snsImg3" title="snsImg3">
                </div>
            </div>
        </header>
        <main class="main flex">
            <section class="specialty">
                <a href="/sub1">
                    <div class="photo">
                        <img src="./(웹디자인)선수제공파일/사진/photo (3).jpg" alt="">
                    </div>
                    <div class="text">
                        <h3>경상남도 특산품 소개</h3>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Incidunt obcaecati fuga, delectus neque molestias reprehenderit.</p>
                    </div>
                    <div class="sub_img">
                        <img src="./img/subImg.png" alt="subImg1" title="subImg1">
                    </div>
                </a>
            </section>
            <section class="event">
                <a href="/sub2">
                    <div class="photo">
                        <img src="./(웹디자인)선수제공파일/사진/photo (7).jpg" alt="">
                    </div>
                    <div class="text">
                        <h3>같은그림찾기 & 출석 이벤트</h3>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Incidunt obcaecati fuga, delectus neque molestias reprehenderit.</p>
                    </div>
                    <div class="sub_img">
                        <img src="./img/subImg.png" alt="subImg2" title="subImg2">
                    </div>
                </a>
            </section>
            <section class="review">
                <a href="/sub3">
                    <div class="photo">
                        <img src="./(웹디자인)선수제공파일/사진/photo (12).jpg" alt="">
                    </div>
                    <div class="text">
                        <h3>고객이 작성하는 구매후기</h3>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Incidunt obcaecati fuga, delectus neque molestias reprehenderit.</p>
                    </div>
                    <div class="sub_img">
                        <img src="./img/subImg.png" alt="subImg3" title="subImg3">
                    </div>
                </a>
            </section>
            <div class="left_box box flex">
                <h3>PREV</h3>
            </div>
            <div class="right_box box flex">
                <h3>NEXT</h3>
            </div>
        </main>
        <footer>
            <p>Copyright (C) Gyeongsangbuk-do.All Rights Reserved.</p>
        </footer>
        <div class="popup flex">
            <div class="menu">
                <ul>사용자 페이지
                    <li class="high"><a href="/">메인페이지</a></li>
                    <li><a href="/sub1">특산품 안내</a></li>
                    <li><a href="/sub2">이벤트</a></li>
                    <li><a href="/sub3">구매후기</a></li>
                </ul>
                <ul>관리자 페이지
                    <li><a href="/admin_specialty">특산품 관리</a></li>
                    <li><a href="/admin_event">이벤트 관리</a></li>
                </ul>
                <div class="close_btn">
                    <label for="menu_off">X</label>
                </div>
            </div>
        </div>
    </div>
