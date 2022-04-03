
<body id="review">
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
                            <li class="high"><a href="/admin_event">이벤트 관리</a></li>
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
        <section class="admin_event">
            <form class="serch">
                <input type="date" name="date">
                <input type="submit" value="검색">
            </form>
            <table>
                <thead>
                    <tr>
                        <th>이름</th>
                        <th>휴대폰번호</th>
                        <th>점수(찾은 카드 수)</th>
                        <th>참여일</th>
                        <th>연속출석일수</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($list as $item): ?>
                        <tr>
                            <td><?=$item->name ?></td>
                            <td><?=$item->tel ?></td>
                            <td><?=$item->score ?></td>
                            <td><?=$item->date ?></td>
                            <td><?=$item->conDate ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
        <!-- 푸터 영역 -->
        <footer>
            <p>Copyright (C) Gyeongsangbuk-do. All Rights Reserved.</p>
        </footer>
    <script>
        const form = document.querySelector(".admin_event form");

        const _formSubmit = function(e) {
            e.preventDefault();
            const trs = document.querySelectorAll(".admin_event tbody tr");
            
            trs.forEach( ele => {
                ele.className = "";
                if(ele.children[3].innerText != this.date.value){
                    ele.classList.add("none");
                }
                if(ele.children[4].innerText >= 3) {
                    ele.classList.add("high");
                }
            } )
        };

        form.addEventListener("submit", _formSubmit);
    </script>
</body>