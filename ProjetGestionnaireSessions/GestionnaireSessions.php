<?php

class GestionnaireSessions
{
    //on a choisit de faire des méthodes statiques car on veut conserver tout après le refresh de la page
    public static function init() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // ON a choisit d mplementer ici la gestion de numbre of visits pour raison d encapsulation
    public static function incrementVisites() {
        self::init();
        if (!isset($_SESSION["visites"])) {
            $_SESSION["visites"] = 0;
        }
        else{
            $_SESSION['visites'] ++;
        }
    }

    // Récupération du compteur
    public static function getVisites() {
        self::init();
        if (!isset($_SESSION["visites"])) {
            return 0;
        }
        return $_SESSION['visites'];
    }

    // Réinitialisation de la session
    public static function reset() {
        self::init();
        $_SESSION = [];
        session_destroy();
        // Redirection pour éviter la résoumission car en refresh parfois la méthode POST serait envoyé une autre fois
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}