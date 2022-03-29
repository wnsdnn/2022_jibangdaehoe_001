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
        <section class="admin">
            <h3 class="title">특산품 정보 수정</h3>
            <div class="specialty flex">
                <form method="post" class="item">
                    <input type="hidden" name="base64">
                    <input type="hidden" name="area" value="<?=$item->area ?>">
                    <img src="./(웹디자인)선수제공파일/특산품/<?=$item->imgName ?>" alt="">
                    <h3><?=$item->area ?></h3>
                    사진 변경 <input type="file" accept=".jpg" name="photo">
                    <input type="text" name="specialty" value="<?=$item->specialty ?>">
                    <input type="submit" value="수정">
                </form>
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
                        <li class="high"><a href="/admin_specialty">특산품 관리</a></li>
                        <li><a href="/admin_event">이벤트 관리</a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="event_modal flex none">
            <form method="post" class="flex">
                <input type="hidden" name="score">
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
</body>


<script>
    const form = document.querySelector(".specialty form");

    const imgChange = function() {
        const reader = new FileReader();
        reader.readAsDataURL(form.photo.files[0]);
        reader.onload = function() {
            form.querySelector("img").src = reader.result;
            form.base64.value = reader.result;
        };
        
    };

    form.photo.addEventListener("change", imgChange);
</script>