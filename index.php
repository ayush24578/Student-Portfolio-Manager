<?php
require_once 'functions.php';
require_once 'header.php';
?>

<h2>Welcome to the Student Portfolio Manager!</h2>
<p>This application demonstrates key PHP features including functions, arrays, string handling, file handling, error handling, include/require usage, and a validated file upload feature.</p>

<h3>Navigation:</h3>
<ul>
    <li><a href="add_student.php">Add Student Info</a> - Register a new student.</li>
    <li><a href="upload.php">Upload Portfolio File</a> - Upload a portfolio document.</li>
    <li><a href="students.php">View Students</a> - See the list of registered students.</li>
</ul>

<?php
require_once 'footer.php';
?>