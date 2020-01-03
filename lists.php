<?php
if (!isset($_GET["folder"]))
  $folder = urlencode("My Lists");
else
  $folder = urlencode($_GET["folder"]);
$url = "http://localhost:8888/api.php?service=listing&id_user=" . $_COOKIE["id"] . "&id_folder=$folder";
$url_folders = "http://localhost:8888/api.php?service=list_folder&id_user=" . $_COOKIE["id"];
$folders = json_decode(json_decode(file_get_contents($url_folders))->message);
$lists = json_decode(json_decode(file_get_contents($url))->message);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <link rel="stylesheet" href="./css/lists.css">
        <link rel="stylesheet" href="./css/lists_desktop.css" media="screen and (min-width: 800px)">
        <?php include_once("includes.php"); ?>
        <title>GoldLists - My lists</title>
        <script>
        const id_folder = "<?php echo $folder; ?>";
        const id = "<?php echo $_COOKIE["id"]; ?>";
        const token = "<?php echo $_COOKIE["token"]; ?>";
        </script>
    </head>
    <body>
        <div id="off-canvas">
            <h2>GoldLists</h2>
            <ul>
                <?php foreach ($folders as $item) { ?>
                      <li <?php if ($item->label == urldecode($folder)) echo 'class="activated"'; ?>><a href="http://localhost:8888/lists.php?&folder=<?php echo $item->label; ?>"><span class="badge"><?php echo $item->count; ?></span><?php echo $item->label; ?></a></li>
                <?php } ?>
            </ul>
            <img src="./res/illustration-menu.svg" alt="">
        </div>
        <div id="page">
            <nav>
                    <button type="button" name="button" onclick="toggle_menu()">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1><?php echo urldecode($folder); ?></h1>
                    <div id="action-button">
                    <?php if (urldecode($folder) == 'My Lists') { ?>
                    <button type="button" name="button" onclick="create_list()">
                        <i class="fas fa-plus"></i>
                    </button>
                  <?php } ?>
                  </div>
            </nav>
            <div id="list-container">
                <?php
                foreach ($lists as $list) {
                 ?>
                <div class="list" onclick="document.location.href='./list.php?id=<?php echo $list->id; ?>';">
                    <h3><?php echo $list->title;?></h3>
                    <h5><?php echo $list->subtitle;?></h5>
                    <p><?php echo $list->text;?></p>
                    <?php if (strlen($list->text) > 0 && count(json_decode($list->checkboxes)) > 0) { ?>
                    <div id="separator"></div> <?php } ?>
                    <ul class="task-list">
                        <?php foreach (json_decode($list->checkboxes) as $checkbox) { ?>
                            <li <?php if ($checkbox->checked) { ?> class="done" <?php } ?>><div class="checkbox"></div><?php echo $checkbox->label; ?></li>
                        <?php } ?>
                    </ul>
                </div>
                <?php } ?>

            </div>
        </div>

    <script src="./js/lists.js"></script>
    </body>
</html>
