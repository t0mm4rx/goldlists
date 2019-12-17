<?php
$url = "http://localhost:8888/api.php?service=signup&password=" . sha1($_POST['password']) . "&login=" . $_POST["login"] . "&mail=" .  $_POST["mail"];
$request = json_decode(file_get_contents($url));

if ($request->code == 1)
{
    header("Location: lists.php");
}
else {
    header("Location: index.php?error=" . $request->message);
}
?>
