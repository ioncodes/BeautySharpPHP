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
            $id = uniqid(rand(), true) . '.csharp';
            $path = './pastes/'.$id;

            if(file_put_contents($path, $source) != false) {
                $stmt = $pdo->prepare("SELECT pastes FROM tokens WHERE token=?");
                $stmt->execute(array($token));

                $result = $stmt->fetch();
                $pastes = $result["pastes"];

                if($pastes == "") {
                    $pastes = str_replace(".csharp", "", $id);
                } else {
                    $pastes = $pastes.",".str_replace(".csharp", "", $id);
                }

                $stmt = $pdo->prepare("UPDATE tokens SET pastes=? WHERE token=?");
                $stmt->execute(array($pastes, $token));

                $url = "http://www.ioncodes.com/BeautySharp/?paste=".str_replace(".csharp", "", $id);
                echo $url;
                exit();
            } else {
                die("Error creating file.");
            }
        }
        else {
            die("Token does not exist!");
        }
    }
    else {
        die("Wrong request.");
    }
} catch (PDOException $e) {
    die("DB Error.");
}