<?php
header('Content-type: json/application');

require_once 'connect.php';
require_once 'functions.php';

$method = $_SERVER['REQUEST_METHOD'];

$q = $_GET['q'];
$params = explode('/', $q);

$type = $params[0];

if (isset($params[1])){
    $id = $params[1];
}

if ($type == 'employees'){
    if (isset($id) and !is_null($id)){
        getEmployee($connect, $id);
    } else {
        getEmployees($connect);
    }
} elseif ($method === 'POST'){
    if ($type === 'employees') {
        //функция добавления емплоера
    }
}
