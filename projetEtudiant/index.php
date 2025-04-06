<?php
// index.php
require_once '../Autoloader.php';
Autoloader::register();

$etudiants = [
    new Etudiant("Aymen", [11, 13, 18, 7, 10, 13, 2, 5, 1]),
    new Etudiant("Skander", [15, 9, 8, 16])
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Étudiants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .student-container {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .student-card {
            width: 200px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .student-name {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 10px;
            text-align: center;
        }

        .notes-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .notes-list li {
            padding: 8px;
            margin-bottom: 5px;
            text-align: center;
            font-size: 1rem;
            border-radius: 4px;
        }

        .average-box {
            margin-top: 10px;
            padding: 10px;
            background-color: #e6f3ff;
            color: #333;
            text-align: center;
            border-radius: 4px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Liste des Étudiants</h1>
        <div class="student-container">
            <?php foreach ($etudiants as $etudiant): ?>
                <?php $etudiant->afficherNotes(); ?>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>