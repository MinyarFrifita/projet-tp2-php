<?php
require_once 'Autoloader.php';
Autoloader::register();
session_start();

if (!Auth::isAuthenticated() || !Auth::isAdmin()) {
    header('Location: listET.php');
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: listET.php');
    exit;
}

$studentId = (int)$_GET['id'];
$studentRepo = new StudentRepository();

if ($studentRepo->delete($studentId)) {
    $_SESSION['success'] = 'Student deleted successfully';
} else {
    $_SESSION['error'] = 'Failed to delete student';
}

header('Location: listET.php');
exit;
