const $ = ($e,$d=document) => $d.querySelector($e);
const $All = ($e,$d=document) => [...$d.querySelectorAll($e)];
const $add = ($e,$func,$handle="click") => $e.addEventListener($handle, $func);
const $addAll = ($es,$func,$handle="click") => $es.forEach( $e => $add($e,$func,$handle) );
const addClass = ($e,$n) => $e?.classList.add($n);
const removeClass = ($e,$n) => $e?.classList.remove($n);
const findClass = ($e,$n) => $e?.classList.contains($n);
const oo = (arr) => arr.sort( () => Math.random() - 0.5 );

const dataArr = [
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

function reviewPage() {
    const $reviewModal = $(".review_modal");
    const $form = $("form", $reviewModal);
    const $openBtn = $(".add_review");
    const $closeBtn = $(".close", $reviewModal);
    const $scoreContainer = $(".score_container", $reviewModal);
    const $addPhotoBtn = $(".add_photo", $reviewModal);

    const $reviewDetailModal = $(".review_detail_modal");
    const $detailform = $("form", $reviewDetailModal);
    const $detailCloseBtn = $(".close", $detailform);
    const $prevBtn = $(".prev", $detailform);
    const $nextBtn = $(".next", $detailform);

    const _toggleModal = function() {
        $reviewModal.classList.toggle("none");
        $form.reset();
    };
    
    const _toggleDetailModal = function() {
        $reviewDetailModal.classList.toggle("none");
    };

    const _scoreChange = function({layerX}) {
        const $x = layerX/40 < 0 ? 0 : layerX/40;
        let score = 0;

        [...this.children].forEach( (ele, idx) => {
            ele.className = "fa fa-star-o";
            if(idx <= Math.floor($x)) {
                ele.className = "fa fa-star";
                score += 2;
            }
        } )
        
        if(layerX/40 <= 0) {
            this.children[Math.floor($x)].className = "fa fa-star-o";
            score -= 2;
        } else if($x%1 < 0.5) {
            this.children[Math.floor($x)].className = "fa fa-star-half-o";
            score-=1;
        }
        $form.score.value = score;
    };

    const _insertPhotoBtn = function() {
        const input = document.createElement("input");
        input.type = "file";
        input.name = "photo";
        input.accept = ".jpg";
        $(".photo_box", $reviewModal).appendChild(input);
        $add(input, _photoChange, "change");
    };

    let fVisit = true;
    const render = async function() {
        const $review = $All(".review-container .item");
        const maxKey = Math.max(...[...$review].map( e => e.dataset.key )) <= -1 ? 0 : Math.max(...[...$review].map( e => e.dataset.key ));
        const key = $review.length || !fVisit ? maxKey+1 : lastKey;
        fVisit = false;

        const reviewListApi = await fetch(`/api/reviews?last-key=${key}`).then( e => e.json() );
        
        if(reviewListApi.message) {
            alert(reviewListApi.message);
        } else {
            const $reviewContainer = $(".review-container");
            $reviewContainer.innerHTML = ``;
            reviewListApi.reviews.forEach( (ele, idx) => {
                const item = document.createElement("div");
                addClass(item, "item");
                item.dataset.key = ele.key
                const scoreArr = Array.from( Array(5), (_,idx) => {
                    if(idx < Math.floor(ele.score/2)) return "<i class='fa fa-star'></i>";
                    else if(ele.score%2 && idx == Math.floor(ele.score/2)) return "<i class='fa fa-star-half-o'></i>"
                    else return "<i class='fa fa-star-o'></i>";
                } );
                item.innerHTML = `
                <h3 class="name">${ele.name}</h3>
                <span class="date">${ele["purchase-date"]}</span>
                <div class="photo">
                    <img src="./reviewImg/${ele.photo}" alt="itemImg" title="itemImg">
                </div>
                <div class="score-container">
                    ${scoreArr.map(e => e).join("")}
                </div>
                <p>구매처: ${ele.shop}</p>
                <p>구매품: ${ele.product}</p>
                <p>내용 : ${ele.contents}</p>
                `;
                $reviewContainer.appendChild(item);
                $add(item, _itemHandel);
            } )
        }
    }
    render();

    const detailRender = async function(key) {
        $All(".sub img").forEach( ele => ele.remove() );
        const reviewDetailApi = await fetch(`/api/review/${key}`).then( res => res.json() );
        if(reviewDetailApi.message) {
            alert(reviewDetailApi);
        } else {
            $detailform.key.value = key;
            $(".name h4", $detailform).innerText = reviewDetailApi.name;
            $(".product h4", $detailform).innerText = reviewDetailApi.product;
            $(".shop h4", $detailform).innerText = reviewDetailApi.shop;
            $(".date h4", $detailform).innerText = reviewDetailApi["purchase-date"];
            $(".score h4", $detailform).innerText = reviewDetailApi.score;
            $(".contents p", $detailform).innerText = reviewDetailApi.contents;
            reviewDetailApi.photos.forEach( (ele, idx) => {
                const img = document.createElement("img");
                img.src = `./reviewImg/${ele.file}`;
                if(idx == 0) {
                    $(".main img", $detailform).src = `./reviewImg/${ele.file}`;
                    addClass(img, "none");
                };
                $(".sub", $reviewDetailModal).appendChild(img);
                $add(img, _imgHandle);
            } )
        }
    }

    const _itemHandel = function() {
        const key = this.dataset.key;
        _toggleDetailModal();
        detailRender(key);
    }

    const _imgHandle = function() {
        $All(".sub img").forEach( (ele) => {
            removeClass(ele, "none");
            if(ele.src == this.src) addClass(ele, "none");
            $(".main img", $detailform).src = this.src;
        } )
    }

    const _formSubmit = async function(e) {
        e.preventDefault();

        const photos = $All("input[name='photo']", $reviewModal);

        try {
            if(this.name.value.length < 2 || this.name.value.length > 50)
                throw "이름은 2글자 이상 50글자 이내여야 합니다.";
            if(!/[a-zA-Zㄱ-ㅎ가-힣ㅏ-ㅣ]/.test(this.name.value))
                throw "이름은 한글 또는 영문만 입력 가능합니다.";
            if(this.product.value.length < 1)
                throw "구매품을 입력해 주세요.";
            if(this.shop.value.length < 1)
                throw "구매처을 입력해 주세요.";
            if(this.date.value.length < 1)
                throw "구매일을 입력해 주세요.";
            if(this.contents.value.length < 100)
                throw "내용을 100글자 이상 입력해주세요.";
            if(!photos.length || !photos.some( e => e.value ))
                throw "사진을 1장 이상 넣어주세요";
        } catch(e) {
            alert(e);
            return;
        }

        const returnSrc = (img) => {
            return new Promise( res => {
                const reader = new FileReader();
                reader.readAsDataURL(img);
                reader.onload = () => { res(reader.result) };
            } )
        };

        const returnImg = (src) => {
            return new Promise( res => {
                const img = document.createElement("img");
                img.style.width = 500;
                img.style.height = 500;
                img.src = src;
                img.onload = () => { res(img) };
            } )
        }

        const photoArr = [];

        const fdata = new FormData(this);

        for(const $p of photos) {
            if( !$p.files[0] ) continue;
            const src = await returnSrc($p.files[0]);
            const img = await returnImg(src);

            const canvas = document.createElement("canvas");
            const ctx = canvas.getContext("2d");
            canvas.width = 500;
            canvas.height = 500;
            ctx.drawImage(img, 0, 0, 500, 500);

            ctx.font = "50px bold 나눔";
            ctx.textAlign = "center";
            ctx.fillStyle = "rgba(255, 255, 255, .5)";
            ctx.textBaseline = "middle";
            ctx.fillText("경상남도 특산품", canvas.width/2, canvas.height/2);

            photoArr.push({ name: $p.files[0].name, img: canvas.toDataURL() });
        };

        fdata.append("photoArr", JSON.stringify(photoArr));
        fdata.append("purchase-date", this.date.value);

        const reviewApi = await fetch("/api/reviews", {
            method: "POST",
            body: fdata
        }).then( res => res.json() );

        alert(reviewApi.message);
        render();
        _toggleModal();
        photos.forEach( ele => ele.remove() );
        [...$scoreContainer.children].forEach( ele => ele.className = "fa fa-star-o" );
    };

    const _photoChange = function(e) {
        if ( this.value.substr(-3) !== 'jpg' ){
            this.value = '';
            alert("JPG 만 가능합니다 시키야");
        }
    };

    const _moveReview = function($name) {
        const $review = $All(".review-container .item");
        $review.forEach( (ele, idx) => {
            if(ele.dataset.key === $detailform.key.value) {
                let key = idx;
                if($name === "next") key++;
                else key--;
                if($review[key]) {
                    detailRender($review[key].dataset.key);
                } else {
                    alert("구매후기가 존재하지 않습니다.");
                }
                return;
            }
        } )
    };


    $add($openBtn, _toggleModal);
    $add($closeBtn, _toggleModal);
    $add($scoreContainer, _scoreChange, "mousemove");
    $add($addPhotoBtn, _insertPhotoBtn);
    $add($form, _formSubmit, "submit");
    $add($detailCloseBtn, _toggleDetailModal);
    $add($nextBtn, ()=>{_moveReview("next")});
    $add($prevBtn, ()=>{_moveReview("prev")});
};

function eventPage() {
    const $startBtn = $(".btns .start_btn");
    const $reStartBtn = $(".btns .restart_btn");
    const $hintBtn = $(".btns .hint_btn");
    const $evenModal = $(".event_modal");
    const $form = $("form", $evenModal);
    const $cards = $All(".card");
    const $time = $(".display .time");
    const $score = $(".display .score");
    const $stamp = $(".stamp-container").children[0];

    let setTimer = null;
    let setCardTimer = null;
    let focusCard = null;

    let gamePlay = false;
    let cardChoise = false;

    const toggleModal = function() {
        $evenModal.classList.toggle("none");
    };

    const cardSetting = function() {
        const card = oo(dataArr).slice(0, 8);
        const cardList = oo([...card, ...card]);
        $cards.forEach( (ele, idx) => {
            ele.dataset.area = cardList[idx].area;
            ele.children[0].innerHTML = `
            <div class="item front flex">
            <img src="./(웹디자인)선수제공파일/특산품/${cardList[idx].imgName}" alt="">
                <div class="text flex">
                    <h4>${cardList[idx].area}</h4>
                </div>
            </div>
            `;
            $add(ele, _cardHandle);
        } )
    };

    const gameEnd = function() {
        toggleModal();
        clearInterval(setTimer);
        clearTimeout(setCardTimer);

        $cards.forEach( ele => {
            addClass(ele, "active");
            addClass(ele, "end");
        } );
    }

    const timer = function(min, sec, end) {
        return new Promise( res => {
            $(".min", $time).innerText = min;
            $(".sec", $time).innerText = sec;
            setTimer = setInterval( () => {
                let newMin = $(".min", $time).textContent; 
                let newSec = $(".sec", $time).textContent; 

                newSec--;
                if(newMin <= 0 && newSec <= 0) {
                    clearInterval(setTimer);
                    if(end) gameEnd();
                    setTimeout(() => {res()},1000 )
                } else {
                    if(newSec < 0) {
                        newMin--;
                        newSec = 59;
                    }
                }

                $(".min", $time).innerText = newMin;
                $(".sec", $time).innerText = newSec;
            }, 1000 )
        } )
    };

    const _cardHandle = function() {
        if( findClass(this, "active") || !cardChoise ) return;
        addClass(this, "active");

        const before = focusCard?.dataset?.area;
        const after = this?.dataset?.area;

        if(focusCard === null) {
            focusCard = this;
            setCardTimer = setTimeout( () => {
                removeClass(focusCard, "active");
                removeClass(this, "active");
                focusCard = null;
            }, 3000 )
        } else {
            if(before === after) {
                addClass(focusCard, "success");
                addClass(this, "success");
                focusCard = null;
                clearTimeout(setCardTimer);
                $score.innerText = parseInt($score.textContent)+1;
                $form.score.value = $score.textContent;
                if(parseInt($score.textContent) >= 8) gameEnd();
            } else {
                cardChoise = false;
                gamePlay = false;
                clearTimeout(setCardTimer);
                addClass(focusCard, "active")
                addClass(this, "active")
                setCardTimer = setTimeout( () => {
                    removeClass(focusCard, "active")
                    removeClass(this, "active")
                    cardChoise = true;
                    gamePlay = true;
                    focusCard = null;
                }, 700 )
            }
        }
    };

    const _gameStart = async function() {
        if( findClass($startBtn, "start") ) return;
        addClass($startBtn, "start")
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
        focusCard = null;
        gamePlay = false;
        cardChoise = false;
        $(".min", $time).innerText = 0;
        $(".sec", $time).innerText = 0;
        $score.innerText = 0;
        $cards.forEach( ele => ele.className = "card" );
        $startBtn.className = "start_btn";
        addClass($reStartBtn, "none");
        $form.reset();
    };

    const _gameReStart = function() {
        reset();
        _gameStart();
    };

    const _gameHint = function(sec) {
        if( !gamePlay ) return;
        gamePlay = false;
        cardChoise = false;
        focusCard = null;
        $cards.forEach( ele => addClass(ele, "active") );
        clearTimeout(setCardTimer);
        setCardTimer = setTimeout( () => {
            $cards.forEach( ele => removeClass(ele, "active") );
            cardChoise = true;
            gamePlay = true;
        }, sec*1000 )
    };

    const _formSubmit = async function(e) {
        e.preventDefault();
        try {
            if(this.name.value.length < 2 || this.name.value.length > 50)
                throw "이름은 2글자 이상 50글자 이내로 입력해야 합니다.";
            if(!/[a-zA-Zㄱ-ㅎ가-힣ㅏ-ㅣ]/g.test(this.name.value))
                throw "이름은 한글 또는 영문으로 입력해야 합니다.";
            if(this.tel.value.length < 13)
                throw "전화번호를 끝까지 입력해주세요.";
        } catch(e) {
            alert(e);
            return;
        }

        const fData = new FormData(this);
        const eventApi = await fetch("/api/event/applicants",{
            method: "POST",
            body: fData
        }).then( res => res.json() );

        alert(eventApi.message);
         
        const stampApi = await fetch(`/api/event/${this.tel.value}/stamps`).then( res => res.json() );

        if(stampApi.message) {
            alert(stampApi.message);
        } else {
            if(stampApi.stamps.length >= 3) {
                $(".stamp-container").innerHTML = `
                    <h4>축하합니다. 3일 연속 출석하여 경품선정 대상자가 되었습니다.</h4>
                `;
            } else {
                stampApi.stamps.forEach( (ele, idx) => {
                    addClass($(".stamp-container").children[idx], "check");
                    $(".stamp-container").children[idx].children[0].innerText = ele;
                } )
            }
        }

        toggleModal();
        reset();
    };

    const _telChange = function() {
        this.value = this.value
        .replace(/[^0-9]/g, "")
        .replace(/^(\d{0,3})(\d{0,4})(\d{0,4})$/g, "$1-$2-$3")
        .replace(/\-{1,2}$/g, "");
    };

    $add($startBtn, _gameStart);
    $add($reStartBtn, _gameReStart);
    $add($hintBtn, () => {_gameHint(3)});
    $add($form, _formSubmit, "submit")
    $add($form.tel, _telChange, "input")

};





