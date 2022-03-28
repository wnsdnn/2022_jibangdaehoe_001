const startBtn = document.querySelector(".container .btns .start");
const hintBtn = document.querySelector(".container .btns .hint");
const resetBtn = document.querySelector(".container .btns .reset");
const cards = document.querySelectorAll(".container .cards .card");
const time = document.querySelector(".container .time");
const serachCardNum = document.querySelector(".container .serach_card .card_num");

const dataArr = [
    { area: "창원시", "대표농특산품": "풋고추", imgName: "창원시_풋고추.jpg", active: false, code: "L001" },
    { area: "진주시", "대표농특산품": "고추", imgName: "진주시_고추.jpg", active: false, code: "L002" },
    { area: "통영시", "대표농특산품": "굴", imgName: "통영시_굴.jpg", active: false, code: "L003" },
    { area: "사천시", "대표농특산품": "멸치", imgName: "사천시_멸치.jpg", active: false, code: "L004" },
    { area: "김해시", "대표농특산품": "단감", imgName: "김해시_단감.jpg", active: false, code: "L005" },
    { area: "밀양시", "대표농특산품": "대추", imgName: "밀양시_대추.jpg", active: false, code: "L006" },
    { area: "거제시", "대표농특산품": "유자", imgName: "거제시_유자.jpg", active: false, code: "L007" },
    { area: "양산시", "대표농특산품": "매실", imgName: "양산시_매실.jpg", active: false, code: "L008" },
    { area: "의령군", "대표농특산품": "수박", imgName: "의령군_수박.jpg", active: false, code: "L009" },
    { area: "함안군", "대표농특산품": "곶감", imgName: "함안군_곶감.jpg", active: false, code: "L010" },
    { area: "창녕군", "대표농특산품": "양파", imgName: "창녕군_양파.jpg", active: false, code: "L011" },
    { area: "고성군", "대표농특산품": "방울토마토", imgName: "고성군_방울토마토.jpg", active: false, code: "L012" },
    { area: "남해군", "대표농특산품": "마늘", imgName: "남해군_마늘.jpg", active: false, code: "L013" },
    { area: "하동군", "대표농특산품": "녹차", imgName: "하동군_녹차.jpg", active: false, code: "L014" },
    { area: "산청군", "대표농특산품": "약초", imgName: "산청군_약초.jpg", active: false, code: "L015" },
    { area: "함양군", "대표농특산품": "밤", imgName: "함양군_밤.jpg", active: false, code: "L016" },
    { area: "거창군", "대표농특산품": "사과", imgName: "거창군_사과.jpg", active: false, code: "L017" },
    { area: "합천군", "대표농특산품": "돼지고기", imgName: "합천군_돼지고기.jpg", active: false, code: "L018" },
];

// setInterval 함수를 담는 변수들
let setTimer = null;
let setCardCountDown = null;

let cardChoice = true;
let gamePlay = false;

let newArr = null;
let nowCard = null;

const delay = s => {
    return new Promise(res => {
        let count = 0;
        const countDown = setInterval(() => {
            count++;
            time.children[1].innerText = s - count;
            if (count === s) {
                clearInterval(countDown);
                res();
            }
        }, 1000)
    })
};

const shuffleArray = arr => {
    for (let i = 0; i < arr.length; i++) {
        let j = Math.floor(Math.random() * (i + 1));
        const x = arr[i];
        arr[i] = arr[j];
        arr[j] = x;
    }

    return arr;
};

const cardDelay = s => {
    return new Promise((res, rej) => {
        setTimeout(() => {
            res();
        }, s * 1000)
    });
};

const cardCountDown = s => {
    setCardCountDown = setTimeout(() => {
        console.log("time out");
        nowCard.children[0].removeAttribute("style");
        nowCard.children[1].removeAttribute("style");
        nowCard = null;
    }, s * 1000)
};


const gameEnd = _ => {
    gamePlay = false;
    clearInterval(setCardCountDown);
    newArr.forEach((ele, idx) => {
        const card = cards[idx];
        card.children[0].style.transform = "rotateY(0deg)";
        card.children[1].style.transform = "rotateY(180deg)";

        if (ele.active) {
            card.style.border = "2px solid yellow";
        } else {
            card.style.border = "2px solid red";
            card.children[0].children[1].classList.remove("none");
        }
    })
};

const timer = _ => {
    time.children[0].innerText = 1;
    time.children[1].innerText = 30;
    setTimer = setInterval(() => {
        const min = time.children[0];
        const sec = time.children[1];

        if (min.innerText <= 0 && sec.innerText <= 0) {
            clearInterval(setTimer);
            gameEnd();
        } else {
            if (sec.innerText <= 0) {
                sec.innerText = 59;
                min.innerText--;
            } else {
                sec.innerText--;
            }
        }
    }, 1000)
};


const gameSetting = async _ => {
    if (!gamePlay) {
        const originArr = shuffleArray(dataArr);

        const doubleArr = [];
        for (let i = 0; i < 2; i++) {
            for (let j = 0; j < 8; j++) {
                doubleArr.push(originArr[j]);
            }
        };

        newArr = shuffleArray(doubleArr);

        cards.forEach((ele, idx) => {
            const imgTag = document.createElement("img");
            imgTag.src = `../(웹디자인)선수제공파일/특산품/${newArr[idx].imgName}`;
            const h3Tag = document.createElement("h3");
            h3Tag.innerText = newArr[idx].area;
            h3Tag.classList.add("none");
            ele.children[0].appendChild(imgTag);
            ele.children[0].appendChild(h3Tag);

            ele.children[0].style.transform = "rotateY(0deg)";
            ele.children[1].style.transform = "rotateY(180deg)";
        });

        time.children[1].innerText = 5;

        gamePlay = true;
        await delay(5);

        cards.forEach(ele => {
            ele.addEventListener("click", cardClickHandle);

            [...ele.children].forEach(chil => {
                chil.removeAttribute("style");
            })
        });

        startBtn.classList.add("none");
        resetBtn.classList.remove("none");
        timer();
    }
};


const gameReset = () => {
    clearInterval(setTimer);
    clearInterval(setCardCountDown);
    gamePlay = false;
    nowCard = null;
    newArr = null;
    cardChoice = true;
    time.children[0].innerHTML = 0;
    serachCardNum.innerHTML = 0;

    for (let i = 0; i < cards.length; i++) {
        cards[i].children[0].innerHTML = "";
        cards[i].removeAttribute("style");
    }

};

const hintClickHandle = async e => {
    newArr.forEach((ele, idx) => {
        if (!ele.active && gamePlay) {
            const card = cards[idx];
            card.children[0].style.transform = "rotateY(0deg)";
            card.children[1].style.transform = "rotateY(180deg)";
        }
    })
    await cardDelay(3);

    newArr.forEach((ele, idx) => {
        if (!ele.active && gamePlay) {
            const card = cards[idx];
            card.children[0].removeAttribute("style");
            card.children[1].removeAttribute("style");
        }
    })
};


const cardClickHandle = async e => {
    if (cardChoice) {
        e.currentTarget.children[0].style.transform = "rotateY(0deg)";
        e.currentTarget.children[1].style.transform = "rotateY(180deg)";

        if (nowCard === null) {
            nowCard = e.currentTarget;
            cardCountDown(3);
        } else {
            if (nowCard !== e.currentTarget) {
                clearInterval(setCardCountDown);
                const oldCode = newArr[nowCard.dataset.num - 1].code;
                const newCode = newArr[e.currentTarget.dataset.num - 1].code;
                if (oldCode === newCode) {
                    newArr.forEach((ele, idx) => {
                        if (ele.code === oldCode) {
                            newArr[idx] = { ...newArr[idx], active: true };
                            cards[idx].children[0].children[1].classList.remove("none");
                        }
                    });
                    serachCardNum.innerText++;
                    if (serachCardNum.innerText >= 8) {
                        gameEnd();
                    }
                } else {
                    const thisCard = e.currentTarget;
                    cardChoice = false;
                    await cardDelay(1);
                    [nowCard, thisCard].forEach(ele => {
                        if (gamePlay) {
                            ele.children[0].removeAttribute("style");
                            ele.children[1].removeAttribute("style");
                        }
                    });
                    cardChoice = true;
                }
                nowCard = null;
            }
        }

    }
};

const gameResetHandle = () => {
    gameReset();
    gameSetting();
};

const init = _ => {
    startBtn.addEventListener("click", gameSetting);
    resetBtn.addEventListener("click", gameResetHandle);
    hintBtn.addEventListener("click", hintClickHandle)
};

window.onload = _ => {
    init();
};





const popupForm = document.querySelector(".popup form");

const popupSubmitHandle = e => {
    // e.preventDefault();
    const name = e.currentTarget.name;
    const tel = e.currentTarget.tel;

    const nameRex = /^[a-zA-Zㄱ-ㅎ-ㅏ-ㅣ가-힣]{2,50}$/g;
    // const telRex = /^[0-9]{2,3}-[0-9]{3,4}-[0-9]{4}$/g;

    if(name.value.length === 0 || tel.value.length === 0) {
        alert("이름 또는 전화번호 항목을 입력해 주세요");

        return;
    }

    if(!nameRex.test(name.value)) {
        alert("이름은 2자 이상 50자 이내의 한글과 영어만 입력이 가능합니다.");

        return;
    }

    // if(!telRex.test(name.tel)) {
    //     alert("");

    //     return;
    // }

};

const telIptKeyDownHandle = e => {

    e.currentTarget.value = e.currentTarget.value.replace(/[^0-9]/g,'');

    const value = e.currentTarget.value;

    value.replace("-", "");

    let tel = null;
    if(value.length <= 3){
        value.substring(0, 3);

    }
    
    if(value.length <= 7) {
        value.substring(4, 8);
        
    }

    if(value.length <= 9) {
        
    }
    
    // value
   
    // e.currentTarget.value
    if(!telRex.test(e.key)) {
        e.preventDefault();
        return false;
    }
    // console.log(telRex.test(e.currentTarget.value));
    // console.log(e.key);
};

popupForm.addEventListener("submit", popupSubmitHandle);
popupForm.tel.addEventListener("input", telIptKeyDownHandle);