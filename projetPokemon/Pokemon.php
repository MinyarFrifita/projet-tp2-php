<?php

class Pokemon {
    protected $name;
    protected $url;
    protected $hp;
    protected $attackPokemon;

    public function __construct($name, $url, $hp, AttackPokemon $attackPokemon) {
        $this->name = $name;
        $this->url = $url;
        $this->hp = $hp;
        $this->attackPokemon = $attackPokemon;
    }

    public function isDead() {
        return $this->hp <= 0;
    }

    public function attack(Pokemon $target) {
        $damage = $this->attackPokemon->calculateDamage();
        $damage = $this->applyTypeEffectiveness($target, $damage);
        $target->hp -= $damage;
        if ($target->hp < 0) $target->hp = 0;
        return $damage;
    }

    protected function applyTypeEffectiveness(Pokemon $target, $damage) {
        return $damage; // Default: no type modification
    }

    // Public getters for AttackPokemon properties
    public function getAttackMinimal() {
        return $this->attackPokemon->getAttackMinimal();
    }

    public function getAttackMaximal() {
        return $this->attackPokemon->getAttackMaximal();
    }

    public function getSpecialAttack() {
        return $this->attackPokemon->getSpecialAttack();
    }

    public function getProbabilitySpecialAttack() {
        return $this->attackPokemon->getProbabilitySpecialAttack();
    }

    public function getName() { return $this->name; }
    public function getHp() { return $this->hp; }
    public function getUrl() { return $this->url; }
    public function setHp($hp) { $this->hp = $hp; }
}