// 서브2 게임 & 모달
const cards = document.querySelectorAll("#app section.event .game .card");
const startBtn = document.querySelector("#app section.event .game .setting .start_btn");
const resetBtn = document.querySelector("#app section.event .game .setting .reset_btn");
const hintBtn = document.querySelector("#app section.event .game .setting .hint_btn");
const time = document.querySelector("#app section.event .game .display .time");
const score = document.querySelector("#app section.event .game .display .card_score .score");
const modal = document.querySelector("#app.sub2 .modal");
const stamp = document.querySelector("#app section.event .game .stamp .item-container");

const data = [
    {area: "창원시", imgName: "창원시_풋고추.jpg", active: false},
    {area: "진주시", imgName: "진주시_고추.jpg", active: false},
    {area: "통영시", imgName: "통영시_굴.jpg", active: false},
    {area: "사천시", imgName: "사천시_멸치.jpg", active: false},
    {area: "김해시", imgName: "김해시_단감.jpg", active: false},
    {area: "밀양시", imgName: "밀양시_대추.jpg", active: false},
    {area: "거제시", imgName: "거제시_유자.jpg", active: false},
    {area: "양산시", imgName: "양산시_매실.jpg", active: false},
    {area: "의령군", imgName: "의령군_수박.jpg", active: false},
    {area: "함안군", imgName: "함안군_곶감.jpg", active: false},
    {area: "창녕군", imgName: "창녕군_양파.jpg", active: false},
    {area: "고성군", imgName: "고성군_방울토마토.jpg", active: false},
    {area: "남해군", imgName: "남해군_마늘.jpg", active: false},
    {area: "하동군", imgName: "하동군_녹차.jpg", active: false},
    {area: "산청군", imgName: "산청군_약초.jpg", active: false},
    {area: "함양군", imgName: "함양군_밤.jpg", active: false},
    {area: "거창군", imgName: "거창군_사과.jpg", active: false},
    {area: "합천군", imgName: "합천군_돼지고기.jpg", active: false}
];

let cardArr = [];
let selectCard = null;
let setTimer = null;
let setCardChk = null;
let gamePaly = false;
let cardChoice = false;

const gameEnd = () => {
    clearInterval(setTimer);
    clearTimeout(setCardChk);
    gamePaly = false;
    cardChoice = false;
    cards.forEach( ele => {
        ele.children[0].style.transform = "rotateY(0deg)";
        ele.children[1].style.transform = "rotateY(180deg)";
        if(ele.classList.contains("action")) {
            ele.children[0].style.border = "4px solid green";
        } else {
            ele.children[0].style.border = "4px solid red";
        }
    } )
    document.forms[0].score.value = score.textContent;
    modal.classList.remove("none");
};

const delay = s => {
    return new Promise( (res) => {
        setTimeout(() => {
            res();
        }, s*1000)
    } )
};

const timer = (min, sec, gameFinish) => {
    time.children[0].innerText = min;
    time.children[1].innerText = sec;
    setTimer = setInterval(() => {
        let timeMin = time.children[0].innerText;
        let timeSec = time.children[1].innerText;
        timeSec--;

        if(timeMin <= 0 && timeSec <= 0) {
            if(gameFinish) {
                gameEnd();
            }
            clearInterval(setTimer);
        } else {
            if(timeSec <= 0) {
                timeMin--;
                timeSec = 59;
            }
        }
        
        time.children[0].innerText = timeMin;
        time.children[1].innerText = timeSec;
    }, 1000);
}

const cardClose = () => {
    return new Promise( (res) => {
        cards.forEach( ele => {
            ele.children[0].removeAttribute("style");
            ele.children[1].removeAttribute("style");
        } );

        setTimeout( () => {
            res();
        }, 1000 )
    } )
}

const cardOpen = (sec) => {
    return new Promise( (res) => {
        cardChoice = false;
        cards.forEach( (ele) => {
            ele.children[0].style.transform = "rotateY(0deg)";
            ele.children[1].style.transform = "rotateY(180deg)";
        } )
        setTimeout(() => {
            cards.forEach( (ele, idx) => {
                if(!cardArr[idx].active) {
                    ele.children[0].removeAttribute("style");
                    ele.children[1].removeAttribute("style");
                }
            } )
            cardChoice = true;
            res();
        }, sec*1000);
    } )
};


const cardSetting = function() {
    data.sort( () => Math.random() - 0.5 );

    for(let i = 1; i <= 2; i++){
        for(let j = 1; j <= 8; j++) {
            cardArr.push(data[j]);
        }
    }

    cardArr.sort( () => Math.random() - 0.5 );
    [...cards].forEach( (ele, idx) => {
        ele.children[0].innerHTML = `
            <img src="../(웹디자인)선수제공파일/특산품/${cardArr[idx].imgName}" alt="cardImg${idx}" title="cardImg${idx}">
            <h4 class="area none">${cardArr[idx].area}</h4>
        `;
        ele.dataset.area = cardArr[idx].area;
        ele.addEventListener("click", cardClickHandle);
    } );   
};

const gameSetting = function() {
    cardSetting();
    startBtn.classList.add("none");
    resetBtn.classList.remove("none");
};

const gameStart = async e => {
    gameSetting();
    timer(0, 5, false);
    await cardOpen(5);
    gamePaly = true;
    timer(1, 30, true);

    resetBtn.addEventListener("click", resetHandle);
    hintBtn.addEventListener("click", hintHandle);
};

const reset = () => {
    clearInterval(setTimer);
    clearTimeout(setCardChk);
    cards.forEach( ele => ele.className = "card" );
    selectCard = null;
    cardChoice = false;
    gamePaly = false;
    cardArr = [];
    data.forEach( ele => ele.active = false );

    time.innerHTML = `<span class="min">0</span>:<span class="sec">0</span>`;
    score.innerText = 0;
}

const resetHandle = async e => {
    await cardClose();
    reset();
    gameStart();
};

const hintHandle = async e => {
    if(gamePaly) {
        gamePaly = false;
        await cardOpen(3);
        gamePaly = true;
    }
};

const selectCardChk = () => {
    setCardChk = setTimeout(() => {
        if(selectCard !== null && gamePaly) {
            selectCard.children[0].removeAttribute("style");
            selectCard.children[1].removeAttribute("style");
        }
    }, 3000)
};

const cardClickHandle = async function() {
    if(cardChoice && gamePaly) {
        if(this.classList.contains("action")) return
        this.children[0].style.transform = "rotateY(0deg)";
        this.children[1].style.transform = "rotateY(180deg)";

        if(selectCard === null) {
            selectCard = this;
            selectCardChk();
        } else {
            const oldCard = selectCard;
            const nowCard = this;
            clearTimeout(setCardChk);
            selectCard = null;

            if(oldCard.dataset.area === nowCard.dataset.area) {
                [oldCard.children[0].children[1], nowCard.children[0].children[1]].forEach( ele => ele.classList.remove("none") );
                [oldCard, nowCard].forEach( ele => ele.classList.add("action") );

                cardArr.forEach( ele => { if(ele.area === oldCard.dataset.area) ele.active = true } );
                score.innerText = parseInt(score.textContent) + 1;
                if(score.innerText >= cards.length/2) {
                    gameEnd();
                }
            } else {
                cardChoice = false;
                await delay(1.5);
                cards.forEach( (ele, idx) => {
                    if(!cardArr[idx].active && gamePaly) {
                        ele.children[0].removeAttribute("style");
                        ele.children[1].removeAttribute("style");
                    }
                } )
                cardChoice = true;
            }
        }
    }
};


startBtn&&startBtn.addEventListener("click", gameStart);

const formSubmitHandle = async function(e) {
    e.preventDefault();

    const name = this.name.value;
    const tel = this.tel.value;

    if(name === "", tel === "") {
        alert("이름과 핸드폰번흐는 필수 값입니다.");
        return;
    }
    if(name < 2) {
        alert("이름은 2글자 이상이여야 합니다.");
        return;
    }
    if(name > 50) {
        alert("이름은 50글자 이내이여야 합니다.");
        return;
    }
    if(!/^[ㄱ-ㅎ가-힣a-zA-Z]+$/.test(name)) {
        alert('이름은 한글과 영어만 입력가능합니다.')
        return;
    }
    if(tel.length !== 13) {
        alert('핸드폰번호는 11자리 숫자만 입력가능합니다.');
        return;
    }

    modal.classList.add("none");
    reset();
    await cardClose();

    const formdata = new FormData(this);
    let statusCode = 0;

    const dbData = await fetch("/api/event/applicants", {
        method: "POST",
        body: formdata,
    }).then( res => { 
        statusCode = res.status;
        return res.json();
     } );
    
    alert(dbData.message);

    if(statusCode == 200) {
        const dbData2 = await fetch(`/api/event/${tel}/stamps`).then( res => res.json() );
        if(dbData2.stamps.length >= 3) {
            stamp.innerHTML = `
            <h3>축하합니다. 3일연속 출석하여 경품선정 대상자가 되었습니다.</h3>
            `;
        } else {
            dbData2.stamps.forEach( (ele, idx) => {
                stamp.children[idx].classList.add("check");
                stamp.children[idx].children[0].innerText = ele;
            } );

        }
    }

    this.reset();  
    startBtn.classList.remove("none");
    resetBtn.classList.add("none");
};

const keyDownHandle = function(e) {
    const input = this.value;

    if(this.value.length > 13){
        this.value = input.slice(0, 13);
        return;
    }

    this.value = input.replace(/[^0-9]/g, '')
    .replace(/^(\d{0,3})(\d{0,4})(\d{0,4})$/g, "$1-$2-$3")
    .replace(/(\-{1,2})$/g, "");
}

document.forms.gameForm&&document.forms.gameForm.addEventListener("submit", formSubmitHandle);
document.forms.gameForm&&document.forms.gameForm.tel.addEventListener("keydown", keyDownHandle);

// 서브3 후기작성
const reviewAddBtn = document.querySelector("#app.sub3 header .review_add_btn");
const modal2 = document.querySelector("#app.sub3 .modal");
const modal2CloseBtn = document.querySelector("#app.sub3 .modal .close_btn");
const scoreBox = document.querySelector("#app.sub3 .modal .score_box");
const addPhotoBtn = document.querySelector("#app.sub3 .modal .add_photo_btn");
const listArr = [];

const modal2ToggleFunc = () => {
    modal2.classList.toggle("none");
    document.forms.reviewForm&&document.forms.reviewForm.reset();
    [...document.querySelector("#app.sub3 .modal .score_box").children].forEach( ele => ele.className = "fa fa-star-o" );
    addPhotoBtn.classList.remove("none");
    document.querySelector("#app.sub3 .modal .photo input[name='photo']").classList.add("none");
};

const render = () => {
    document.querySelector("#app.sub3 section.review table tbody").innerHTML = `
        <tr>
            <th>사진</th>
            <th>별점</th>
            <th>이름(작성자)</th>
            <th>구매품</th>
            <th>구매처</th>
            <th>구매일</th>
            <th>글 내용</th>
        </tr>
        ${listArr.map( ele => {
            let scoreArr = [];
            for(let i=0; i<5; i++) {
                if(i < Math.floor(ele.score/2)) {
                    scoreArr.push("<i class='fa fa-star'></i>");
                } else {
                    scoreArr.push("<i class='fa fa-star-o'></i>");
                } 
            }
            if(ele.score%2 != 0) scoreArr.splice(Math.floor(ele.score/2), 1, "<i class='fa fa-star-half-o'></i>");
            return `
            <tr>
                <td>
                    <img src="${ele.photos[0] ? ele.photos[0] : './img/noimg.png'}">
                </td>
                <td>
                    ${scoreArr.map( ele => ele ).join("")}
                </td>
                <td>${ele.name}</td>
                <td>${ele.product}</td>
                <td>${ele.shop}</td>
                <td>${ele.date}</td>
                <td>${ele.content}</td>
            </tr>`
        } ).join("")}
    `;
}

const scoremouseMoveHandle = function(e) {
    const size = 40;
    const x = e.layerX;
    let score = 0;

    [...this.children].forEach( ele => ele.className = "fa fa-star-o" );
    for(let i=0; i<Math.floor(x/size); i++) {
        this.children[i].className = "fa fa-star";
    }
    score = Math.floor(x/size)*2;
    if((x/40)%1 >= 0.5) {
        this.children[Math.floor(x/size)].className = "fa fa-star";
        score+=2;
    } else {
        if(Math.floor(x/size) >= 0) {
            this.children[Math.floor(x/size)].className = "fa fa-star-half-o";
            score+=1;
        }
    }
    document.forms.reviewForm ? document.forms.reviewForm.score.value = score : 0;
};

const reviewFormSubmitHandle = async function(e) {
    e.preventDefault();
    if(this.name.value.length < 2){
        alert("이름은 2글자 이상이 입력해야 합니다.");
        return;
    }
    if(this.name.value.length > 50){
        alert("이름은 50글자 이내여야 합니다.");
        return;
    }
    if(!/^[ㄱ-ㅎ가-힣a-zA-Z]+$/.test(this.name.value)) {
        alert("이름은 한글과 영어만 입력이 가능합니다.");
        return;
    }
    if(this.shop.value < 1) {
        alert("구매처을 입력해주세요");
        return;
    }
    if(this.content.value.length <= 100) {
        alert("내용을 100글자 이상 입력해 주세요");
        return;
    }
    if(this.photo.files.length < 1) {
        alert("사진을 1장이상 입력해주세요");
        return;
    }
    if(this.product.value < 1) {
        alert("구매품을 입력해주세요");
        return;
    }
    if(this.date.value < 1) {
        alert("구매일을 입력해주세요");
        return;
    }
    if(this.score.value < 1) {
        alert("별점을 입력해주세요");
        return;
    }
    alert("구매 후기가 등록되었습니다.");

    const srcReturn = (img) => {
        return new Promise( (res) => {
            const reader = new FileReader();
            reader.readAsDataURL(img);
            reader.onload = () => { res(reader.result) };
        } )
    }
    const photoArr = [];
    for(let i = 0; i<this.photo.files.length; i++) {
        photoArr.push(await srcReturn(this.photo.files[i]));
    }
    const obj = {
        name: this.name.value,
        product: this.product.value,
        shop: this.shop.value,
        date: this.date.value,
        content: this.content.value,
        photos: photoArr,
        score: this.score.value
    }
    listArr.splice(0, 0, obj);
    render();
    modal2ToggleFunc();
};

const addPhotoBtnClickHandle = function() {
    this.classList.toggle("none");
    document.querySelector("#app.sub3 .modal .photo input[name='photo']").classList.toggle("none");
};

reviewAddBtn&&reviewAddBtn.addEventListener("click", modal2ToggleFunc);
modal2CloseBtn&&modal2CloseBtn.addEventListener("click", modal2ToggleFunc);
scoreBox&&scoreBox.addEventListener("mousemove", scoremouseMoveHandle);
document.forms.reviewForm&&document.forms.reviewForm.addEventListener("submit", reviewFormSubmitHandle);
addPhotoBtn&&addPhotoBtn.addEventListener("click", addPhotoBtnClickHandle);