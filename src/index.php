<link rel="stylesheet" href="style/dracula.css">

<?php
$id = $_REQUEST["paste"];

$url = "pastes/".$id.".csharp"; //TODO: File ending should be "*.cs" (optional)

$content = file_get_contents($url);

$colored_content = $content;

echo '<pre><code class="cs">'.$colored_content.'</code></pre>';
?>
<script type="application/javascript" src="js/highlight.pack.js" ></script>
<script>hljs.initHighlightingOnLoad();</script>