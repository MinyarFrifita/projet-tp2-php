<?php
require_once 'Autoloader.php';
Autoloader::register();
session_start();

if (!Auth::isAuthenticated() || !Auth::isAdmin()) {
    header('Location: listET.php');
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
$sections = $sectionRepo->findAll();

if (!$student) {
    header('Location: listET.php');
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => $_POST['name'] ?? '',
        'birthday' => $_POST['birthday'] ?? '',
        'section_id' => $_POST['section_id'] ?? null
    ];

    if (empty($data['name'])) {
        $error = 'Name is required';
    } else {
        if ($studentRepo->update($studentId, $data)) {
            $success = 'Student updated successfully!';
            $student = $studentRepo->findById($studentId); // Refresh data
        } else {
            $error = 'Failed to update student';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
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
        <h2 class="mb-4">Edit Student</h2>
        
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" 
                       value="<?= htmlspecialchars($student['name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="birthday" class="form-label">Birthday</label>
                <input type="date" class="form-control" id="birthday" name="birthday" 
                       value="<?= htmlspecialchars($student['birthday']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="section_id" class="form-label">Section</label>
                <select class="form-select" id="section_id" name="section_id" required>
                    <option value="">Select Section</option>
                    <?php foreach ($sections as $section): ?>
                        <option value="<?= $section['id'] ?>" 
                            <?= $section['id'] == $student['section_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($section['designation']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Student</button>
            <a href="listET.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
