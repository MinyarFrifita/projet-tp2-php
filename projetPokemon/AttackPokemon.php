<?php

interface AttackPokemon {
    public function calculateDamage();
    public function getAttackMinimal();
    public function getAttackMaximal();
    public function getSpecialAttack();
    public function getProbabilitySpecialAttack();
}