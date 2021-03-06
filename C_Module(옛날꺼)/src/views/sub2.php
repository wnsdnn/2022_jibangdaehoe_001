<div id="app" class="sub sub2">
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
        <main class="sub sub2 flex">
            <section class="event">
                <h3 class="title">같은그림찾기 & 출석 이벤트</h3>
                <div class="explan">
                    <fieldset>
                        <legend><span class="high">경상남도 특산품</span>을 <span class="high">기억</span>하라!</legend>
                        <p>
                            같은 카드 찾기 게임에 <span class="high">3일 연속</span> 이벤트에 참여해 주신 분 중 <span class="high">100분</span>을 추첨하여 전통시장 및 상점에서 사용 가능한 <span class="high">"온누리 상품권 5,000원권"</span>을 보내 드립니다. 경상남도 특산품도 알아보고 재미있는 게임도 즐길 수 있는 이번 이벤트에 많은 참여 바랍니다.
                        </p>

                        <ul>O 이벤트 참여 및 경품 안내
                            <li>- 참여방법 : <span class="high">3일 연속</span>으로 아래의 같은 카드 찾기 게임 <span class="high">참여</span>하기</li>
                            <li>- 경품안내 : 온누리 상품권 <span class="high">5,000원권</span></li>
                            <li>- 당첨대상 : 3일 연속 게임 이벤트에 참여한 분 중 <span class="high">100명</span> 추첨</li>
                        </ul>
                    </fieldset>
                    <div class="photo">
                        <img src="./img/event.png" alt="eventImg" title="eventImg">
                    </div>
                </div>
                <div class="game">
                    <h3>- 같은 <span class="high">그림찾기</span> -</h3>
                    <div class="game_field grid">
                        <div class="card">
                            <div class="item front">
                                <!-- <img src="../(웹디자인)선수제공파일/특산품/창녕군_양파.jpg" alt="">
                                <h4 class="area">창녕군</h4> -->
                            </div>
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
                    <div class="display flex">
                        <h4 class="time"><span class="min">0</span>:<span class="sec">0</span></h4>
                        <div class="card_score">내가 찾은 카드 수: <span class="score">0</span></div>
                    </div>
                    <div class="setting">
                        <div class="btns flex">
                            <button class="start_btn">게임시작</button>
                            <button class="reset_btn none">다시하기</button>
                            <button class="hint_btn">힌트보기</button>
                        </div>
                    </div>
                    <div class="stamp">
                        <h4>Stamp</h4>
                        <div class="item-container flex">
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
            <div class="left_box box flex">
                <h3>PREV</h3>
            </div>
            <div class="right_box box flex">
                <h3>NEXT</h3>
            </div>
        </main>
        <div class="modal flex none">
            <div>
                <form name="gameForm" class="flex">
                    <input type="hidden" name="score">
                    <p>이름</p> 
                    <input type="text" name="name" placeholder="이름을 입력해주세요">
                    <p>전화번호</p> 
                    <input type="text" name="tel" placeholder="전화번호를 입력해주세요">
                    <input type="submit" value="등록">
                </form>
            </div>
        </div>
        <footer>
            <p>Copyright (C) Gyeongsangbuk-do.All Rights Reserved.</p>
        </footer>
        <div class="popup flex">
            <div class="menu">
                <ul>사용자 페이지
                    <li><a href="/">메인페이지</a></li>
                    <li><a href="/sub1">특산품 안내</a></li>
                    <li class="high"><a href="/sub2">이벤트</a></li>
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
    <script src="./js/script.js"></script>