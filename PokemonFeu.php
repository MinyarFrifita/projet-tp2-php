<?php
require_once 'Autoloader.php';
Autoloader::register();
class PokemonFeu extends Pokemon {
    protected function applyTypeEffectiveness(Pokemon $target, $damage) {
        if ($target instanceof PokemonPlante) return $damage * 2;
        if ($target instanceof PokemonEau || $target instanceof PokemonFeu) return $damage * 0.5;
        return $damage;
    }
}