<section class="admin_specialty">
    <h2 class="title">특산품 관리</h2>
    <div class="item-container grid">
        <?php foreach($list as $item): ?>
            <div class="item">
                <div class="photo">
                    <img src="./(웹디자인)선수제공파일/특산품/<?=$item->img ?>">
                </div>
                <h3><?=$item->area ?></h3>
                <p>대표 특산물: <?=$item->specialty ?></p>
                <button><a href="/detail?area=<?=$item->area ?>">관리</a></button>
            </div>
        <?php endforeach; ?>
    </div>
</section>