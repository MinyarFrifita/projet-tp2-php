<?php
require_once 'Autoloader.php';
Autoloader::register();
session_start();

if (!Auth::isAuthenticated() || !Auth::isAdmin()) {
    header('Location: listSections.php');
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: listSections.php');
    exit;
}

$sectionId = (int)$_GET['id'];
$sectionRepo = new SectionRepository();
$section = $sectionRepo->findById($sectionId);

if (!$section) {
    header('Location: listSections.php');
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'designation' => $_POST['designation'] ?? '',
        'description' => $_POST['description'] ?? ''
    ];

    if (empty($data['designation'])) {
        $error = 'Designation is required';
    } else {
        if ($sectionRepo->update($sectionId, $data)) {
            $success = 'Section updated successfully!';
            $section = $sectionRepo->findById($sectionId); // Refresh data
        } else {
            $error = 'Failed to update section';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Section</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Students Management System</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="listET.php">Students</a></li>
                    <li class="nav-item"><a class="nav-link active" href="listSections.php">Sections</a></li>
                </ul>
                <span class="navbar-text me-3">Hello, <?= htmlspecialchars(Auth::getUser()['username']) ?></span>
                <a href="logout.php" class="btn btn-outline-light">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="mb-4">Edit Section</h2>
        
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="mb-3">
                <label for="designation" class="form-label">Designation</label>
                <input type="text" class="form-control" id="designation" name="designation" 
                       value="<?= htmlspecialchars($section['designation']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?= htmlspecialchars($section['description']) ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Section</button>
            <a href="listSections.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
