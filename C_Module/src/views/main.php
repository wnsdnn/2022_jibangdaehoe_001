
<body>
    <div id="app">
        <input type="radio" name="menu" id="menu_on">
        <input type="radio" name="menu" id="menu_off" checked>
        <input type="radio" name="sns" id="sns_on">
        <input type="radio" name="sns" id="sns_off" checked>
        <header class="flex">
            <div class="logo">
                <a href="./index.html">
                    <img src="./img/slogan.png" alt="sloganImg" title="sloganImg">
                </a>
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
        <section class="main-container">
            <h3 class="prev side">PREV</h3>
            <h3 class="next side">NEXT</h3>
            <div class="content flex">
                <a href="/sub1">
                    <div class="item">
                        <img src="./img/subImg.png" class="sub_img" alt="subImg" title="subImg">
                        <div class="photo">
                            <img src="./img/content1.jpg" alt="contentImg1" title="contentImg1">
                        </div>
                        <div class="text">
                            <h4>경상남도 특산품 소개</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem animi incidunt quia voluptatibus voluptates. Ipsum culpa debitis enim ab esse?</p>
                        </div>
                    </div>
                </a>
                <a href="/sub2">
                    <div class="item">
                        <img src="./img/subImg.png" class="sub_img" alt="subImg" title="subImg">
                        <div class="photo">
                            <img src="./img/content2.jpg" alt="contentImg2" title="contentImg2">
                        </div>
                        <div class="text">
                            <h4>같은그림찾기&출석 이벤트</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem animi incidunt quia voluptatibus voluptates. Ipsum culpa debitis enim ab esse?</p>
                        </div>
                    </div>
                </a>
                <a href="/sub3">
                    <div class="item">
                        <img src="./img/subImg.png" class="sub_img" alt="subImg" title="subImg">
                        <div class="photo">
                            <img src="./img/content3.jpg" alt="contentImg3" title="contentImg3">
                        </div>
                        <div class="text">
                            <h4>고객이 작성하는 구매후기</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem animi incidunt quia voluptatibus voluptates. Ipsum culpa debitis enim ab esse?</p>
                        </div>
                    </div>
                </a>
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
                        <li><a href="/sub3">구매후기</a></li>
                        <li><a href="/admin_specialty">특산품 관리</a></li>
                        <li><a href="/admin_event">이벤트 관리</a></li>
                    </ul>
                </nav>
                
            </div>
        </div>
    </div>
</body>