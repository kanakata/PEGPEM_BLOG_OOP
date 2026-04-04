<?php
session_start();
define("ROOT", dirname(__DIR__));
require_once ROOT . "/vendor/autoload.php";
use Router\Router;
Router::View();