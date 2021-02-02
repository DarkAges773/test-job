<?php 
class CProducts
{
    private $link;
    public $result;

    public function __construct() // конструктор, в нем устанавливаем соединение с бд и сохраняем его в переменную
    {
        global $link;
        $link = $this->connect();
    }
    private function connect() // метод для подключения к бд
    {
        $connection = mysqli_connect('127.0.0.1:3306', 'root', '1234', 'shop') // здесь записываем данные для подключения к бд
            or die("Ошибка " . mysqli_error($connection)); 
        return $connection;
    }
    public function queryProducts($maxProducts) // отправка запроса с максимальным кол-вом товаров
    {
        global $link, $result;
        $query = 'SELECT * FROM shop.products WHERE IS_HIDDEN != 1 ORDER BY DATE_CREATE DESC LIMIT '.$maxProducts; // создаем запрос
        
        $result = mysqli_query($link, $query.';') // отправляем запрос
            or die("Ошибка " . mysqli_error($link)); 
        return $result;
    }
    public static function tableWrite($result) // статический метод для вывода результат в формате таблицы
    {
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) // разбираем результат
        {
            $patterns = array( '/{ID}/', '/{PRODUCT_ID}/', '/{PRODUCT_NAME}/', '/{PRODUCT_PRICE}/', '/{PRODUCT_ARTICLE}/', '/{PRODUCT_QUANTITY}/', '/{DATE_CREATE}/' ); // паттерн замены
            $tmp = file_get_contents("TableRow.html") // шаблон для замены
                or die("Ошибка " . "файл TableRow.html не найден!"); 

            echo preg_replace( $patterns, $row, $tmp ); // выводим шаблон с данными из бд
        }
    }
    public function hideProduct($id) // скрывает товар по полученному id
    {
        global $link;
        $query = "UPDATE `shop`.`products` SET `IS_HIDDEN` = 1 WHERE (`ID` = ".$id.")";
        
        mysqli_query($link, $query.';');
    }
    public function showAll() // снимает метку IS_HIDDEN со всех товаров
    {
        global $link;
        $query = "UPDATE `shop`.`products` SET `IS_HIDDEN` = '0' WHERE (`IS_HIDDEN` = '1');";

        mysqli_query($link, $query.';');
    }
}
?>