<section class="specialty_admin">
    <h3>특산품 정보 관리</h3>
    <div class="item-container grid">
        <?php foreach($list as $item): ?>
            <fieldset>
                <legend><?=$item->area ?></legend>
                <img src="./img/<?=$item->img ?>" alt="">
                <h1>대표특산품: <?=$item->specialty ?></h1>
                <button><a href="/specialty_detail?area=<?=$item->area ?>">관리</a></button>
            </fieldset>
        <?php endforeach; ?>
    </div>
</section>