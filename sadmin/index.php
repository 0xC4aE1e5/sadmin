<?php
require "lib.php";
// get the http basic password
$password = $_SERVER['PHP_AUTH_PW'];
$server_pass = strip_tags(file_get_contents("password.php"));

if ($password != $server_pass) {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    die("invalid password");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sadmin</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>sadmin</h1>
    <p>You have logged in. You are ready for the dashboard.</p>
    <details>
        <summary>Upload a website</summary>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file" accept=".zip,application/zip">
            <input type="submit" value="Upload">
        </form>
    </details>
    <details>
        <summary>Memory</summary>
        <?php
        $ramdata = get_ram();
        echo "Total: " . $ramdata[0] . "<br>";
        echo "Available: " . $ramdata[1] . "<br>";
        ?>
    </details>
</body>

</html>