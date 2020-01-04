<?php
$url = "http://localhost:8888/api.php?service=open_list&id=" . $_GET['id'];
$list = json_decode(json_decode(file_get_contents($url))->message);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <link rel="stylesheet" href="./css/list.css">
        <link rel="stylesheet" href="./css/list.css" media="screen and (min-width: 800px)">
        <?php include_once("includes.php"); ?>
        <title>GoldLists - List</title>
        <script>const id = <?php echo $list->id; ?>;</script>
    </head>
    <body>
        <nav>
                <button type="button" name="button" onclick="document.location.href='./lists.php'">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <h1 contenteditable="true"><?php echo $list->title; ?></h1>
                <div class="action-buttons">
                  <button type="button" onclick="star_list()">
                      <i class="far fa-folder"></i>
                  </button>
                  <button type="button" onclick="star_list()">
                      <i class="far fa-star"></i>
                  </button>
                <button type="button" onclick="remove_list()">
                    <i class="far fa-trash-alt"></i>
                </button>
              </div>
        </nav>
        <div class="scrollable-area">
        <div id="page">
            <h3 contenteditable="true"><?php echo $list->subtitle ?></h3>
            <p id="text" contenteditable="true"><?php echo $list->text; ?></p>
            <?php if (strlen($list->text) > 0 && count(json_decode($list->checkboxes)) > 0) { ?>
            <div id="separator"></div> <?php } ?>
            <ul class="task-list">
                <?php foreach (json_decode($list->checkboxes) as $checkbox) { ?>
                    <li <?php if ($checkbox->checked) { ?> class="done" <?php } ?>><div class="checkbox"></div><span contenteditable="true"><?php echo $checkbox->label; ?></span><i class="fas fa-times" onclick="delete_task(this)"></i></li>
                <?php } ?>
            </ul>
            <button id="add-button" onclick="add_task()"><i class="fas fa-plus"></i>Add task</button>
        </div>
        </div>

    <script src="./js/list.js"></script>
    </body>
</html>
