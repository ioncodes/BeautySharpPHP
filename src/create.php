<?php
$hostname = "localhost";
$dbname = "beautysharp";
$username = "bsharpapi";
$password = "tTLtHXG232FHvLTK";

try {
    $pdo = new PDO('mysql:host=' . $hostname . ';dbname=' . $dbname, $username, $password, array(PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    // let's have some fun...

    if(isset($_GET['token']) && isset($_POST['source'])) { // create paste
        $source = $_POST['source'];
        $token = $_GET['token'];

        $stmt = $pdo->prepare("SELECT * FROM tokens WHERE token=?");
        $stmt->execute(array($token));

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($result) {
            $id = uniqid(rand(), true) . '.cs';
            $path = './pastes/'.$id;
            echo $path;

            if(file_put_contents($path, $source) != false) {
                echo "Done";
            } else {
                die("Error creating file.");
            }
            exit();
        }
        else {
            die("Token does not exist!");
        }
    }
    else {
        die("Wrong request.");
    }
} catch (PDOException $e) {
    throw new PDOException("Error  : " .$e->getMessage());
}