<?php
// Purpose: initialize database handle ($db)
$dbtype = 'mysql';
$dbuser = 'ssu9'; $dbpass = 'uSfiKkAr'; $dbname = 'ssu9'; $dbhost = 'localhost'; $dsn = "$dbtype:host=$dbhost;dbname=$dbname"; 
try {
    $db = new PDO($dsn, $dbuser, $dbpass);
}
catch (PDOException $e) {
    print "DB Connection Error!: " . $e->getMessage();
    die();
} ?>
