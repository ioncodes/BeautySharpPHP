<script src="js/highlight.pack.js" type="application/javascript" ></script>

<?php
$hostname = "localhost";
$dbname = "beautysharp";
$username = "bsharpapi";
$password = "tTLtHXG232FHvLTK";

$conn = mysqli_connect($hostname, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Server down"); // srsly?
}

// let's have some fun...

if(isset($_POST['addsource']) && isset($_POST['token'])) { // everything fine
    $source = $_POST['addsource'];
    $token = $_POST['token'];

    $stmt = $conn->prepare("SELECT * FROM tokens WHERE token=?");
    $stmt->bind_param(1, $bToken);

    $bToken = $token;

    $result = $stmt->execute();

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