<?php
require_once 'Autoloader.php';
Autoloader::register();

function simulateCombat(Pokemon $p1, Pokemon $p2) {
    $rounds = [];
    $round = 1;

    while (!$p1->isDead() && !$p2->isDead()) {
        $roundData = [
            'round' => $round,
            'p1_name' => $p1->getName(),
            'p2_name' => $p2->getName(),
            'p1_hp' => $p1->getHp(),
            'p2_hp' => $p2->getHp(),
            'p1_attack' => '',
            'p2_attack' => '',
            'p1_url' => $p1->getUrl(),
            'p2_url' => $p2->getUrl()
        ];

        // Pokémon 1 attacks Pokémon 2
        $damage = $p1->attack($p2);
        $roundData['p1_attack'] = "{$p1->getName()} attacks {$p2->getName()} for $damage damage!";
        $roundData['p1_hp_after'] = $p1->getHp();
        $roundData['p2_hp_after'] = $p2->getHp();

        // Pokémon 2 attacks Pokémon 1 (if not dead)
        if (!$p2->isDead()) {
            $damage = $p2->attack($p1);
            $roundData['p2_attack'] = "{$p2->getName()} attacks {$p1->getName()} for $damage damage!";
            $roundData['p1_hp_after'] = $p1->getHp();
            $roundData['p2_hp_after'] = $p2->getHp();
        }

        $rounds[] = $roundData;
        $round++;
    }

    $winner = $p1->isDead() ? $p2 : $p1;
    return ['rounds' => $rounds, 'winner' => $winner->getName()];
}

// Test the implementation
$attack1 = new BasicAttackPokemon(10, 20, 2, 50);
$attack2 = new BasicAttackPokemon(15, 25, 1.5, 30);

// Use .png images instead of .jpg
$charizard = new PokemonFeu("Charizard", "charizard.png", 100, $attack1);
$blastoise = new PokemonEau("Blastoise", "blastoise.png", 100, $attack2);
$venusaur = new PokemonPlante("Venusaur", "venusaur.png", 100, $attack1);

// Simulate combats
$combat1 = simulateCombat(clone $charizard, clone $blastoise);
$combat2 = simulateCombat(clone $blastoise, clone $venusaur);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Combat Simulation</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .pokemon-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            background-color: #f8f9fa;
        }
        .pokemon-card img {
            max-width: 100px;
            height: auto;
        }
        .combat-round:nth-child(odd) {
            background-color: #ffe6e6; /* Light pink for odd rounds */
        }
        .combat-round:nth-child(even) {
            background-color: #e6ffed; /* Light green for even rounds */
        }
        .combat-round {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 15px;
        }
        .combat-round img {
            max-width: 80px;
            height: auto;
        }
        .winner {
            font-weight: bold;
            color: #28a745;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Pokémon Info Section -->
        <h2 class="mb-4">Pokémon Info</h2>
        <div class="row">
            <!-- Charizard -->
            <div class="col-md-6">
                <div class="pokemon-card d-flex p-3">
                    <div class="me-3">
                        <img src="<?php echo $charizard->getUrl(); ?>" alt="<?php echo $charizard->getName(); ?>">
                    </div>
                    <div>
                        <h5><?php echo $charizard->getName(); ?></h5>
                        <p><strong>Points:</strong> <?php echo $charizard->getHp(); ?></p>
                        <p><strong>Min Attack Points:</strong> <?php echo $charizard->getAttackMinimal(); ?></p>
                        <p><strong>Max Attack Points:</strong> <?php echo $charizard->getAttackMaximal(); ?></p>
                        <p><strong>Special Attack:</strong> <?php echo $charizard->getSpecialAttack(); ?></p>
                        <p><strong>Probability Special Attack:</strong> <?php echo $charizard->getProbabilitySpecialAttack(); ?>%</p>
                    </div>
                </div>
            </div>
            <!-- Blastoise -->
            <div class="col-md-6">
                <div class="pokemon-card d-flex p-3">
                    <div class="me-3">
                        <img src="<?php echo $blastoise->getUrl(); ?>" alt="<?php echo $blastoise->getName(); ?>">
                    </div>
                    <div>
                        <h5><?php echo $blastoise->getName(); ?></h5>
                        <p><strong>Points:</strong> <?php echo $blastoise->getHp(); ?></p>
                        <p><strong>Min Attack Points:</strong> <?php echo $blastoise->getAttackMinimal(); ?></p>
                        <p><strong>Max Attack Points:</strong> <?php echo $blastoise->getAttackMaximal(); ?></p>
                        <p><strong>Special Attack:</strong> <?php echo $blastoise->getSpecialAttack(); ?></p>
                        <p><strong>Probability Special Attack:</strong> <?php echo $blastoise->getProbabilitySpecialAttack(); ?>%</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Combat 1: Fire vs Water -->
        <h2 class="mt-5 mb-4">Combat 1: Fire vs Water</h2>
        <?php foreach ($combat1['rounds'] as $round): ?>
            <div class="combat-round">
                <h5>Round <?php echo $round['round']; ?></h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <img src="<?php echo $round['p1_url']; ?>" alt="<?php echo $round['p1_name']; ?>">
                            <div class="ms-3">
                                <p><strong><?php echo $round['p1_name']; ?>:</strong> <?php echo $round['p1_hp']; ?> → <?php echo $round['p1_hp_after']; ?></p>
                                <p><?php echo $round['p1_attack']; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <img src="<?php echo $round['p2_url']; ?>" alt="<?php echo $round['p2_name']; ?>">
                            <div class="ms-3">
                                <p><strong><?php echo $round['p2_name']; ?>:</strong> <?php echo $round['p2_hp']; ?> → <?php echo $round['p2_hp_after']; ?></p>
                                <p><?php echo $round['p2_attack']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <p class="winner">The winner is: <?php echo $combat1['winner']; ?>!</p>

        <!-- Combat 2: Water vs Grass -->
        <h2 class="mt-5 mb-4">Combat 2: Water vs Grass</h2>
        <?php foreach ($combat2['rounds'] as $round): ?>
            <div class="combat-round">
                <h5>Round <?php echo $round['round']; ?></h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <img src="<?php echo $round['p1_url']; ?>" alt="<?php echo $round['p1_name']; ?>">
                            <div class="ms-3">
                                <p><strong><?php echo $round['p1_name']; ?>:</strong> <?php echo $round['p1_hp']; ?> → <?php echo $round['p1_hp_after']; ?></p>
                                <p><?php echo $round['p1_attack']; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <img src="<?php echo $round['p2_url']; ?>" alt="<?php echo $round['p2_name']; ?>">
                            <div class="ms-3">
                                <p><strong><?php echo $round['p2_name']; ?>:</strong> <?php echo $round['p2_hp']; ?> → <?php echo $round['p2_hp_after']; ?></p>
                                <p><?php echo $round['p2_attack']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <p class="winner">The winner is: <?php echo $combat2['winner']; ?>!</p>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>