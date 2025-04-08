<?php
class Auth {
    public static function login($username, $password) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            return true;
        }
        return false;
    }

    public static function logout() {
        unset($_SESSION['user']);
        session_destroy();
    }

    public static function isAuthenticated() {
        return isset($_SESSION['user']);
    }

    public static function isAdmin() {
        return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
    }

    public static function getUser() {
        return $_SESSION['user'] ?? null;
    }
}
