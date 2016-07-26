<script src="js/highlight.pack.js" type="application/javascript" ></script>

<?php
$hostname = "localhost";
$dbname = "beautysharp";
$username = "bsharpapi";
$password = "tTLtHXG232FHvLTK";

try {
    $pdo = new PDO('mysql:host=' . $hostname . ';dbname=' . $dbname, $username, $password, array(PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    // let's have some fun...

    if(isset($_POST['addsource']) && isset($_POST['token'])) { // everything fine
        $source = $_POST['addsource'];
        $token = $_POST['token'];

        $stmt = $pdo->prepare("SELECT * FROM tokens WHERE token=?");
        $stmt->execute(array($token));

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($result) {
            $source = "Console.Write('Hello World');"; // testing, dev...

            echo $source;

            exit();
        }
        else {
            die("Token does not exist!");
        }
    }
} catch (PDOException $e) {
    throw new PDOException("Error  : " .$e->getMessage());
}