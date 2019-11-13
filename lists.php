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
        </div>

    <script src="./js/lists.js"></script>
    </body>
</html>
