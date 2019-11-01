<?php
$url = "http://localhost/goldlists/api.php?service=signup&password=" . $_POST['password'] . "&login=" . $_POST["login"] . "&mail=" .  $_POST["mail"];
$request = json_decode(file_get_contents($url));

if ($request->code == 1)
{
    header("Location: lists.php");
}
else {
    header("Location: index.php?error=" . $request->message);
}
?>
