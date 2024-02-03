<?php
require 'vendor/autoload.php';

use Controllers\GroupController;
use Controllers\UserController;


$userController = new UserController();
$userController->setPost($_POST);
$groupController = new GroupController();
$groupController->setPost($_POST);

$action = $_GET['action'];

switch ($action) {
    case 'addUser':
        $userController->add();
        break;
    case 'getUsers':
        $ret = $userController->list();
        break;
    case 'getUser':
        $ret = $userController->getUser();
        break;
    case 'editUser':
        $ret = $userController->editUser();
        break;
    case 'addUserToGroup':
        $ret = $userController->addUserToGroup();
        break;
    case 'getUserGroups':
        $ret = $userController->getUserGroups();
        break;
    case 'removeUser':
        $userController->removeUser();
        break;
    case 'addGroup':
        $groupController->add();
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
        $groupController->removeGroup();
        break;
    case 'removeUserFromGroup':
        $groupController->removeUserFromGroup();
        break;
}