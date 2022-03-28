
const page = document.body.id;

const $ = ($e,$p=document) => $p.querySelector($e);
const $All = ($e,$p=document) => [...$p.querySelectorAll($e)];
const $add = ($e,$func,handle="click") => $e.addEventListener(handle, $func); 


{
    page === "review" ? reviewPage() :
    page === "event" ? eventPage() :
    ''
}


function eventPage() {
    console.log("eventPage");
}

function reviewPage() {
    const $reviewModal = $(".review_modal");
    const $openBtn = $("header .open_modal");
    const $closeBtn = $(".close", $reviewModal);
    const $scoreBox = $(".score_container", $reviewModal);
    const $addPhotoBtn = $(".add_photo", $reviewModal);
    const $form = $("form", $reviewModal);

    const dataArr = [];

    const toggleModal = function() {
        $reviewModal.classList.toggle("none");
    };

    const render = function() {
        const $reviewBox = $(".review-container");
        $reviewBox.innerHTML = ``;
        dataArr.forEach( ele => {
            const scoreArr = [];
            const item = document.createElement("div");
            item.classList.add("item");
            for(let i=0; i<5; i++) {
                if(i < Math.floor(ele.score/2)) {
                    scoreArr.push("<i class='fa fa-star'></i>");
                } else if(ele.score%2 === 1 && i === Math.floor(ele.score/2) ) {
                    scoreArr.push("<i class='fa fa-star-half-o'></i>");
                } else {
                    scoreArr.push("<i class='fa fa-star-o'></i>");
                }
            }
            item.innerHTML = `
                <p class="name">${ele.name}</p>
                <p class="date">${ele.date}</p>
                <div class="photo">
                    <img src="${ele.photos[0]}" alt="reviewImg" title="reviewImg">
                </div>
                <div class="score_box">
                    ${scoreArr.map( ele => ele ).join("")}
                </div>
                <p class="product">구매품: ${ele.product}</p>
                <p class="shop">구매처: ${ele.shop}</p>
                <p class="content">내용: ${ele.content}</p>
            `;
            $reviewBox.appendChild(item);
        } );
    }

    const _formSubmit = async function(e) {
        e.preventDefault();
        const photos = $All("input[name='photo']", $reviewModal);


        const srcReturn = (img) => {
            return new Promise( res => {
                const reader = new FileReader();
                reader.readAsDataURL(img);
                reader.onload = () => { res(reader.result) };
            } )
        }

        try {
            if(this.name.value.length < 2 || this.name.value.length > 50)
                throw "이름은 2글자 이상 50글자 이내여야 합니다.";
            if(!/[a-zA-Zㄱ-ㅎ가-힣]/.test(this.name.value))
                throw "이름은 한글 또는 영어여야 합니다.";
            if(this.product.value.length < 1)
                throw "구매품을 입력해주세요.";
            if(this.shop.value.length < 1)
                throw "구매처를 입력해주세요.";
            if(this.date.value.length < 1)
                throw "구매일을 입력해주세요.";
            if(this.content.value.length < 100)
                throw "내용을 100글자 이상 입력해주세요.";
            if(this.score.value < 1)
                throw "별점을 입력해주세요.";
            if(!photos.length || !photos.some( ele => ele.value ))
                throw "사진을 1장이상 넣어주세요.";
        } catch(e) {
            alert(e);
            return
        }

        const photoArr = [];
        for(const $p of photos) {
            if(!$p.files[0]) continue;
            photoArr.push(await srcReturn($p.files[0]))
        }

        const obj = {
            name: this.name.value,
            product: this.product.value,
            shop: this.shop.value,
            date: this.date.value,
            content: this.content.value,
            score: this.score.value,
            photos: photoArr
        };

        dataArr.splice(0, 0, obj);
        render();
        toggleModal();
    };

    const _scoreMove = function(e) {
        const $x = e.layerX / 40 < 0 ? 0 : e.layerX / 40;
        let score = 0;

        [...this.children].forEach( (ele, idx) => {
            ele.className = "fa fa-star-o";
            if(idx < Math.floor($x)) {
                ele.className = "fa fa-star";
                score+=2;
            }
        } )
        
        if($x%1 >= 0.5) {
            this.children[Math.floor($x)].className = "fa fa-star";
            score+=2;
        } else {
            this.children[Math.floor($x)].className = "fa fa-star-half-o";
            score+=1;
        }

        $form.score.value = score;
    };

    const _addPhoto = function() {
        const iptTag = document.createElement("input");
        const photoBox = $(".photo_box", $reviewModal);
        iptTag.type = "file";
        iptTag.name = "photo";
        photoBox.appendChild(iptTag);
    };
    
    $add($openBtn, toggleModal);
    $add($closeBtn, toggleModal);
    $add($form, _formSubmit, "submit");
    $add($scoreBox, _scoreMove, "mousemove")
    $add($addPhotoBtn, _addPhoto)
}

