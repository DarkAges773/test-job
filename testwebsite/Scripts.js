var maxProducts = 5;
async function hideProduct(id) // отправляет ajax запрос на скрытие товара и вызывает обновление таблицы
{
$.ajax({
        type: "POST",
        url: "Hide.php",
        data: "ID=" + id,
        success: function(){updateTable(maxProducts);}
    });
}
async function showProducts() // отправляет ajax запрос для сброса флагов IS_HIDDEN у всех товаров и вызывает обновление таблицы
{
    $.ajax({
        url: "ShowAll.php",
        success: function(){updateTable(maxProducts);}
    });
}
async function increase() // увеличивает кол-во отображаемых товаров и вызывает обновление таблицы
{
    maxProducts++;
    updateTable(maxProducts);
}
async function decrease() // уменьшает кол-во отображаемых товаров и вызывает обновление таблицы
{
    if (maxProducts <= 0) return;
    maxProducts--;
    updateTable(maxProducts);
}
async function updateTable(maxProducts) // отпраляет ajax запрос для обновления таблицы и выводит ее в соответствующий контейнер
{
    $('input.max-products').attr("value", maxProducts);
    $.ajax({
        type: "POST",
        url: "table.php",
        data: "maxProducts=" + maxProducts,
        success: function (html) { $('div.table-container').html(html); }
    });
}