<?php
// get the http basic password
$password = $_SERVER['PHP_AUTH_PW'];
$server_pass = strip_tags(file_get_contents("password.php"));

if ($password != $server_pass) {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    die("invalid password");
}

// get the file tmp_name
$file = $_FILES['file']['tmp_name'];

// unzip the file
$zip = new ZipArchive;
$res = $zip->open($file);
if ($res === TRUE) {
    $zip->extractTo('..');
} else {
    die('failed');
}

echo "<pre>Uploaded site! Go to / to see it.</pre>";
