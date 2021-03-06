<div id="app" class="sub sub3">
        <input type="radio" id="menu_on" name="menu">
        <input type="radio" id="menu_off" name="menu" checked>
        <input type="radio" id="sns_on" name="sns">
        <input type="radio" id="sns_off" name="sns" checked>
        <header class="flex">
            <div class="logo flex">
                <img src="./img/slogan.png" alt="sloganImg" title="sloganImg">
                <div class="insert_btn">
                    <button class="review_add_btn">후기작성</button>
                </div>
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
        <main class="sub sub3 flex">
            <section class="review">
                <h3 class="title">고객이 작성하는 구매후기</h3>
                <div class="annou_img">
                    <!-- <img src="./img/review.png" alt="reviewImg" title="reviewImg"> -->
                    <fieldset class="annou">
                        <legend><span class="high">경상남도 특산품</span>의 소중한 <span class="high">구매 후기</span>를 찾습니다.</legend>
                        <p>경상남도 특산품을 <span class="high">사랑하는 고객님</span>의 소중한 경험을 <span class="high">공유</span>함으로써, 지역 특산품을 홍보하고 판매를 증진시켜, 경상남도 농가의 <span class="high">소득 증대</span>는 물론, <span class="high">품질이 좋은</span> 특산품을 보다 많은 고객분들과 공유하기 위해 구매 후기를 모집 합니다.</p>
                    </fieldset>
                </div>
                <div class="list">
                    <table>
                        <tr>
                            <th>사진</th>
                            <th>별점</th>
                            <th>이름(작성자)</th>
                            <th>구매품</th>
                            <th>구매처</th>
                            <th>구매일</th>
                            <th>글 내용</th>
                        </tr>
                       
                    </table>
                </div>
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
                    <li><a href="/">메인페이지</a></li>
                    <li><a href="/sub1">특산품 안내</a></li>
                    <li><a href="/sub2">이벤트</a></li>
                    <li class="high"><a href="/sub3">구매후기</a></li>
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
        <div class="modal flex none">
            <div>
                <form name="reviewForm" class="grid item-container">
                    <div class="close_btn">X</div>
                    <div class="name item">
                        <p>이름</p>
                        <input type="text" name="name" placeholder="이름을 입력해주세요">
                    </div>
                    <div class="product item">
                        <p>구매품</p>
                        <input type="text" name="product" placeholder="구매품을 입력해주세요">
                    </div>
                    <div class="shop item">
                        <p>구매처</p>
                        <input type="text" name="shop" placeholder="구매처를 입력해주세요">
                    </div>
                    <div class="date item">
                        <p>구매일</p>
                        <input type="date" name="date">
                    </div>
                    <div class="content item">
                        <p>내용</p>
                        <textarea name="content" placeholder="내용을 입력해주세요(100이상 입력해주세요)"></textarea>
                        <!-- <label>
                            내용
                            <textarea name="content" placeholder="내용을 입력해주세요(100이상 입력해주세요)"></textarea>
                        </label> -->
                    </div>
                    <div class="score item">
                        <p>별점</p>
                        <div class="score_box flex">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <input type="hidden" name="score">
                    </div>
                    <div class="photo item">
                        <p>사진</p>
                        <button class="add_photo_btn" type="button">사진추가</button>
                        <input type="file" class="none" name="photo" accept=".jpg" multiple>
                    </div>
                    <input type="submit" value="후기등록">
                </form>
            </div>
        </div>
    </div>
    <script src="./js/script.js"></script>