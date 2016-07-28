<link rel="stylesheet" href="style/dracula.css">
<style>
    pre
    {
        position:fixed;
        padding:0;
        margin:0;

        top:0;
        left:0;

        width: 100%;
        height: 100%;
    }
</style>

<?php
$id = $_REQUEST["paste"];

$url = "pastes/".$id.".csharp"; //TODO: File ending should be "*.cs" (optional)

$content = file_get_contents($url);

echo '<pre><code class="cs">'.$content.'</code></pre>';
?>
<script type="application/javascript" src="js/highlight.pack.js" ></script>
<script>hljs.initHighlightingOnLoad();</script>