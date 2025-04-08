<?php
require_once 'Autoloader.php';
Autoloader::register();
session_start();

if (!Auth::isAuthenticated()) {
    header('Location: login.php');
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: listET.php');
    exit;
}

$studentId = (int)$_GET['id'];
$studentRepo = new StudentRepository();
$sectionRepo = new SectionRepository();

$student = $studentRepo->findById($studentId);

if (!$student) {
    header('Location: listET.php');
    exit;
}

$section = $sectionRepo->findById($student['section_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
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
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Student Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">ID:</div>
                            <div class="col-md-8"><?= htmlspecialchars($student['id']) ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Name:</div>
                            <div class="col-md-8"><?= htmlspecialchars($student['name']) ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Birthday:</div>
                            <div class="col-md-8"><?= htmlspecialchars($student['birthday']) ?></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4 fw-bold">Section:</div>
                            <div class="col-md-8">
                                <?= htmlspecialchars($section['designation'] ?? 'N/A') ?>
                                <?php if ($section): ?>
                                    <small class="text-muted d-block"><?= htmlspecialchars($section['description']) ?></small>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="listET.php" class="btn btn-secondary">Back to List</a>
                            <?php if (Auth::isAdmin()): ?>
                                <a href="editStudent.php?id=<?= $student['id'] ?>" class="btn btn-primary">Edit</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Student Photo</h5>
                    </div>
                    <div class="card-body text-center">
                        <?php if (!empty($student['image'])): ?>
                            <img src="<?= htmlspecialchars($student['image']) ?>" alt="Student Photo" class="img-fluid rounded">
                        <?php else: ?>
                            <div class="text-muted">No photo available</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
