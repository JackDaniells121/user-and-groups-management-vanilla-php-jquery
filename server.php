<?php
require 'vendor/autoload.php';

use Controllers\GroupController;
use Controllers\UserController;


// db.php - Connection to the database
//$servername = "localhost";
//$username = "felg_dent_php_user";
//$password = "1234";
//$dbname = "felg_dent_php_test";
//
//$conn = new mysqli($servername, $username, $password, $dbname);
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//}

$userController = new UserController();
$userController->setPost($_POST);
$groupController = new GroupController();
$groupController->setPost($_POST);

$action = $_GET['action'];

switch ($action) {
    case 'addUser':
        $userController->add($_POST);
        break;
    case 'getUsers':
        $ret = $userController->list($_POST);
        break;
    case 'getUser':
        $ret = $userController->getUser($_POST);
        break;
    case 'editUser':
        $test = $_POST;
        $ret = $userController->editUser();
        break;
    case 'addUserToGroup':
        $ret = $userController->addUserToGroup();
        break;
    case 'getUserGroups':
        $ret = $userController->getUserGroups();
        break;
    case 'removeUser':
        $userController->removeUser($_POST['id']);
        break;
    case 'addGroup':
        $groupController->add($_POST);
        break;
    case 'getGroup':
        $groupController->getGroup();
        break;
    case 'editGroup':
        $groupController->editGroup();
        break;
    case 'getGroups':
        $ret = $groupController->list();
        break;
    case 'removeGroup':
        $groupController->removeGroup($_POST['id']);
        break;
    case 'removeUserFromGroup':
        $groupController->removeUserFromGroup($_POST);
        break;
}

// Close the database connection
function closeConnection() {
    global $conn;
    $conn->close();
}

