<script src="js/highlight.pack.js" type="application/javascript" ></script>

<?php
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