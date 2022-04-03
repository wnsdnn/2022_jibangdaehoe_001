<div class="detail_spe flex">
    <form method="post" class="flex">
        <input type="hidden" name="area" value="<?=$result->area ?>">
        <input type="hidden" name="base64">

        <img src="./(웹디자인)선수제공파일/특산품/<?=$result->img ?>">
        <h3><?=$result->area ?></h3>
        <label>
            사진변경
            <input type="file" name="photo">
        </label>
        <label>
            대표 특산품
            <input type="text" name="specialty" value="<?=$result->specialty ?>">
        </label>
        <label>
            특산품
            <input type="text" name="specialtys" value="<?=$result->specialtys ?>">
        </label>
        <input type="submit" value="수정">
    </form>
</div>


<script>
    const form = document.querySelector(".detail_spe form");

    const returnSrc = (img) => {
        return new Promise( res => {
            const reader = new FileReader();
            reader.readAsDataURL(img);
            reader.onload = () => { res(reader.result) };
        } )
    };

    const _changePhoto = async function() {
        if(this.value.substr(-3) != "jpg") {
            alert("jpg만 입력가능합니다.");
            this.value = '';
        };

        const src = await returnSrc(this.files[0]);
        form.querySelector("img").src = src;
        form.base64.value = src;
    };


    form.photo.addEventListener("change", _changePhoto);
</script>