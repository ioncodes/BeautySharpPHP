<link rel="stylesheet" href="style/dracula.css">
<link rel="stylesheet" href="style/style.css">
<link rel="stylesheet" href="css/perfect-scrollbar.min.css">

<?php
$id = $_REQUEST["paste"];

$url = "pastes/".$id.".csharp"; //TODO: File ending should be "*.cs" (optional)

$content = file_get_contents($url);

echo '<pre><code class="cs">'.$content.'</code></pre>';
?>
<!--<script type="application/javascript" src="js/jquery-3.1.0.min.js" ></script>-->
<script type="application/javascript" src="js/highlight.pack.js" ></script>
<script type="application/javascript" src="js/perfect-scrollbar.min.js" ></script>
<script>
    hljs.initHighlightingOnLoad();
    var el = document.querySelector('pre');
    Ps.initialize(el);
</script>