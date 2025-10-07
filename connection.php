<?php
function OpenCon()
{
    $dbhost = "sql105.infinityfree.com";
    $dbuser = "root";
    $dbpass = "Jvz45ZfoDOPSw";
    $db = "estorefinalDB";  

    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connection failed: %s\n" . $conn->error);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function CloseCon($conn)
{
    $conn->close();
}
?>
