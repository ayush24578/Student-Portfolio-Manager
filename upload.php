<?php
require_once 'functions.php';
require_once 'header.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['portfolio']) && $_FILES['portfolio']['error'] === UPLOAD_ERR_OK) {
        $newFileName = uploadPortfolioFile($_FILES['portfolio']); 
        
        if ($newFileName) {
            $message = '<p class="success">File uploaded and renamed successfully as: ' . htmlspecialchars($newFileName) . '</p>';
            $message .= '<p>Stored inside: ' . UPLOAD_DIR . '</p>'; 
        }
        
    } else {
        $message = '<p class="error">Please select a file to upload.</p>';
    }
}
?>

<h2>Upload Portfolio File</h2>
<?php echo $message; ?>

<form method="POST" action="upload.php" enctype="multipart/form-data">
    <div>
        <label for="portfolio">Select File:</label><br>
        <input type="file" id="portfolio" name="portfolio" accept=".pdf,.jpg,.jpeg,.png" required>
        <p>Max size: 2MB | Only PDF, JPG, PNG allowed</p>
    </div>
    <br>
    <button type="submit">Upload File</button>
</form>

<?php
require_once 'footer.php';
?>