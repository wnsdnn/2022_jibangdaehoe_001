<section class="event_admin">
    <h3>이벤트 정보 관리</h3>

    <form class="sreach_box">
        <input type="date" name="date">
        <input type="submit" value="조회">
    </fo>

    <table>
        <tr>
            <th>이름</th>
            <th>휴대폰번호</th>
            <th>점수</th>
            <th>참여일</th>
            <th>연속출석일수</th>
        </tr>
        <?php foreach($result as $item): ?>
            <tr class="content">
                <td id="name"><?=$item->name ?></td>
                <td id="tel"><?=$item->tel ?></td>
                <td id="score"><?=$item->score ?></td>
                <td id="date"><?=$item->date ?></td>
                <td id="conDate"><?=$item->conDate ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>
<script src="./js/event_admin.js"></script>