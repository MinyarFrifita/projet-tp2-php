<?php
require_once '../Autoloader.php';
Autoloader::register();

class PokemonPlante extends Pokemon {
    protected function applyTypeEffectiveness(Pokemon $target, $damage) {
        if ($target instanceof PokemonEau) return $damage * 2;
        if ($target instanceof PokemonPlante || $target instanceof PokemonFeu) return $damage * 0.5;
        return $damage;
    }
}