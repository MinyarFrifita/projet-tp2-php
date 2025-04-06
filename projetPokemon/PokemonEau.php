<?php
require_once '../Autoloader.php';
Autoloader::register();
class PokemonEau extends Pokemon {
    protected function applyTypeEffectiveness(Pokemon $target, $damage) {
        if ($target instanceof PokemonFeu) return $damage * 2;
        if ($target instanceof PokemonEau || $target instanceof PokemonPlante) return $damage * 0.5;
        return $damage;
    }
}