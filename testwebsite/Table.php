<table border=1 cellpadding=2>
    <tr>
        <th>ID</th>
        <th>PRODUCT_ID</th>
        <th>PRODUCT_NAME</th>
        <th>PRODUCT_PRICE</th>
        <th>PRODUCT_ARTICLE</th>
        <th>PRODUCT_QUANTITY</th>
        <th>DATE_CREATE</th>
        <th>HIDE_BTN</th>
    </tr>
    <?php 
    include_once "CProducts.class.php";
    $сPr = new CProducts(); 
    $res = $сPr->queryProducts($_POST["maxProducts"]); // отправляем запрос и записываем результат в переменную
    CProducts::tableWrite($res); // выводим результат
    ?>
</table>