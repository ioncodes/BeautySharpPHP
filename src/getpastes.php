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

    if(isset($_GET['token'])) { // get pastes
        $token = $_GET['token'];

        $stmt = $pdo->prepare("SELECT * FROM tokens WHERE token=?");
        $stmt->execute(array($token));

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo $result;

        exit();
    }
    else {
        die("Wrong request.");
    }
} catch (PDOException $e) {
    throw new PDOException("Error  : " .$e->getMessage());
}