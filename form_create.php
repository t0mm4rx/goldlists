<?php
include_once('./config.php');
$url = "$global_url/api.php?service=create_list&title=" . urlencode($_GET["title"]) . "&subtitle=" . urlencode($_GET["subtitle"]) . "&id_folder=" . urlencode($_GET["id_folder"]) . "&id_user=" . $_GET["id_user"];
$request = json_decode(file_get_contents($url));

if ($request->code == 1)
    header("Location: list.php?id=" . $request->message);
else
    header("Location: lists.php?error=" . $request->message);
