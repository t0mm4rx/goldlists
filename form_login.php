<?php
$url = "http://localhost/goldlists/api.php?service=signin&password=" . sha1($_POST['password']) . "&login=" . $_POST["login"];
$request = json_decode(file_get_contents($url));

if ($request->code == 1)
{
    header("Location: lists.php");
}
else {
    header("Location: index.php?error=" . $request->message);
}
