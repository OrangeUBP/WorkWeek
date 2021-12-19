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

switch($method) {

    case 'GET': {

        switch($type){

            case 'employees': {
                if (isset($id) and !is_null($id)){
                    getEmployee($connect, $id);
                } else {
                    getEmployees($connect);
                }
            }

            case 'projects': {
                if (isset($id) and !is_null($id)){
                    getProject($connect, $id);
                } else {
                    getProjects($connect);
                }
            }
        }
    }

    case 'POST': {

        switch($type){

            case 'employees':{
                addEmployee($connect, $_POST);
            }

            case 'projects': {
                addProject($connect, $_POST);
            }
        }

    }

    case 'PATCH': {

        switch($type){

            case 'employees':{
                if (isset($id)){
                    $data = file_get_contents('php://input');
                    $data = json_decode($data, true);

                    updateEmployee($connect, $id, $data);
                }
            }

            case 'projects': {

            }
        }
    }

}

