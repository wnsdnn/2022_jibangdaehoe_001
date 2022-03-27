<section class="admin_event">
    <div class="serach">
        <form>
            <input type="text" name="keyword">
            <input type="submit" value="조회">
        </form>
    </div>
    <table>
        <thead>
            <tr>
                <th>이름</th>
                <th>휴대폰번호</th>
                <th>점수</th>
                <th>참여일</th>
                <th>연속출석일수</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($list as $item): ?>
                <tr>
                    <td><?=$item->name ?></td>
                    <td><?=$item->tel ?></td>
                    <td><?=$item->score ?></td>
                    <td><?=$item->date ?></td>
                    <td><?=$item->conDate ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>


<script>
    const form = document.querySelector("");
</script>