<?php
$url = "http://localhost/goldlists/api.php?service=listing&id_user=12&id_folder=-1";
$lists = json_decode(json_decode(file_get_contents($url))->message);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <link rel="stylesheet" href="./css/lists.css">
        <link rel="stylesheet" href="./css/lists_desktop.css" media="screen and (min-width: 800px)">
        <?php include_once("includes.php"); ?>
        <title>GoldLists - My lists</title>
    </head>
    <body>
        <div id="off-canvas">
            <h2>GoldLists</h2>
            <ul>
                <li class="activated"><a href="#"><span class="badge">7</span>My Lists</a></li>
                <li><a href="#"><span class="badge">2</span>Important</a></li>
                <li><a href="#"><span class="badge">0</span>Archived</a></li>
                <li><a href="#"><span class="badge">1</span>Deleted</a></li>
                <li><a href="#"><i class="fas fa-plus"></i>Create folder</a></li>
            </ul>
            <img src="./res/illustration-menu.svg" alt="">
        </div>
        <div id="page">
            <nav>
                    <button type="button" name="button" onclick="toggle_menu()">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1>My Lists</h1>
                    <button type="button" name="button" onclick="toggle_add()">
                        <i class="fas fa-plus"></i>
                    </button>
            </nav>
            <div id="list-container">
                <?php
                foreach ($lists as $list) {
                 ?>
                <div class="list" onclick="document.location.href='./list.php?id=<?php echo $list->id; ?>';">
                    <h3><?php echo $list->title;?></h3>
                    <h5><?php echo $list->subtitle;?></h5>
                    <pre><?php echo $list->text;?></pre>
                    <?php if (strlen($list->text) > 0 && count(json_decode($list->checkboxes)) > 0) { ?>
                    <div id="separator"></div> <?php } ?>
                    <ul class="task-list">
                        <?php foreach (json_decode($list->checkboxes) as $checkbox) { ?>
                            <li <?php if ($checkbox->checked) { ?> class="done" <?php } ?>><div id="checkbox"></div><?php echo $checkbox->label; ?></li>
                        <?php } ?>
                    </ul>
                </div>
                <?php } ?>

            </div>
        </div>

    <script src="./js/lists.js"></script>
    </body>
</html>
