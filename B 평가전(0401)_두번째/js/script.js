// 기본으로 쓸 함수들
const $ = ($e, $d=document) => $d.querySelector($e);
const $All = ($e, $d=document) => [...$d.querySelectorAll($e)];
const $add = ($e, $func, $handle="click") => $e.addEventListener($handle,$func);
const $addAll = ($es, $func, $handle="click") => $es.forEach( $e => $add($e,$func,$handle) );
const addClass = ($e, $n) => $e?.classList.add($n);
const removeClass = ($e, $n) => $e?.classList.remove($n);
const findClass = ($e, $n) => $e?.classList.contains($n);
const oo = (arr) => arr.sort( () => Math.random() - 0.5 );

// 게임 데이터
const gameData = [
    {area: "창원시", imgName: "창원시_풋고추.jpg"},
    {area: "진주시", imgName: "진주시_고추.jpg"},
    {area: "통영시", imgName: "통영시_굴.jpg"},
    {area: "사천시", imgName: "사천시_멸치.jpg"},
    {area: "김해시", imgName: "김해시_단감.jpg"},
    {area: "밀양시", imgName: "밀양시_대추.jpg"},
    {area: "거제시", imgName: "거제시_유자.jpg"},
    {area: "양산시", imgName: "양산시_매실.jpg"},
    {area: "의령군", imgName: "의령군_수박.jpg"},
    {area: "함안군", imgName: "함안군_곶감.jpg"},
    {area: "창녕군", imgName: "창녕군_양파.jpg"},
    {area: "고성군", imgName: "고성군_방울토마토.jpg"},
    {area: "남해군", imgName: "남해군_마늘.jpg"},
    {area: "하동군", imgName: "하동군_녹차.jpg"},
    {area: "산청군", imgName: "산청군_약초.jpg"},
    {area: "함양군", imgName: "함양군_밤.jpg"},
    {area: "거창군", imgName: "거창군_사과.jpg"},
    {area: "합천군", imgName: "합천군_돼지고기.jpg"}
];

const page = document.body.id;
{
    page === "review" ? reviewPage() :
    page === "event" ? eventPage() :
    ""
}

// 리뷰 페이지
function reviewPage() {
    // 변수
    const $reviewModal = $(".review_modal");
    const $form = $("form", $reviewModal);
    const $openBtn = $(".add_review");
    const $closeBtn = $(".close", $reviewModal);
    const $addPhotoBtn = $(".add_photo", $reviewModal);
    const $scoreContainer = $(".score_container", $reviewModal);
    const dataArr = [];

    // 함수
    const _toggleModal = function() {
        $reviewModal.classList.toggle("none");
        $form.reset();
    };

    const _insertPhotoBtn = function() {
        const input = document.createElement("input");
        input.type = "file";
        input.name = "photo";
        input.accept = ".jpg";
        $(".photo_box", $reviewModal).appendChild(input);
    };

    const _scoreChange = function({layerX}) {
        const $x = layerX/40 < 0 ? 0 : layerX/40;
        let score = 0;

        [...this.children].forEach( (ele,idx) => {
            ele.className = "fa fa-star-o";
            if(idx <= Math.floor($x)) {
                ele.className = "fa fa-star";
                score+=2;
            }
        } )

        if($x == 0) {
            this.children[Math.floor($x)].className = "fa fa-star-o";
            score-=2;
        } else if($x%1 < 0.5) {
            this.children[Math.floor($x)].className = "fa fa-star-half-o";
            score-=1;
        } 

        $form.score.value = score;
    };

    const render = function() {
        const reviewContainer = $(".review-container");
        reviewContainer.innerHTML = ``;
        dataArr.forEach( ele => {
            const item = document.createElement("div");
            addClass(item, "item");
            const scoreArr = Array.from( Array(5), (_, idx) => {
                if(idx < Math.floor(ele.score/2)) return "<i class='fa fa-star'></i>"
                else if(ele.score%2 && idx == Math.floor(ele.score/2)) return "<i class='fa fa-star-half-o'></i>"
                else return "<i class='fa fa-star-o'></i>";
            } )
            item.innerHTML = `
            <h3 class="name">${ele.name}</h3>
            <span class="date">${ele.date}</span>
            <div class="photo">
                <img src="${ele.photo[0]}" alt="itemImg" title="itemImg">
            </div>
            <div class="score-container">
                ${scoreArr.map(e => e).join("")}
            </div>
            <p>구매처: ${ele.shop}</p>
            <p>구매품: ${ele.product}</p>
            <p>내용 : ${ele.content}</p>
            `;
            reviewContainer.appendChild(item);
        } )
    }

    const _formSubmit = async function(e) {
        e.preventDefault();

        const photos = $All("input[name='photo']", $reviewModal);

        try {
            if(this.name.value.length < 2 || this.name.value.length > 50)
                throw "이름은 2글자 이상 50글자 이내여야 합니다.";
            if(!/[a-zA-Zㄱ-ㅎ가-힣ㅏ-ㅣ]/g.test(this.name.value))
                throw "이름은 한글 또는 영문만 입력 가능합니다.";
            if(this.product.value.length < 1)
                throw "구매품을 입력해주세요.";
            if(this.shop.value.length < 1)
                throw "구매처을 입력해주세요.";
            if(this.date.value.length < 1)
                throw "구매일을 입력해주세요.";
            if(this.content.value.length < 100)
                throw "내용을 100글자 이상 입력해주세요.";
            if(!photos.length || !photos.some( e => e.value ))
                throw "사진을 1장 이상 넣어주세요.";
        } catch(e) {
            alert(e);
            return;
        }

        const returnSrc = (img) => {
            return new Promise( res =>{
                const reader = new FileReader();
                reader.readAsDataURL(img);
                reader.onload = () => { res(reader.result) };
            } )
        }

        const photoArr = [];

        for(const $p of photos){
            if( !$p.files[0] ) continue;
            photoArr.push( await returnSrc($p.files[0]) );
        }

        const obj = {
            name: this.name.value,
            product: this.product.value,
            shop: this.shop.value,
            date: this.date.value,
            content: this.content.value,
            score: this.score.value,
            photo: photoArr
        };

        dataArr.splice(0, 0, obj);
        alert("구매후기가 등록되었습니다.")
        render();
        _toggleModal();
        [...$scoreContainer.children].forEach( ele => ele.className = "fa fa-star-o" );
        photos.forEach( ele => ele.remove() );
    }

    // 이벤트 설정
    $add($openBtn, _toggleModal);
    $add($closeBtn, _toggleModal);
    $add($addPhotoBtn, _insertPhotoBtn);
    $add($scoreContainer, _scoreChange, "mousemove");
    $add($form, _formSubmit, "submit");
};

// 이벤트 페이지
function eventPage() {
    // 변수
    const $startBtn = $(".start_btn");
    const $reStartBtn = $(".restart_btn");
    const $hintBtn = $(".hint_btn");
    const $eventModal = $(".event_modal");
    const $form = $("form", $eventModal);
    const $cards = $All(".card");
    const $time = $(".display .time");
    const $score = $(".display .score");
    const $stamp = $(".stamp-container").children[0];

    let foucsCard = null;
    let setTimer = null;
    let setCardTimer = null;

    let gamePlay = false;
    let cardChoise = false;
    
    // 함수
    const toggleModal = function() {
        $eventModal.classList.toggle("none");
    };

    const cardSetting = function() {
        const card = oo(gameData).slice(0, 8);
        const cardList = oo([...card, ...card]);
        $cards.forEach( (ele, idx) => {
            ele.dataset.area = cardList[idx].area;
            ele.children[0].innerHTML = `
                <img src="./(웹디자인)선수제공파일/특산품/${cardList[idx].imgName}">
                <div class="text flex">
                    <h4>${cardList[idx].area}</h4>
                </div>
            `;
            $add(ele, _cardHanle);
        } )
    };

    const _cardHanle = function() {
        if( findClass(this, "active") || !cardChoise ) return;
        addClass(this, "active");
        const before = foucsCard?.dataset?.area;
        const after = this?.dataset?.area;

        if( foucsCard === null ) {
            foucsCard = this;
            setCardTimer = setTimeout( () => {
                removeClass(foucsCard, "active");
                removeClass(this, "active");
                foucsCard = null;
            }, 3000 )
        } else {
            if(before === after) {
                addClass(foucsCard, "success");
                addClass(this, "success");
                clearTimeout(setCardTimer);
                foucsCard = null;
                $score.innerText = parseInt($score.textContent) + 1;
                $form.score.value = parseInt($score.textContent);
                if(parseInt($score.textContent) >= 8) gameEnd();
            } else {
                clearTimeout(setCardTimer);
                cardChoise = false;
                setCardTimer = setTimeout( () => {
                    removeClass(foucsCard, "active");
                    removeClass(this, "active");
                    cardChoise = true;
                    foucsCard = null;
                }, 700 )
            }
        }
    }

    const gameEnd = function() {
        toggleModal();
        clearInterval(setTimer);
        clearTimeout(setCardTimer);
        $cards.forEach( ele => {
            addClass(ele, "end") 
            addClass(ele, "active"); 
        });
    };

    const timer = function(min, sec, end) {
        $(".min", $time).innerText = min;
        $(".sec", $time).innerText = sec;
        return new Promise( res => {
            setTimer = setInterval( () => {
                let newMin = $(".min", $time).textContent;
                let newSec = $(".sec", $time).textContent;
    
                newSec--;
    
                if(newMin <= 0 && newSec <= 0) {
                    clearInterval(setTimer);
                    if(end) gameEnd();
                    setTimeout( () => {res()}, 1000 );
                } else {
                    if(newSec <= 0) {
                        newMin--;
                        newSec = 59;
                    }
                }
                $(".min", $time).innerText = newMin;
                $(".sec", $time).innerText = newSec;
            }, 1000 )
        } )
    }

    const _gameStart = async function() {
        if( findClass($startBtn, "start") ) return;
        addClass($startBtn, "start");
        gamePlay = true;
        cardSetting();
        _gameHint(5);
        await timer(0, 5, false);

        timer(1, 30, true);

        addClass($startBtn, "none");
        removeClass($reStartBtn, "none");
    };

    const reset = function() {
        clearInterval(setTimer);
        clearTimeout(setCardTimer);
        foucsCard = null;
        
        gamePlay = false;
        cardChoise - false;
        $cards.forEach( ele => ele.className = "card" );
        $startBtn.className = "start_btn";
        $(".min", $time).innerText = 0;
        $(".sec", $time).innerText = 0;
        $score.innerText = 0;
        $form.reset();
        addClass($reStartBtn, "none");
    };

    const _gameReStart = function() {
        reset();
        _gameStart();
    };

    const _gameHint = function(sec) {
        if( !gamePlay ) return;
        gamePlay = false;
        cardChoise = false;
        foucsCard = null;
        $cards.forEach( ele => addClass(ele, "active") );
        clearTimeout(setCardTimer);
        setCardTimer = setTimeout( () => {
            $cards.forEach( ele => removeClass(ele, "active") );
            gamePlay = true;
            cardChoise = true;
        }, sec*1000 )

    };

    const _formSubmit = function(e) {
        e.preventDefault();

        try {
            if(this.name.value.length < 2 || this.name.value.length > 50)
                throw "이름은 2글자 이상 50글자 이내여야 합니다.";
            if(!/[a-zA-Zㄱ-ㅎ가-힣ㅏ-ㅣ]/g.test(this.name.value))
                throw "이름은 한글 또는 영문만 입력 가능합니다.";
            if(this.tel.value.length < 13)
                throw "전화번호를 끝까지 입력해 주세요";
        } catch(e) {
            alert(e);
            return;
        }

        alert("이벤트에 참여해 주셔서 감사합니다.");
        const date = new Date();
        addClass($stamp, "check");
        $stamp.children[0].innerText = `${date.getFullYear()}-${date.getMonth() + 1 < 10 ? "0"+(date.getMonth() + 1) : date.getMonth() + 1}-${date.getMonth() < 10 ? "0"+date.getMonth() : date.getMonth()}`;
        toggleModal();
        reset();
    };

    const _telChange = function() {
        this.value = this.value
        .replace(/[^0-9]/g, "")
        .replace(/^(\d{0,3})(\d{0,4})(\d{0,4})$/g, "$1-$2-$3")
        .replace(/\-{1,2}$/g, "");
    };

    // 이벤트 설정
    $add($startBtn, _gameStart);
    $add($reStartBtn, _gameReStart);
    $add($hintBtn, () => {_gameHint(3)});
    $add($form, _formSubmit, "submit");
    $add($form.tel, _telChange, "input");
};
