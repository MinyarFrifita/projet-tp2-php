<?php
require_once '../Autoloader.php';
Autoloader::register();

class Student {
    public static function getAll() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM student");
        return $stmt->fetchAll();
    }

    public static function getById($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM student WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
?>