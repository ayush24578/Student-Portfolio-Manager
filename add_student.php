<?php
require_once 'functions.php';
require_once 'header.php';

$message = '';
$name = $email = $skills = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $skills = $_POST['skills'] ?? ''; 

    if (empty($name) || empty($email) || empty($skills)) {
        $message = '<p class="error">All fields are required.</p>';
    } elseif (!validateEmail($email)) {
        $message = '<p class="error">Invalid email format.</p>';
    } else {
        $cleanedSkills = cleanSkills($skills);
        $skillsArray = explode(',', $cleanedSkills);
        $skillsArray = array_filter($skillsArray, 'strlen');

        if (saveStudent($name, $email, $skillsArray)) {
            $message = '<p class="success">Student information saved successfully!</p>';
            $name = $email = $skills = '';
        } else {
            $message .= '<p class="error">Failed to save student information.</p>';
        }
    }
}
?>

<h2>Add Student Information</h2>
<?php echo $message; ?>

<form method="POST" action="add_student.php">
    <div>
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
    </div>
    <div>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
    </div>
    <div>
        <label for="skills">Skills (comma-separated):</label><br>
        <input type="text" id="skills" name="skills" value="<?php echo htmlspecialchars($skills); ?>" required>
    </div>
    <br>
    <button type="submit">Save Student</button>
</form>

<?php
require_once 'footer.php';
?>