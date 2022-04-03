
<body id="event">
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
                            <li class="high"><a href="/sub2">이벤트</a></li>
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
        <section class="event">
            <div class="side prev">PREV</div>
            <div class="side next">NEXT</div>
            <h3 class="title">EVENT</h3>
            <div class="anno">
                <div class="photo">
                    <img src="./img/event_anno.png" alt="eventAnnoImg" title="eventAnnoImg">
                </div>
                <!-- <fieldset>
                    <legend>경상남도 특산품을 기억하라!</legend>
                    <p>같은 카드 찾기 게임에 3일 연속 이벤트에 참여해 주신 분 중 100분을 추첨하여 전통시장 및 상점에서
                        사용 가능한 "온우리 상품권 5,000원권"을 보내 드입니다. 경상남도 특산품도 알아보고 재미있는 게임도 즐길 수
                        있는 이번 이벤트에 많은 참여 바랍니다.</p>
                    <ul>O <span class="high">이벤트 참여 및 경품 안내</span>
                        <li>- 참여방법 : 3일 연속으로 아래의 같은 카드 찾기 게임 참여하기</li>
                        <li>- 경품안내 : 온누리 상품권 5,000원권</li>
                        <li>- 당첨대상 : 3일 연속 게임 이벤트에 참여한 분 중 100명 추첨</li>
                    </ul>
                </fieldset> -->
                <img src="./img/event.jpg" class="subImg" alt="eventImg" title="eventImg">
            </div>
            <div class="game">
                <h3><i class="fa fa-graduation-cap"></i> 같은 그림 찾기</h3>
                <div class="card-container grid">
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"><i class="fa fa-info"></i></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"><i class="fa fa-info"></i></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"><i class="fa fa-info"></i></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"><i class="fa fa-info"></i></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"><i class="fa fa-info"></i></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"><i class="fa fa-info"></i></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"><i class="fa fa-info"></i></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"><i class="fa fa-info"></i></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"><i class="fa fa-info"></i></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"><i class="fa fa-info"></i></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"><i class="fa fa-info"></i></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"><i class="fa fa-info"></i></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"><i class="fa fa-info"></i></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"><i class="fa fa-info"></i></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"><i class="fa fa-info"></i></div>
                    </div>
                    <div class="card">
                        <div class="item front"></div>
                        <div class="item back"><i class="fa fa-info"></i></div>
                    </div>
                </div>
                <div class="display flex">
                    <div class="time"><span class="min">0</span>분 <span class="sec">0</span>초</div>
                    <div class="score-box">내가 찾은 카드 수: <span class="score">0</span>개</div>
                </div>
                <div class="btns flex">
                    <button class="start_btn">게임시작</button>
                    <button class="restart_btn none">다시하기</button>
                    <button class="hint_btn">힌트보기</button>
                </div>
                <div class="stamp">
                    <h3>stamp</h3>
                    <div class="stamp-container flex">
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
            </div>
        </section>
        <!-- 푸터 영역 -->
        <footer>
            <p>Copyright (C) Gyeongsangbuk-do. All Rights Reserved.</p>
        </footer>
    </div>
    <div class="event_modal flex none">
        <form class="flex">
            <label>
                점수
                <input type="text" name="score" value="0" readonly>
            </label>
            <label>
                이름
                <input type="text" name="name">
            </label>
            <label>
                전화번호
                <input type="text" name="tel" maxlength="13">
            </label>
            <input type="submit" value="등록">
        </form>
    </div>
    <script src="./js/script.js"></script>
</body>