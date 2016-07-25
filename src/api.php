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

if(isset($_POST['addsource']) && isset($_POST['token'])) { // everything fine
    $source = $_POST['addsource'];
    $token = $_POST['token'];

    $result = mysqli_query($conn, "SELECT ".$token." FROM tokens"); // check token exists
    if($result) {
        $source = "Console.Write('Hello World');"; // testing, dev...
        echo $source;

        exit();
    }
    else {
        die("Token does not exist!");
    }
}
else
{
    die("Wrong POST"); // Fuck you!
}