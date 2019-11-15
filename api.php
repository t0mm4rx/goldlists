<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    header('Content-Type: application/json');
    $db = null;
    $service = $_GET["service"];
    switch ($service) {
        case 'signin':
            signin($_GET["login"], $_GET["password"]);
            break;
        case 'signup':
            signup($_GET["mail"], $_GET["login"], $_GET["password"]);
            break;
        case 'listing':
            listing($_GET["id_user"], $_GET["id_folder"]);
            break;
        case 'open_list':
            open_list($_GET["id"]);
            break;
        default:
            output(2, "This service doesn't exist");
    }

    function listing($id_user, $id_folder)
    {
        $lists = [];
        global $db;
        connect_db();
        $id_user = mysqli_real_escape_string($db, $id_user);
        $id_folder = mysqli_real_escape_string($db, $id_folder);
        $sql = "SELECT * FROM `lists` WHERE `id_user` = '$id_user' AND `id_folder` = '$id_folder'";
        $result = $db->query($sql);
        while ($row = $result->fetch_array(MYSQLI_ASSOC))
            $lists[] = $row;
        output(1, json_encode($lists));
    }

    function open_list($id)
    {
        global $db;
        connect_db();
        $id = mysqli_real_escape_string($db, $id);
        $sql = "SELECT * FROM `lists` WHERE `id` = '$id'";
        $result = $db->query($sql);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        output(1, json_encode($row));
    }

    function signup($mail, $login, $password)
    {
        global $db;
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            output(0, "$mail is not a valid email address");
        }
        connect_db();
        $mail = mysqli_real_escape_string($db, $mail);
        $login = mysqli_real_escape_string($db, $login);
        $password = mysqli_real_escape_string($db, $password);
        $ip = $_SERVER['REMOTE_ADDR'];
        $check = "SELECT * FROM `users` WHERE `login` = '$login' OR `mail` = '$mail'";
        $check_result = $db->query($check);
        if ($check_result->num_rows > 0) {
            output(0, "Login or mail already exists");
        }
        $query = "INSERT INTO `users`(`login`, `password`, `mail`, `ip`) VALUES ('$login', '$password', '$mail', '$ip')";
        if (!$db->query($query)) {
            output(2, "Error during request execution");
        }
        output(1, "Account has been successfully created");
    }

    function signin($login, $password)
    {
        global $db;
        connect_db();
        $login = mysqli_real_escape_string($db, $login);
        $password = mysqli_real_escape_string($db, $password);
        $check = "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'";
        $check_result = $db->query($check);
        if ($check_result->num_rows > 0) {
            output(1, "Connected");
        }
        output(0, "Wrong login or password");
    }

    function output($code, $message)
    {
        $arr = ["code" => $code, "message" => $message];
        print(json_encode($arr));
        exit();
    }

    function connect_db()
    {
        global $db;
        $db = mysqli_connect("127.0.0.1", "root", "root", "goldlists");
        if (!$db) {
            output(2, "No connection to database");
        }
    }
