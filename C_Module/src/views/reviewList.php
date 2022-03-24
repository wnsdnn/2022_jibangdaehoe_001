<section class="reviewList">
    <table class="listTbl">
        <tr>
            <th>글번호</th>
            <th>이름</th>
            <th>구매품</th>
            <th>구매처</th>
            <th>구매일</th>
            <th>내용</th>
            <th>별점</th>
        </tr>
    </table>
    
    <div class="popup none">
        <div>
            <form>
                <div class="content flex">
                    <p class="close_btn">X</p>
                    <button type="button" class="arrow_btn back"><</button>
                    <div class="text">
                        <p class="flex">이름: <input type="text" name="name" readonly></p>
                        <p class="flex">구매품: <input type="text" name="product" readonly></p>
                        <p class="flex">구매처: <input type="text" name="shop" readonly></p>
                        <p class="flex">구매일: <input type="text" name="purchase-date" readonly></p>
                        <p class="flex content">후기 <textarea name="contents"  readonly></textarea></p>
                        <p class="flex">별점: <input type="text" name="score" readonly></p>
                    </div>
                    <div class="photo">
                        <img src="./img/noimg.png" alt="">
                        <div class="photos">
                        </div>
                    </div>
                    <button type="button" class="arrow_btn next">></button>
                </div>
            </form>
        </div>
    </div>
</section>

<script src="./js/reviewList.js"></script>