<!-- download.php -->
<?php
$file = isset($_GET['file']) ? $_GET['file'] : null;

if (!$file || !file_exists($file)) {
    echo "File not found.";
    exit;
}

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' . basename($file));
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($file));
readfile($file);
exit;
?>
