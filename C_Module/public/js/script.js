const $ = ($e,$d=document) => $d.querySelector($e);
const $All = ($e,$d=document) => [...$d.querySelectorAll($e)];
const $add = ($e,$func,$handle="click") => $e.addEventListener($handle, $func);
const $addAll = ($es,$func,$handle="click") =>  $es.forEach( $e => $add($e,$func,$handle) );
const addClass = ($e,$n) => $e?.classList.add($n);
const removeClass = ($e,$n) => $e?.classList.remove($n);
const findClass = ($e,$n) => $e?.classList.contains($n);
const oo = (a) => a.sort(() => Math.random() - 0.5);

const data = [
    { area: "창원시", imgName: "창원시_풋고추.jpg" },
    { area: "진주시", imgName: "진주시_고추.jpg" },
    { area: "통영시", imgName: "통영시_굴.jpg" },
    { area: "사천시", imgName: "사천시_멸치.jpg" },
    { area: "김해시", imgName: "김해시_단감.jpg" },
    { area: "밀양시", imgName: "밀양시_대추.jpg" },
    { area: "거제시", imgName: "거제시_유자.jpg" },
    { area: "양산시", imgName: "양산시_매실.jpg" },
    { area: "의령군", imgName: "의령군_수박.jpg" },
    { area: "함안군", imgName: "함안군_곶감.jpg" },
    { area: "창녕군", imgName: "창녕군_양파.jpg" },
    { area: "고성군", imgName: "고성군_방울토마토.jpg" },
    { area: "남해군", imgName: "남해군_마늘.jpg" },
    { area: "하동군", imgName: "하동군_녹차.jpg" },
    { area: "산청군", imgName: "산청군_약초.jpg" },
    { area: "함양군", imgName: "함양군_밤.jpg" },
    { area: "거창군", imgName: "거창군_사과.jpg" },
    { area: "합천군", imgName: "합천군_돼지고기.jpg" }
]

{
    const page = document.body.id;
    page === "review" ? reviewPage() :
    page === "event" ? eventPage() :
    ""
}

function eventPage() {
    const $startBtn = $(".start_btn");
    const $restartBtn = $(".restart_btn");
    const $hintBtn = $(".hint_btn");
    const $score = $(".display .score");
    const $eventModal = $(".event_modal");
    const $form = $("form", $eventModal);
    let gameplay = false;
    let cardChoise = false;

    let setTimer = null;
    let setCardTimer = null;
    let selectCard = null;

    function cardHandle() {
        if(findClass(this, "active") || !cardChoise ) return;
        addClass(this, "active");
        const before = selectCard?.dataset?.area;
        const after = this?.dataset?.area;
        if(selectCard === null) {
            selectCard = this;
            setCardTimer = setTimeout(() => {
                if(selectCard !== null && findClass(selectCard, "success")) return;
                removeClass(selectCard);
            }, 3000)
        } else {
            if(before === after) {
                addClass(selectCard, "success")
                addClass(this, "success")
                selectCard = null;
                clearTimeout(setCardTimer);
                $score.innerText = parseInt($score.textContent) +1;
                $form.score.value = $score.textContent;
                if($score.textContent >= 8) gameEnd();
            } else {
                cardChoise = false;
                setCardTimer = setTimeout(() => {
                    removeClass(selectCard, "active");
                    removeClass(this, "active");
                    selectCard = null;
                    cardChoise = true;
                }, 1000)
            }
        }
    }

    const gameEnd = function() {
        clearInterval(setTimer);
        clearTimeout(setCardTimer);
        $All(".card").forEach( ele => {
            addClass(ele, "active");
            if(findClass(ele, "success")) {
                ele.children[0].style.border = "4px solid green";
            } else {
                ele.children[0].style.border = "4px solid red";
            }
        } )
        removeClass($eventModal, "none");
    }
    
    const cardSetting = function() {
        const cards = oo(data).slice(0, 8);
        const cardArr = oo([...cards, ...cards]);
        $All(".card").forEach( (ele, idx) => {
            ele.dataset.area = cardArr[idx].area;
            ele.children[0].innerHTML = `
                <img src="./(웹디자인)선수제공파일/특산품/${cardArr[idx].imgName}">
                <h4>${cardArr[idx].area}</h4>
            `;
        } )
    };

    const timer = function(min, sec, end) {
        return new Promise( res => {
            $(".display .time .min").innerText = min;
            $(".display .time .sec").innerText = sec;
            setTimer = setInterval(() => {
                let newMin =  $(".display .time .min").textContent;
                let newSec =  $(".display .time .sec").textContent;

                newSec--;
                if(newMin <= 0 && newSec <= 0) {
                    clearInterval(setTimer);
                    if(end) gameEnd()
                    res();
                } else {
                    if(newSec < 0) {
                        newMin--;
                        newSec = 59;
                    }
                    $(".display .time .min").innerText = newMin;
                    $(".display .time .sec").innerText = newSec;
                }
            }, 1000);
        } )
    };

    const hintHandle = function(s) {
        if( !gameplay ) return
        cardChoise = false;
        gameplay = false;
        selectCard = null;
        $All(".card").forEach( ele => addClass(ele, "active") );
        setTimeout(() => {
            $All(".card").forEach( ele => removeClass(ele, "active") );
            cardChoise = true;
            gameplay = true;
        }, s*1000)
    }

    const gameStart = async function() {
        if( findClass($startBtn,"start") ) return;
        gameplay = true;
        addClass($startBtn,"start");
        cardSetting();
        hintHandle(5);
        await timer(0, 5, false);
        
        addClass($startBtn, "none");
        removeClass($restartBtn, "none");
        $addAll($All(".card"), cardHandle);
        cardChoise = true;
        timer(1, 30, true);
    }

    const reset = function() {
        clearInterval(setTimer);
        clearTimeout(setCardTimer);
        removeClass($startBtn,"start");
        $form.reset();
        gameplay = false;
        cardChoise = false;
        selectCard = null;
        $score.innerText = 0;
        $All(".card").forEach( ele => {
            ele.className = "card";
            ele.children[0].removeAttribute("style");
        } );
        $(".display .time .min").innerText = 0;
        $(".display .time .sec").innerText = 0;
        $form.reset();
        addClass($restartBtn, "none");
        removeClass($startBtn, "none");
    }

    const restartHandle = function() {
        if( !gameplay ) return;
        reset();
        gameStart();
    }

    const _formSubmit = async function(e) {
        e.preventDefault();

        try{
            if(this.name.value.length < 2 || this.name.value.length > 50)
                throw "이름은 2글자 이상 50글자 이내여야 합니다.";
            if(!/[a-zA-Zㄱ-ㅎ가-힣]/g.test(this.name.value))
                throw "이름은 한글 혹은 영어만 입력 가능합니다.";
            if(this.tel.value.length < 13)
                throw "전화번호를 입력해 주세요";
        } catch(e) {
            alert(e);
            return;
        }

        const stamp = $(".stamp_container");

        const filedate = new FormData(this);
        const eventApi = await fetch("/api/event/applicants", {
            method: "POST",
            body: filedate
        }).then( res => res.json() );

        alert(eventApi.message);

        const stampApi = await fetch(`/api/event/${this.tel.value}/stamps`).then( res => res.json() );

        if(stampApi.message) {
            alert(stampApi.message);
        } else {
            if(stampApi.stamps.length >= 3) {
                stamp.innerHTML = `<h3>축하합니다. 3일연속 출석하여 경품선정 대상자가 되었습니다.</h3>`;
            } else {
                stampApi.stamps.forEach( (ele,idx) => {
                    addClass(stamp.children[idx], "check");
                    stamp.children[idx].children[0].innerText = ele;
                } )
            }
        }
        addClass($eventModal, "none");
        reset();
    }

    const _telChage = function() {
        this.value = this.value
        .replace(/[^0-9]/g, "")
        .replace(/^(\d{0,3})(\d{0,4})(\d{0,4})$/g, "$1-$2-$3")
        .replace(/\-{1,2}$/g, "");
    }

    $add($startBtn,gameStart);
    $add($hintBtn,() => hintHandle(3));
    $add($restartBtn,restartHandle);
    $add($form,_formSubmit,"submit");
    $add($("input[name='tel']", $eventModal),_telChage,"input");
}

function reviewPage() {
    const $reviewModal = $(".review_modal");
    const $opneBtn = $("header .open_btn");
    const $closeBtn = $(".close", $reviewModal);
    const $form = $("form", $reviewModal);
    const $socreBox = $(".score_container", $reviewModal);
    const $addPhotoBtn = $(".add_photo", $reviewModal);

    const dataArr = [];


    const toggleModal = function() {
        $reviewModal.classList.toggle("none");
    };

    const returnSrc = (img) => {
        return new Promise( res => {
            const reader = new FileReader();
            reader.readAsDataURL(img);
            reader.onload = () => { res(reader.result) };
        } )
    }

    const render = async function() {
        
    }

    const _formSubmit = async function(e) {
        e.preventDefault();
        const photos = $All("input[name='photo']", $reviewModal);

        try {
            if(this.name.value.length < 2 || this.name.value.length > 50)
                throw "이름은 2글자 이상 50글자 이내여야 합니다.";
            if(!/[a-zA-Zㄱ-ㅎ가-힣]/g.test(this.name.value))
                throw "이름은 한글 혹은 영어로만 이루어 있어야 합니다.";
            if(this.product.value.length < 1)
                throw "구매품을 입력하세요";
            if(this.shop.value.length < 1)
                throw "구매처을 입력하세요";
            if(this.date.value.length < 1)
                throw "구매일을 입력하세요";
            if(this.content.value.length < 100)
                throw "내용을 100글자 이상 입력해 주세요";
            if(this.score.value < 1)
                throw "별점을 입력해주세요";
            if(!photos.length || !photos.some( ele => ele.value ))
                throw "사진을 1장 이상 넣어주세요";
        } catch(e) {
            alert(e);
            return
        }

        const photoArr = [];

        for(const $p of photos) {
            if(!$p.files[0]) continue;
            const src = await returnSrc($p.files[0]);

            const imgTag = document.createElement("img");
            imgTag.src = src;

            const canvas = document.createElement("canvas");
            const ctx = canvas.getContext('2d');

            canvas.width = "500";
            canvas.height = "500";
            ctx.drawImage(imgTag, 0, 0, 500, 500);
            ctx.font = "bold 3em";
            ctx.textAlign = "center";
            ctx.fillStyle = "rgba(0, 0, 0, .5)"
            ctx.fillText("경상남도 특산품", canvas.width/2, canvas.height/2);

            const url = canvas.toDataURL("image/jpeg");
            photoArr.push({url, name: $p.files[0].name});
        }

        const dataform = new FormData(this);
        dataform.append("photoArr", JSON.stringify(photoArr));

        const reviewApi = await fetch("/api/reviews", {
            method: "POST",
            body: dataform
        }).then( res => res.json() );

        alert(reviewApi.message);
        toggleModal();
        render();
    }

    const _scoreInfo = function(e) {
        const $x = e.layerX/40 < 0 ? 0 : e.layerX/40;
        let score = 0;


        [...this.children].forEach( (ele,idx) => {
            ele.className = "fa fa-star-o";
            if(idx <= Math.floor($x)) {
                ele.className = "fa fa-star";
                score += 2;
            }
        } )

        if($x%1 <= 0.5) {
            this.children[Math.floor($x)].className = "fa fa-star-half-o";
            score -= 1;
        }

        $form.score.value = score;
    };

    const addPhoto = function() {
        const input = document.createElement("input");
        input.type = "file";
        input.name = "photo";
        $(".photo_box", $reviewModal).appendChild(input);
    }

    $add($opneBtn, toggleModal);
    $add($closeBtn, toggleModal);
    $add($form, _formSubmit, "submit");
    $add($addPhotoBtn, addPhoto);
    $add($socreBox, _scoreInfo, "mousemove");

}