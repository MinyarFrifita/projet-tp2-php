<?php
require_once 'Autoloader.php';
Autoloader::register();
session_start();

Auth::logout();
header('Location: login.php');
exit;
