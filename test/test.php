<?php
require_once '../classes/UsersManager.php';
require_once '../classes/RegisterManager.php';

//Test méthode Users::getFullName() :
$test = new Users;
$test->setFirstName('Jean');
$test->setLastName('Tille');

echo $test->getFullName();

//Test méthode Register::listGroups() :
echo "\n\nGroups list:\n";
$register = new Register();
echo print_r($register->listGroups());

//Test méthode Register::listUsers() :
echo "\n\nUsers list:\n";
$register = new Register();
echo print_r($register->listUsers());

//Test méthode Register::addGroups() :
$name = "other";
$register = new Register();
$register->addGroups($name);
echo print_r($register->listGroups());

//Test méthode Register::addUsers() :
//Elle sera testée via le formulaire de app.php

