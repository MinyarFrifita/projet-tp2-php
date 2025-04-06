
<?php
class Autoloader {
    public static function register() {
        spl_autoload_register(function ($class) {
            // Inclut la classe à partir du nom de la classe
            require_once $class . '.php';
        });
    }
}
?>