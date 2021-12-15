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
