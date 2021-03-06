<body id="event">
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
        <section class="event sub">
            <h3 class="prev side">PREV</h3>
            <h3 class="next side">NEXT</h3>
            <h3 class="title">같은그림찾기&출석 이벤트</h3>
            <div class="anno">
                <div class="photo">
                    <img src="./img/event_anno.png" alt="eventAnnoImg" title="eventAnnoImg">
                </div>
                <!-- <fieldset>
                    <legend><span class="high">경상남도 특산품</span>을 <span class="high">기억</span>하라!</legend>
                    <p>같은 카드 찾기 게임에 <span class="high">3일 연속</span> 이벤트에 참여해 주신 분 중 <span class="high">100분</span>을 추첨하여 전통시장 및 상점에서 사용 가능한 <span class="high">"온누리 상품권 5,000원권"</span>을 보내 드립니다. 경상남도 특산품도 알아보고 <span class="high">재미있는 게임</span>도 즐길 수 있는 이번 이벤트에 <span class="high">많은 참여</span> 바랍니다.</p>

                    <nav>
                        <ul>O 이벤트 <span class="high">참여</span> 및 경품 <span class="high">안내</span>
                            <li>- 참여방법 : <span class="high">3일 연속</span>으로 아래의 같은 카드 찾기 게임 참여하기</li>
                            <li>- 경품안내 : 온누리 상품권 <span class="high">5,000원권</span></li>
                            <li>- 당첨대상 : 3일 연속 게임 이벤트에 참여한 분 중 <span class="high">100명</span> 추첨</li>
                        </ul>
                    </nav>
                </fieldset> -->
                <img src="./img/event.jpg" alt="eventImg" title="eventImg">
            </div>
            <div class="game">
                <h3>-같은 <span class="high">그림 찾기</span>-</h3>
                <div class="card-container grid">
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"></div>
                    </div>
                </div>
            </div>
            <div class="display">
                <div class="time"><span class="min">00</span>분 <span class="sec">00</span>초</div>
                <p class="score_box">내가 찾은 카드 수: <span class="score">0</span>개</p>
            </div>
            <div class="btns flex">
                <button class="start_btn">게임시작</button>
                <button class="restart_btn none">다시하기</button>
                <button class="hint_btn">힌트보기</button>
            </div>
            <div class="stamp">
                <h3>stamp</h3>
                <div class="stamp_container flex">
                    <div class="item flex">
                        <h4>YYYY-MM-DD</h4>
                    </div>
                    <div class="item flex">
                        <h4>YYYY-MM-DD</h4>
                    </div>
                    <div class="item flex">
                        <h4>YYYY-MM-DD</h4>
                    </div>
                </div>
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
                        <li class="high"><a href="/sub2">이벤트</a></li>
                        <li><a href="/sub3">구매후기</a></li>
                        <li><a href="/admin_specialty">특산품 관리</a></li>
                        <li><a href="/admin_event">이벤트 관리</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="event_modal flex none">
            <form method="post" class="flex">
                <input type="hidden" name="score" value="0">
                <label>
                    이름
                    <input type="text" name="name" placeholder="이름을 입력해주세요">
                </label>
                <label>
                    전화번호
                    <input type="text" name="tel" maxlength="13" placeholder="전화번호를 입력해주세요">
                </label>
                <input type="submit" value="등록">
            </form>
        </div>
    </div>
    <script src="./js/script.js"></script>
</body>