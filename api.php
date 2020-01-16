<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    header('Content-Type: application/json; charset=utf-8');
    include_once('./config.php');
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
        case 'remove_list':
            remove_list($_GET["id"]);
            break;
        case 'create_list':
            create_list($_GET["title"], $_GET["subtitle"], $_GET["id_folder"], $_GET["id_user"]);
            break;
        case 'update_list':
            update_list($_GET["id"], $_GET["page"]);
            break;
        case 'list_folder':
            list_folder($_GET["id_user"]);
            break;
        case 'change_folder':
            change_folder($_GET["id_folder"], $_GET["id"]);
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
        $sql = "SELECT * FROM `lists` WHERE `id_user` = '$id_user' AND `id_folder` LIKE '$id_folder'";
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
        $query = "INSERT INTO `users`(`login`, `password`, `mail`, `ip`, `token`) VALUES ('$login', '$password', '$mail', '$ip', '')";
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
        if ($check_result->num_rows > 0)
        {
          $user = $check_result->fetch_array(MYSQLI_ASSOC);
          $data = new DateTime();
          $token = sha1($data->getTimestamp() . $login . "MEOW" . $password);
          $id = $user["id"];
          $update_request = "UPDATE `users` SET `token` = '$token' WHERE `users`.`id` = $id;";
          $db->query($update_request);
          $result = [
            "token" => $token,
            "id" => $id
          ];
          output(1, json_encode($result));
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
        $db = mysqli_connect("127.0.0.1:8889", "root", "root", "goldlists");
        if (!$db) {
            output(2, "No connection to database");
        }
    }

    function remove_list($id)
    {
      global $db;
      connect_db();
      $id = mysqli_real_escape_string($db, $id);
      $check = "DELETE FROM `lists` WHERE `id` = '$id'";
      if ($check_result = $db->query($check))
        output(1, "Your list has been successfully deleted");
      output(2, "Your request has failed");
    }


    function create_list($title, $subtitle, $id_folder, $id_user)
    {
      global $db;
      connect_db($db);
      $title = mysqli_real_escape_string($db, $title);
      $subtitle = mysqli_real_escape_string($db, $subtitle);
      $id_folder = mysqli_real_escape_string($db, $id_folder);
      $id_user = mysqli_real_escape_string($db, $id_user);
      $request = "INSERT INTO `lists` (`id`, `id_user`, `id_folder`, `title`, `subtitle`, `text`, `checkboxes`) VALUES (NULL, '$id_user', '$id_folder', '$title', '$subtitle', '', '[]');";
      if (!$db->query($request))
        output(2, "Error during request execution");
      output(1, $db->insert_id);
    }

    function update_list($id, $page)
    {
      global $db;
      connect_db($db);
      $id = mysqli_real_escape_string($db, $id);
      $data = json_decode($page);
      $title = mysqli_real_escape_string($db, $data->title);
      $subtitle = mysqli_real_escape_string($db, $data->subtitle);
      $text = mysqli_real_escape_string($db, $data->text);
      foreach ($data->tasks as $task)
        $task->label = utf8_encode(mysqli_real_escape_string($db, $task->label));
      $tasks = json_encode($data->tasks);
      $request = "UPDATE `lists` SET `title` = '$title', `subtitle` = '$subtitle', `text` = '$text', `checkboxes` = '$tasks' WHERE `lists`.`id` = $id";
      if (!$db->query($request))
        output(2, "Error during request execution");
      output(1, "List has been successfully updated");
    }

    function in_folder($folder, &$folders)
    {
      foreach ($folders as &$item)
      {
        if ($item["label"] == $folder)
        {
          $item["count"] += 1;
          return ;
        }
      }
      $folders[] = [
        "label" => $folder,
        "count" => 1
      ];
      return ;
    }

    function list_folder($id_user)
    {
      global $db;
      connect_db($db);
      $folders = [
          [
            "label" => "My Lists",
            "count" => 0
          ],
          [
            "label" => "Important",
            "count" => 0
          ],
          [
            "label" => "Archived",
            "count" => 0
          ],
          [
            "label" => "Deleted",
            "count" => 0
          ]
      ];
      $id_user = mysqli_real_escape_string($db, $id_user);
      $sql = "SELECT * FROM `lists` WHERE `id_user` = '$id_user'";
      $result = $db->query($sql);
      while ($row = $result->fetch_array(MYSQLI_ASSOC))
          in_folder($row["id_folder"], $folders);
      output(1, json_encode($folders));
    }

    function change_folder($id_folder, $id)
    {
      global $db;
      connect_db();
      $id = mysqli_real_escape_string($db, $id);
      $id_folder = mysqli_real_escape_string($db, $id_folder);
      $check = "UPDATE `lists` SET `id_folder` = '$id_folder' WHERE `lists`.`id` = $id;";
      if ($check_result = $db->query($check))
        output(1, "Your list is successfully moved in $id_folder");
      output(2, "Your request has failed");
    }
?>
