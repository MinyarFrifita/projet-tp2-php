<?php
require_once 'Autoloader.php';
Autoloader::register();
session_start();

if (!Auth::isAuthenticated()) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: listSections.php');
    exit;
}

$sectionId = (int)$_GET['id'];
$sectionRepo = new SectionRepository();
$studentRepo = new StudentRepository();

$section = $sectionRepo->findById($sectionId);
$students = $studentRepo->findBySection($sectionId);

if (!$section) {
    header('Location: listSections.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students in Section</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Students Management System</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="listET.php">Students</a></li>
                    <li class="nav-item"><a class="nav-link" href="listSections.php">Sections</a></li>
                </ul>
                <span class="navbar-text me-3">Hello, <?= htmlspecialchars(Auth::getUser()['username']) ?></span>
                <a href="logout.php" class="btn btn-outline-light">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="mb-4">Students in Section: <?= htmlspecialchars($section['designation']) ?></h2>
        
        <a href="listSections.php" class="btn btn-secondary mb-3">Back to Sections</a>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Birthday</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= htmlspecialchars($student['id']) ?></td>
                        <td><?= htmlspecialchars($student['name']) ?></td>
                        <td><?= htmlspecialchars($student['birthday']) ?></td>
                        <td>
                            <a href="detailEtudiant.php?id=<?= $student['id'] ?>" class="btn btn-primary btn-sm">Details</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
