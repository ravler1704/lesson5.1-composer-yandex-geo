<html>
    <head>
    </head>
    <body>
        <h1>Определение координат</h1>
        <form action="" method="get" enctype="multipart/form-data">
            <input type="text" name="address" placeholder="Адрес"/>

            <input type="submit" value="Найти" />
        </form>
    </body>
</html>

<?php
Error_reporting(E_ALL);
if (isset($_GET['address'])) {
    $address = $_GET['address'];
    $content = file_get_contents ('http://geocode-maps.yandex.ru/1.x/?format=json&geocode=' . $address);
    $coordinate = json_decode ($content, true);
    echo "Широта и долгота - " . $coordinate["response"]["GeoObjectCollection"]["featureMember"]["0"]["GeoObject"]["Point"]["pos"];
    echo '<br /><br />';
    echo '<h4>Другие варианты координат</h4>';
    $allAddresses = $coordinate["response"]["GeoObjectCollection"]["featureMember"];
    foreach ($allAddresses as $key => $value) {
        echo $value["GeoObject"]["metaDataProperty"]["GeocoderMetaData"]["text"] . " -- " . $value["GeoObject"]["Point"]["pos"] . '<br />';
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Примеры. Задание собственного отображения для результатов поиска</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
        <script src="custom_search_results.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="map"></div>
    </body>
</html>