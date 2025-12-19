<?php
require_once 'functions.php'; 
require_once 'header.php'; 



$students = readStudents();
?>

<h2>Registered Students</h2>

<?php if (empty($students)): ?>
    <p>No student records found.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Skills</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
            <tr>
                <td><?php echo htmlspecialchars($student['name']); ?></td>
                <td><?php echo htmlspecialchars($student['email']); ?></td>
                <td>
                    <?php 
                        
                        echo '<pre>' . htmlspecialchars(print_r($student['skills'], true)) . '</pre>'; 
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php
require_once 'footer.php';
?>