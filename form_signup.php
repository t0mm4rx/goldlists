<?php
include_once('./config.php');
$url = "$global_url/api.php?service=signup&password=" . sha1($_POST['password']) . "&login=" . $_POST["login"] . "&mail=" .  $_POST["mail"];
$request = json_decode(file_get_contents($url));

if ($request->code == 1)
    header("Location: index.php?login=" . $_POST["login"]);
else
    header("Location: index.php?error=" . $request->message);
?>
