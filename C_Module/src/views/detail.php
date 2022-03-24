
<h3><?=$result->area ?></h3>
<form method="post">
    <input type="hidden" name="src">
    <input type="hidden" name="name">
    <input type="hidden" name="area" value="<?=$result->area ?>">
    특산품: <input type="text" name="specialty" value="<?=$result->specialty ?>"> <br>
    사진: <input type="file" name="photo" accept=".jpg"> <br>
    <input type="submit" value="수정하기">
</form>

<script src="./js/detail.js"></script>