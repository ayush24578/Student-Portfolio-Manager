<?php
define('STUDENTS_FILE', 'students.txt');

define('UPLOAD_DIR', 'uploads/');
if (!is_dir(UPLOAD_DIR)) {
    mkdir(UPLOAD_DIR, 0777, true);
}

/**
 * Required Custom Function: Formats the student name (e.g., Title Case).
 * @param string $name
 * @return string
 */

function formatName($name) {
    return ucwords(trim($name));
}

/**
 * Required Custom Function: Validates the email address.
 * @param string $email
 * @return bool
 */

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Required Custom Function: Cleans and prepares skills string for array conversion.
 * @param string $string Comma-separated skills string.
 * @return string Cleaned string.
 */
function cleanSkills($string) {
    $cleaned = preg_replace('/\s*,\s*/', ',', $string);
    return trim($cleaned, ', ');
}

/**
 * Required Custom Function: Saves student info to students.txt.
 * @param string $name
 * @param string $email
 * @param array $skillsArray
 * @return bool True on success, false on failure.
 */
function saveStudent($name, $email, $skillsArray) {
    try {
        $skillsString = implode(',', $skillsArray);
        $dataLine = formatName($name) . '|' . $email . '|' . $skillsString . "\n";

        if (file_put_contents(STUDENTS_FILE, $dataLine, FILE_APPEND | LOCK_EX) === false) {
            throw new Exception("Could not write to file " . STUDENTS_FILE);
        }
        return true;
    } catch (Exception $e) {
        echo '<p class="error">File Save Error: ' . $e->getMessage() . '</p>';
        return false;
    }
}

/**
 * Required Custom Function: Handles portfolio file upload.
 * @param array $file $_FILES['portfolio'] array.
 * @return string|bool New filename on success, false on failure.
 */
function uploadPortfolioFile($file) {
    $maxSize = 2 * 1024 * 1024; 
    $allowedTypes = ['application/pdf', 'image/jpeg', 'image/png'];

    try {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("File upload failed with error code: " . $file['error']);
        }

        if ($file['size'] > $maxSize) {
            throw new Exception("File size exceeds 2MB limit.");
        }

        if (!in_array($file['type'], $allowedTypes)) {
            throw new Exception("Invalid file type. Only PDF, JPG, or PNG are allowed.");
        }

        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        $newFileName = uniqid('portfolio_') . '.' . $fileExtension;
        $targetPath = UPLOAD_DIR . $newFileName; 

        if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
            throw new Exception("Could not move uploaded file. Check permissions for " . UPLOAD_DIR);
        }

        return $newFileName;

    } catch (Exception $e) {
        echo '<p class="error">Upload Error: ' . $e->getMessage() . '</p>';
        return false;
    }
}

/**
 * Reads student data from the file.
 * @return array Array of student records.
 */
function readStudents() {
    $students = [];
    if (file_exists(STUDENTS_FILE)) { 
        $lines = file(STUDENTS_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            list($name, $email, $skillsString) = explode('|', trim($line));
            $students[] = [
                'name' => $name, 
                'email' => $email, 
                'skills' => explode(',', $skillsString), 
            ];
        }
    }
    return $students;
}
?>