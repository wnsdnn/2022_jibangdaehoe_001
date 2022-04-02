<div class="specialty_detail flex">
    <form method="post" class="flex">
        <h3 class="area"><?=$result->area ?></h3>
        <input type="hidden" name="area" value="<?=$result->area ?>">
        <label>
            <img class="img" src="./(웹디자인)선수제공파일/특산품/<?=$result->img ?>" alt="detailImg" title="detailImg">
        </label>
        <label>
            사진 변경
            <input type="file" name="photo" accept=".jpg">
            <input type="hidden" name="base64">
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
    const $form = document.querySelector("form");
    const returnSrc = (img) => {
        return new Promise( res => {
            const reader = new FileReader();
            reader.readAsDataURL(img);
            reader.onload = () => { res(reader.result) };
        } );
    };

    const _photoChange = async function(e) {
        if(this.value.substr(-3) !== "jpg") {
            alert("jpg 이미지만 입력가능 합니다.");
            this.value = '';
        }
        const base64 = await returnSrc(this.files[0]);
        $form.base64.value = base64;
        $form.querySelector("img").src = base64;
    }

    $form.photo.addEventListener("change", _photoChange);
</script>
