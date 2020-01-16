<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('./config.php');
$url = "$global_url/api.php?service=open_list&id=" . $_GET['id'];
$list = json_decode(json_decode(file_get_contents($url))->message);
$url_folders = "$global_url/api.php?service=list_folder&id_user=" . $_COOKIE["id"];
$folders = json_decode(json_decode(file_get_contents($url_folders))->message);
$folders_to_remove = ["Deleted"];
// foreach ($folders as $folder)
//   if (in_array($folder->label, $folders_to_remove))
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <link rel="stylesheet" href="./css/list.css">
        <link rel="stylesheet" href="./css/list.css" media="screen and (min-width: 800px)">
        <?php include_once("includes.php"); ?>
        <title>GoldLists - List</title>
        <script>
        const id_folder = "<?php echo $list->id_folder;?>";
        const id = <?php echo $list->id;?>;
        const global_url = "<?php echo $global_url; ?>";
        </script>
    </head>
    <body>
      <div class="modal">
        <div class="header">
          <h2>Select folder</h2>
          <button type="button" onclick="open_modal()"><i class="fas fa-times"></i></button>
        </div>
        <div class="content">
          <div id="two-forms">
          <div>
            <h4>Choose an existing folder</h4>
            <select id="folder-name-existing">
              <?php foreach ($folders as $folder) { ?>
                <option value="<?php echo $folder->label; ?>"><?php echo $folder->label; ?></option>
              <?php } ?>
            </select>
          </div>
          <div>
            <span>or</span>
          </div>
          <div>
            <h4>Create a custom folder</h4>
            <input type="text" placeholder="Folder name" id="folder-name-custom">
          </div>
        </div>
        <div><button id="change-folder-button">Change folder</button></div>
        </div>
      </div>
        <nav>
                <button type="button" name="button" onclick="document.location.href='./lists.php?folder=<?php echo $_GET['callback']; ?>'">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <h1 contenteditable="true"><?php echo $list->title; ?></h1>
                <div class="action-buttons">
                  <button type="button" onclick="open_modal()">
                      <i class="far fa-folder"></i>
                  </button>
                  <button type="button" onclick="star_list()">
                    <?php if ($list->id_folder != "Important") {?>
                      <i class="far fa-star"></i> <?php } else {?>
                        <i class="fas fa-star"></i>
                      <?php } ?>
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
