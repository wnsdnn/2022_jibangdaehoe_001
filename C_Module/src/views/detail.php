

<form name="specialty_update" method="post">
    지역: <span><?=$info->area ?></span> <br>
    <input type="hidden" name="area" value="<?=$info->area ?>">
    <img src="./(웹디자인)선수제공파일/특산품/<?=$info->img ?>" alt=""> <br>
    이미지 변경: <input type="file" name="photo_name" accept=".jpg"> <br>
    <input type="hidden" name="imgUrl">
    대표특산품: <input type="text" name="specialty" value="<?=$info->specialty ?>"> <br>
    <input type="submit" value="수정">
</form>

<script>
    let imgSrc = null;
    const returnSrc = (img) => {
        return new Promise( (res) => {
            const reader = new FileReader();
            reader.readAsDataURL(img);
            reader.onload = () => { res(reader.result) };
        } )
    };
    
    document.forms[0].photo_name.addEventListener("change", async function() {
        const src = await returnSrc(this.files[0]);
        const img = document.querySelector("form img");
        imgSrc = src;
        img.src = src;
    })

    document.forms[0].addEventListener("submit", async function(e) {
        e.preventDefault();
        this.imgUrl.value = imgSrc;
        this.submit();
    })
</script>




