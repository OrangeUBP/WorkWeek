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
                break;
            }

            case 'projects': {
                if (isset($id) and !is_null($id)){
                    getProject($connect, $id);
                } else {
                    getProjects($connect);
                }
                break;
            }

            case 'week': {
                getWeek($connect);
                break;
            }
        }
        break;
    }

    case 'POST': {

        switch($type){

            case 'employees':{
                addEmployee($connect, $_POST);
                break;
            }

            case 'projects': {
                addProject($connect, $_POST);
                break;
            }

            case 'week' :{
                addProjectWeek($connect, $_POST);
                break;
            }
        }
        break;
    }

    case 'PATCH': {

        switch($type){

            case 'employees': {
                if (isset($id)){
                    $data = file_get_contents('php://input');
                    $data = json_decode($data, true);

                    updateEmployee($connect, $id, $data);
                }
                break;
            }

            case 'projects': {
                if (isset($id)){
                    $data = file_get_contents('php://input');
                    $data = json_decode($data, true);

                    updateProject($connect, $id, $data);
                }
                break;
            }

            case 'week':{
                if (isset($id)){
                    $data = file_get_contents('php://input');
                    $data = json_decode($data, true);

                    updateWeek($connect, $id, $data);
                }
                break;
            }
        }
        break;
    }

    case 'DELETE': {

        switch ($type){

            case 'employees': {
                if (isset($id)){
                    deleteEmployee($connect, $id);
                }
                break;
            }

            case 'projects': {
                if (isset($id)){
                    deleteProject($connect, $id);
                }
                break;
            }

            case 'week': {
                if (isset($id)){
                    deleteWeek($connect, $id);
                }
                break;
            }
        }
        break;
    }

}

