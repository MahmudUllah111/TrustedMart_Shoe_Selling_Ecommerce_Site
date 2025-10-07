<?php
include 'connection.php'; // make sure path is correct

$conn = OpenCon();

echo "✅ Connected to database successfully!";

CloseCon($conn);
?>
