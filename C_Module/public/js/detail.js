

const formSubmitHandle = async function(e) {
    e.preventDefault();

    if(this.photo.files[0] === undefined || this.area.value === "") {
        alert("필수 정보들을 입력해주세요");

        return;
    }


    const returnSrc = (img) => {
        return new Promise( (res) => {
            const reader = new FileReader();
            reader.readAsDataURL(img);
            reader.onload = () => res(reader.result);
        } )
    };
    
    const src = await returnSrc(this.photo.files[0]);
    this.src.value = src;
    this.name.value = this.photo.files[0].name;

    this.submit();
    
}


document.forms[0].addEventListener("submit", formSubmitHandle);

 