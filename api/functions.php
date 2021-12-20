<?php

function getEmployees($connect)
{
    $employees = mysqli_query($connect, "SELECT * FROM `employees`");
    $employeesList = [];

    while ($employee = mysqli_fetch_assoc($employees)){
        $employeesList[] = $employee;
    }

    echo json_encode($employeesList);
}

function getEmployee($connect, $id)
{
    $employee = mysqli_query($connect, "SELECT * FROM `employees` WHERE `id` = '$id'");

    if (mysqli_num_rows($employee) === 0){
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "Project not found"
        ];
        echo json_encode($res);
    } else {
        $employee = mysqli_fetch_assoc($employee);
        echo json_encode($employee);
    }
}

function getProjects($connect)
{
    $projects = mysqli_query($connect, "SELECT * FROM `projects`");
    $projectsList = [];

    while ($project = mysqli_fetch_assoc($projects)){
        $projectsList[] = $project;
    }

    echo json_encode($projectsList);
}

function getProject($connect, $id)
{
    $project = mysqli_query($connect, "SELECT * FROM `projects` WHERE `id` = '$id'");

    if (mysqli_num_rows($project) === 0){
        http_response_code(404);
        $res = [
            "status" => false,
            "message" => "Project not found"
        ];
        echo json_encode($res);
    } else {
        $project = mysqli_fetch_assoc($project);
        echo json_encode($project);
    }
}

function addEmployee($connect, $data){
    $name = $data['name'];

    if(isEmptyName($name)){
        return;
    }

    mysqli_query($connect, "INSERT INTO `employees` (name) VALUES ('$name')");

    http_response_code(201);

    $res = [
        "status" => true,
        "employee_id" => mysqli_insert_id($connect)
    ];

    echo json_encode($res);
}

function addProject($connect, $data){
    $name = $data['name'];

    if(isEmptyName($name)){
        return;
    }

    mysqli_query($connect, "INSERT INTO `projects` (name) VALUES ('$name')");

    http_response_code(201);

    $res = [
        "status" => true,
        "project_id" => mysqli_insert_id($connect)
    ];

    echo json_encode($res);
}

function updateEmployee($connect, $id, $data){
    $name = $data['name'];

    if(isEmptyName($name)){
        return;
    }

    mysqli_query($connect, "UPDATE `employees` SET `name` = '$name' WHERE `employees`.`id` = '$id'");

    http_response_code(200);

    $res = [
        "status" => true,
        "message" => "Employee is updated"
    ];

    echo json_encode($res);
}

function updateProject($connect, $id, $data){
    $name = $data['name'];

    if(isEmptyName($name)){
        return;
    }

    mysqli_query($connect, "UPDATE `projects` SET `name` = '$name' WHERE `projects`.`id` = '$id'");

    http_response_code(200);

    $res = [
        "status" => true,
        "message" => "Project is updated"
    ];

    echo json_encode($res);
}

function deleteEmployee($connect, $id){

    $emp = mysqli_query($connect, "DELETE FROM `employees` WHERE `employees`.`id` = '$id'");

    http_response_code(200);

    $res = [
        "status" => true,
        "message" => "Employee is deleted"
    ];

    //echo json_encode($res);
    echo $emp;
}


function deleteProject($connect, $id){

    mysqli_query($connect, "DELETE FROM `projects` WHERE `projects`.`id` = '$id'");

    http_response_code(200);

    $res = [
        "status" => true,
        "message" => "Project is deleted"
    ];

    echo json_encode($res);
}

function isEmptyName($name){
    if(empty($name)){
        http_response_code(400);

        $res = [
            "status" => false,
            "message" => "Field is empty"
        ];

        echo json_encode($res);
        return true;
    }else{
        return false;
    }
}

