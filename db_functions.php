<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function test_include(){
    echo "test geklappt";
    
}

/* Connect to server and select database */
function connect_to_db(){
    $host = "blub"; // Host name
    $username = "blub"; // Mysql username
    $password = "blub"; // Mysql password
    $db_name = "blub"; // Database name

    // 1. Create a database connection
    $connection = mysqli_connect("$host", "$username", "$password");
    if (!$connection) {
        die("Database connection failed: " . mysqli_error($connection));
    }

    // 2. Select a database to use 
    $db_select = mysqli_select_db($connection, $db_name);
    if (!$db_select) {
        die("Database selection failed: " . mysqli_error($connection));
    }
    
    return $connection;
}

function close_db_connection($connection){
    if ($connection) {
        mysqli_close($connection);
    }
}



