<script src="js/highlight.pack.js" type="application/javascript" ></script>

<?php
$servername = "localhost";
$username = "bsharpapi";
$password = "tTLtHXG232FHvLTK";

try {
    $conn = new PDO("mysql:host=$servername;dbname=beautysharp", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    die("Server down"); // srsly?
}


// let's have some fun...

if(isset($_POST["addsource"]) && isset($_POST["token"])) { // everything fine
    $source = $_POST['addsource'];
    $token = $_POST{'token'};
    $source = "Console.Write('Hello World');"; // testing, dev...
    echo $source;

    exit();
}
else
{
    die("Unauthorized"); // Fuck you!
}