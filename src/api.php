<script src="js/highlight.pack.js" type="application/javascript" ></script>

<?php
$servername = "beautysharp";
$username = "bsharpapi";
$password = "tTLtHXG232FHvLTK";

$conn = mysqli_connect($servername, $username, $password);

if ($conn->connect_error) {
    die("Server down"); // srsly?
}

// let's have some fun...

if(isset($_POST["addsource"]) && isset($_POST["token"])) { // everything fine
    $source = $_POST['addsource'];
    $token = $_POST['token'];
    $source = "Console.Write('Hello World');"; // testing, dev...
    echo $source;

    exit();
}
else
{
    die("Unauthorized"); // Fuck you!
}