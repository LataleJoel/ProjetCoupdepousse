<?php
define('__COUPDEPOUCE__','');
require_once 'framework\application.php';
$application=Application::getInstance('application\configuration.ini');
$config=Configuration::getInstance();
$application->setControleurParDefaut('index');
$application->utiliserAuthentification();
$application->executer();
