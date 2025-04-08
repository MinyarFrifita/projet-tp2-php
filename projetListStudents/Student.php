<?php
require_once 'Autoloader.php';
Autoloader::register();

class Student {
    private static $repository;

    public static function init() {
        self::$repository = new StudentRepository();
    }

    public static function getAll() {
        return self::$repository->findAll();
    }

    public static function getById($id) {
        return self::$repository->findById($id);
    }

    public static function create($data) {
        return self::$repository->create($data);
    }

    public static function update($id, $data) {
        return self::$repository->update($id, $data);
    }

    public static function delete($id) {
        return self::$repository->delete($id);
    }

    public static function findBySection($sectionId) {
        return self::$repository->findBySection($sectionId);
    }
}

// Initialize the repository
Student::init();
