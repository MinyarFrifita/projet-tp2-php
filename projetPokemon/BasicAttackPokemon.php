<?php
require_once '../Autoloader.php';
Autoloader::register();
class BasicAttackPokemon implements AttackPokemon {
    private $attackMinimal;
    private $attackMaximal;
    private $specialAttack;
    private $probabilitySpecialAttack;

    public function __construct($attackMinimal, $attackMaximal, $specialAttack, $probabilitySpecialAttack) {
        $this->attackMinimal = $attackMinimal;
        $this->attackMaximal = $attackMaximal;
        $this->specialAttack = $specialAttack;
        $this->probabilitySpecialAttack = $probabilitySpecialAttack;
    }

    public function calculateDamage() {
        $baseDamage = rand($this->attackMinimal, $this->attackMaximal);
        $isSpecial = rand(0, 100) <= $this->probabilitySpecialAttack;
        return $isSpecial ? $baseDamage * $this->specialAttack : $baseDamage;
    }

    public function getAttackMinimal() {
        return $this->attackMinimal;
    }

    public function getAttackMaximal() {
        return $this->attackMaximal;
    }

    public function getSpecialAttack() {
        return $this->specialAttack;
    }

    public function getProbabilitySpecialAttack() {
        return $this->probabilitySpecialAttack;
    }
}