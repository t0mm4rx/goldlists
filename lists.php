<?php
include_once('./config.php');

// Function that limits an array to n elements (used to crop items in preview)
function max_array($array, $n)
{
  $res = [];
  $target = min(count($array), $n);
  for ($i = 0; $i < $target; $i++) {
    $res[] = $array[$i];
  }
  return $res;
}

if (!isset($_GET["folder"]))
  $folder = urlencode("My Lists");
else
  $folder = urlencode($_GET["folder"]);
$url = "$global_url/api.php?service=listing&id_user=" . $_COOKIE["id"] . "&id_folder=$folder";
$url_folders = "$global_url/api.php?service=list_folder&id_user=" . $_COOKIE["id"];
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

      <div class="modal">
        <div class="header">
          <h2>Create a new list</h2>
          <button type="button"><i class="fas fa-times"></i></button>
        </div>
        <div class="content">
          <div>
          <input type="text" id="title" placeholder="Title">
          <input type="text" id="subtitle" placeholder="Subtitle">
          <button type="button" id="create-button"><i class="fas fa-plus"></i>Create</button>
        </div>
        <div>
          <img src="./res/illustration-new.svg">
        </div>
        </div>
      </div>

        <div id="off-canvas">
            <h2>GoldLists</h2>
            <ul>
                <?php foreach ($folders as $item) { ?>
                      <li <?php if ($item->label == urldecode($folder)) echo 'class="activated"'; ?>><a href="./lists.php?folder=<?php echo $item->label; ?>"><span class="badge"><?php echo $item->count; ?></span><?php echo $item->label; ?></a></li>
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
                    <div class="action-buttons">
                    <?php if (urldecode($folder) == 'My Lists') { ?>
                    <button type="button" name="button" onclick="toggle_modal()">
                        <i class="fas fa-plus"></i>
                    </button>
                  <?php } ?>
                  </div>
            </nav>
            <?php if (count($lists) == 0) { ?>
              <div id="no-list">
                <span>No list here !</span>
                <img src="./res/illustration-empty.svg" class="fadein">
              </div>
            <?php } ?>
            <div class="scrollable-area">
            <div id="list-container">
                <?php
                foreach ($lists as $list) {
                 ?>
                <div class="list" onclick="document.location.href='./list.php?id=<?php echo $list->id; ?>&callback=<?php echo $folder; ?>';">
                    <h3><?php echo $list->title;?></h3>
                    <h5><?php echo $list->subtitle;?></h5>
                    <p><?php echo $list->text;?></p>
                    <?php if (strlen($list->text) > 0 && count(json_decode($list->checkboxes)) > 0) { ?>
                    <div id="separator"></div> <?php } ?>
                    <ul class="task-list">
                        <?php foreach (max_array(json_decode($list->checkboxes), 5) as $checkbox) { ?>
                            <li <?php if ($checkbox->checked) { ?> class="done" <?php } ?>><div class="checkbox"></div><?php echo $checkbox->label; ?></li>
                        <?php } ?>
                        <?php if (count(json_decode($list->checkboxes)) > 5) { ?>
                        <li class="more-items"><span><?php echo count(json_decode($list->checkboxes)) - 5; ?> more items...</span></li>
                      <?php } ?>
                    </ul>
                </div>
                <?php } ?>

            </div>
        </div>
      </div>

    <script src="./js/lists.js"></script>
    <script src="./js/script.js"></script>
    </body>
</html>
