<?php
$smtp_server = "smtp.gmail.com";
$smtp_port = 25;

$connection = fsockopen($smtp_server, $smtp_port, $errno, $errstr, 10);
if (!$connection) {
    echo "Connection failed: $errstr ($errno)\n";
} else {
    echo "Connection to $smtp_server on port $smtp_port successful.\n";
    fclose($connection);
}
