<?php
require_once 'Autoloader.php';
Autoloader::register();
session_start();

if (!Auth::isAuthenticated()) {
    header('Location: login.php');
    exit;
}

$sectionRepo = new SectionRepository();
$sections = $sectionRepo->findAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sections List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
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
        <h2 class="mb-4">List of Sections</h2>
        
        <?php if (Auth::isAdmin()): ?>
        <div class="mb-3">
            <a href="addSection.php" class="btn btn-success">Add New Section</a>
        </div>
        <?php endif; ?>

        <table id="sectionsTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Designation</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sections as $section): ?>
                    <tr>
                        <td><?= htmlspecialchars($section['id']) ?></td>
                        <td><?= htmlspecialchars($section['designation']) ?></td>
                        <td><?= htmlspecialchars($section['description']) ?></td>
                        <td>
                            <a href="sectionStudents.php?id=<?= $section['id'] ?>" class="btn btn-info btn-sm">View Students</a>
                            <?php if (Auth::isAdmin()): ?>
                                <a href="editSection.php?id=<?= $section['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="deleteSection.php?id=<?= $section['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#sectionsTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'csv', 'pdf'
                ]
            });
        });
    </script>
</body>
</html>
