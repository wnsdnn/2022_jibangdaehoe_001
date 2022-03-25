<section class="specialty">
    <div class="item-container grid">
        <?php foreach($list as $item): ?>
            <fieldset>
                <legend><?=$item->area ?></legend>
                <img src="./img/<?=$item->img ?>" alt="">
                <h1>대표특산품: <?=$item->specialty ?></h1>
            </fieldset>
        <?php endforeach; ?>
    </div>
</section>