<?php
require_once 'Autoloader.php';
Autoloader::register();
session_start();

if (!Auth::isAuthenticated() || !Auth::isAdmin()) {
    header('Location: listSections.php');
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: listSections.php');
    exit;
}

$sectionId = (int)$_GET['id'];
$sectionRepo = new SectionRepository();

if ($sectionRepo->delete($sectionId)) {
    $_SESSION['success'] = 'Section deleted successfully';
} else {
    $_SESSION['error'] = 'Failed to delete section';
}

header('Location: listSections.php');
exit;
