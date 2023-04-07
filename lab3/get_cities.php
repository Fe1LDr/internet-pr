<?php
if(isset($_POST['country_id'])) {
    $countryId = $_POST['country_id'];
    // Загрузка списка городов из файла cities.json
    $citiesData = file_get_contents('cities.json');
    $cities = json_decode($citiesData, true);
    // Фильтрация списка городов по id страны
    $filteredCities = array_filter($cities, function($city) use ($countryId) {
        return $city['country_id'] == $countryId;
    });
    // Формирование списка городов в формате JSON
    $result = array();
    foreach($filteredCities as $city) {
        $result[$city['id']] = $city['name'];
    }
    echo json_encode($result);
}
?>