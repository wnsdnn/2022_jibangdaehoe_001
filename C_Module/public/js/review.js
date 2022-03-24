console.log("Hello World");
const reviewForm = document.querySelector("form.reviewForm");

const reviewFormSubmitHandle = async e => {
    e.preventDefault();
    const form = e.currentTarget;
    const formData = new FormData(form);
    const imgArr = [];

    for(let i = 0; i<form.photo.files.length; i++)
    {
        const returnSrc = (img) => {
            return new Promise( (res) => {
                const reader = new FileReader();
                reader.readAsDataURL(img);
                reader.onload = () => res(reader.result);
            } )
        };
        
        const imgLoad = (src) => {
            return new Promise( (res) => {
                const imgTag = new Image();
                imgTag.src = src;
                imgTag.onload = () => { res( [imgTag, imgTag.width, imgTag.height] ) }
            } )
        }
        const src = await returnSrc(form.photo.files[i]);

        const canvasTag = document.createElement("canvas");
        const ctx = canvasTag.getContext('2d');

        const [imgTag, width, height] = await imgLoad(src);
        let newWidth = 0;
        let newHeight = 0;

        if(width > 500 || height > 500) {
            newWidth = width >= height ? 500 : (width/height)*500;
            newHeight = width >= height ? (height/width)*500 : 500;
        } else {
            newWidth = width;
            newHeight = height;
        }

        imgTag.width = newWidth;
        imgTag.height = newHeight;
        imgTag.style.objectFit = "cover";

        canvasTag.width = newWidth;
        canvasTag.height = newHeight;
        ctx.drawImage(imgTag, 0, 0, newWidth, newHeight);
        ctx.font = "bold 3em 나눔고딕";
        ctx.textAlign = "center";
        ctx.fillStyle = "rgba(0, 0, 0, .5)"
        ctx.fillText("경상남도 특산품", canvasTag.width/2, canvasTag.height/2);

        const canvasImgURL = canvasTag.toDataURL("image/jpeg");
        imgArr.push({url: canvasImgURL, name: form.photo.files[i].name});
        
    }
    formData.append("imgArr", JSON.stringify(imgArr));

    const data = await fetch("/api/reviews", {
        method: "POST",
        body: formData
    }).then( res => res.json() );
    alert(`${data.message}`);
    form.reset();
};

reviewForm.addEventListener("submit", reviewFormSubmitHandle);