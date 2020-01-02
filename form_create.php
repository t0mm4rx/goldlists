<?php
$url = "http://localhost:8888/api.php?service=create_list&title=" . $_GET["title"] . "&subtitle=" . $_GET["subtitle"] . "&id_folder=" . $_GET["id_folder"];
$request = json_decode(file_get_contents($url));

if ($request->code == 1)
    header("Location: lists.php");
else
    header("Location: lists.php?error=" . $request->message);
