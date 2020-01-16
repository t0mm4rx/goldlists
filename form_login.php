<?php
include_once('./config.php');
$url = "$global_url/api.php?service=signin&password=" . sha1($_POST['password']) . "&login=" . $_POST["login"];
$request = json_decode(file_get_contents($url));

if ($request->code == 1)
{
    $data = json_decode($request->message);
    setcookie("token", $data->token, time() + 30 * 24 * 60 * 60);
    setcookie("id", $data->id, time() + 30 * 24 * 60 * 60);
    header("Location: lists.php");
}
else {
    header("Location: index.php?error=" . $request->message);
}
