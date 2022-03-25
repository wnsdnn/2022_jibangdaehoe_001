console.log("Hello World");

const listTbl = document.querySelector("table.listTbl");
const popup = document.querySelector("section.reviewList .popup");
const popupcloseBtn = document.querySelector("section.reviewList .popup .close_btn");

const photo = document.querySelector("section.reviewList .popup .photo>img");
const photos = document.querySelector("section.reviewList .popup .photo .photos");

const btns = document.querySelectorAll("section.reviewList .popup button");

let key = null;


const trClickHandle = async function() {
    key = this.dataset.key;
    const data = await fetch(`api/reviews/${key}`).then( res => res.json() );
    popup.className = "popup flex";
    
    popupInsertData(data);
};

const addList = async () => {
    const data = await fetch("/api/reviews?last-key=100")
    .then( res => res.json() );

    data.reviews.forEach( ele => {
        const trTag = document.createElement("tr");
        trTag.dataset.key = ele.key;
        trTag.classList.add("content");
        trTag.innerHTML = `
            <td><p>${ele.key}</p></td>
            <td><p>${ele.name}</p></td>
            <td><p>${ele.product}</p></td>
            <td><p>${ele.shop}</p></td>
            <td><p>${ele["purchase-date"]}</p></td>
            <td><p>${ele.contents}</p></td>
            <td><p>${ele.score}</p></td>
            <td><img src="./img/${ele.photo ? ele.photo : "noimg.png"}" /></td>
        `;
        listTbl.appendChild(trTag);
        trTag.addEventListener("click", trClickHandle);
    } )
    
};

const subImgClickHandle = function() {
    const imgs = document.querySelectorAll("section.reviewList .popup .photos img");
    imgs.forEach( ele => ele.classList.remove("none") );
    photo.src = this.src;
    imgs.forEach( ele => {
        if(ele.src === this.src) {
            ele.classList.add("none");
        }
    } );

};

const popupInsertData = (data) => {
    const form = document.forms[0];
    form.name.value = data.name;
    form.product.value = data.product;
    form.shop.value = data.shop;
    form["purchase-date"].value = data["purchase-date"];
    form.contents.innerText = data.contents;
    form.score.value = data.score;

    photos.innerHTML = ``;
    photo.src = `./img/${data.photos[0] ? data.photos[0].url : 'noimg.png'}`;
    data.photos.forEach( (ele, idx) => {
        const imgTag = document.createElement("img");
        imgTag.src = `./img/${ele.url}`;
        if(idx === 0) imgTag.classList.add("none");
        photos.appendChild(imgTag);
        imgTag.addEventListener("click", subImgClickHandle);
    } )
};

const btnClickHandle = async function(e) {
    let data = null;
    const originkKey = key;
    if(e.target.classList.contains("next")) {

        key++;
        data = await fetch(`api/reviews/${key}`).then( res => res.json() );
    } else {
        key--;
        data = await fetch(`api/reviews/${key}`).then( res => res.json() );
    }

    if(data.message) {
        alert(`${data.message}`);
        key = originkKey;
    } else {
        popupInsertData(data);
    }
};


const init = () => {
    addList();
    popupcloseBtn.addEventListener("click", () => { popup.classList = "popup none" } );
    btns.forEach( ele => {
        ele.addEventListener("click", btnClickHandle);
    } );
};

window.onload = () => {
    init();
};
