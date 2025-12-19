<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portfolio Manager</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; margin: 20px; }
        header { background: #333; color: white; padding: 10px 0; text-align: center; }
        nav { margin: 10px 0; }
        nav a { margin-right: 15px; text-decoration: none; color: #333; border: 1px solid #ccc; padding: 5px 10px; }
        .container { max-width: 800px; margin: auto; padding: 20px; }
        .error { color: red; font-weight: bold; }
        .success { color: green; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <header>
        <h1>Student Portfolio Manager</h1>
    </header>
    <div class="container">
        <nav>
            <a href="index.php">Home</a>
            <a href="add_student.php">Add Student Info</a>
            <a href="upload.php">Upload Portfolio File</a>
            <a href="students.php">View Students</a>
        </nav>