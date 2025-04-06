<?php
require_once '../Autoloader.php';
Autoloader::register();

// Get the student ID from the query parameter
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid student ID");
}
$studentId = (int)$_GET['id'];

// Fetch the student details using the Student class
$student = Student::getById($studentId);

if (!$student) {
    die("Student not found");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Student Details</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($student['name']); ?></h5>
                <p class="card-text"><strong>ID:</strong> <?php echo htmlspecialchars($student['id']); ?></p>
                <p class="card-text"><strong>Birthday:</strong> <?php echo htmlspecialchars($student['birthday']); ?></p>
                <a href="index.php" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>