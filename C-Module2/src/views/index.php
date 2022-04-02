
<body>
    <div id="app">
        <input type="radio" name="menu" id="menu_on">
        <input type="radio" name="menu" id="menu_off" checked>
        <input type="radio" name="sns" id="sns_on">
        <input type="radio" name="sns" id="sns_off" checked>
        <!-- 헤더 영역 -->
        <header>
            <div class="logo">
                <a href="/">
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
                            <li><a href="/sub3">구매후기</a></li>
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
        <section class="main">
            <div class="side prev">PREV</div>
            <div class="side next">NEXT</div>
            <section class="content flex">
                <div class="item">
                    <img src="./img/subImg.png" class="sub-img" alt="subImg" title="subImg">
                    <div class="photo">
                        <img src="./img/content1.jpg" alt="contentImg1" title="contentImg1">
                    </div>
                    <div class="text">
                        <h3><i class="fa fa-diamond"></i> SPECIALTY</h3>
                        <p>Culpa vitae quasi iusto eligendi ipsum asperiores. Est explicabo voluptatibus cupiditate quia labore rerum? laboriosam</p>
                    </div>
                    <button><a href="/sub1">MORE</a></button>
                </div>
                <div class="item">
                    <img src="./img/subImg.png" class="sub-img" alt="subImg" title="subImg">
                    <div class="photo">
                        <img src="./img/content2.jpg" alt="contentImg2" title="contentImg2">
                    </div>
                    <div class="text">
                        <h3><i class="fa fa-info"></i> EVENT</h3>
                        <p>provident inventore, vel delectus architecto unde consequuntur beatae minima, culpa expedita at odit. Facilis, excepturi Odit quod voluptate est consequatur, dolore nihil odio nisi repellendus</p>
                    </div>
                    <button><a href="/sub1">MORE</a></button>
                </div>
                <div class="item">
                    <img src="./img/subImg.png" class="sub-img" alt="subImg" title="subImg">
                    <div class="photo">
                        <img src="./img/content3.jpg" alt="contentImg3" title="contentImg3">
                    </div>
                    <div class="text">
                        <h3><i class="fa fa-comments"></i> REVIEW</h3>
                        <p>commodi eligendi dolore sed quasi consequatur. Odit quod voluptate est consequatur, dolore nihil odio nisi repellendus</p>
                    </div>
                    <button><a href="/sub1">MORE</a></button>
                </div>
            </section>
        </section>
        <!-- 푸터 영역 -->
        <footer>
            <p>Copyright (C) Gyeongsangbuk-do. All Rights Reserved.</p>
        </footer>
    </div>
</body>