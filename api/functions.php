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
            "message" => "Post not found"
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
            "message" => "Post not found"
        ];
        echo json_encode($res);
    } else {
        $project = mysqli_fetch_assoc($project);
        echo json_encode($project);
    }
}

function addEmployee($connect, $data){
    $name = $data['name'];
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
    mysqli_query($connect, "UPDATE `employees` SET `name` = '$name' WHERE `employees`.`id` = '$id'");

    http_response_code(200);

    $res = [
        "status" => true,
        "project_id" => "Employee is updated"
    ];

    echo json_encode($res);
}