<?php
$url = "http://localhost/goldlists/api.php?service=open_list&id=" . $_GET['id'];
$list = json_decode(json_decode(file_get_contents($url))->message);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <link rel="stylesheet" href="./css/list.css">
        <link rel="stylesheet" href="./css/list.css" media="screen and (min-width: 800px)">
        <?php include_once("includes.php"); ?>
        <title>GoldLists - List</title>
    </head>
    <body>
        <nav>
                <button type="button" name="button" onclick="document.location.href='./lists.php'">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <h1><?php echo $list->title; ?></h1>
                <button type="button" name="button" onclick="">
                    <i class="far fa-trash-alt"></i>
                </button>
        </nav>

        <div id="page">
            <h3><?php echo $list->subtitle ?></h3>
            <pre>
                <?php echo $list->text; ?>
            </pre>
            <?php if (strlen($list->text) > 0 && count(json_decode($list->checkboxes)) > 0) { ?>
            <div id="separator"></div> <?php } ?>
            <ul class="task-list">
                <?php foreach (json_decode($list->checkboxes) as $checkbox) { ?>
                    <li <?php if ($checkbox->checked) { ?> class="done" <?php } ?>><div id="checkbox"></div><?php echo $checkbox->label; ?></li>
                <?php } ?>
            </ul>
            <button id="add-button"><i class="fas fa-plus"></i>Add task</button>
        </div>

    <script src="./js/list.js"></script>
    </body>
</html>
