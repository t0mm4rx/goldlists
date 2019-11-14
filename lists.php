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

                <div class="list">
                    <h3>TODO</h3>
                    <p>
                        Tasks to be done before 01/01/2020.
                    </p>
                    <div id="separator"></div>
                    <ul class="task-list">
                        <li><div id="checkbox"></div>Call Micheal</li>
                        <li><div id="checkbox"></div>Clean the living room</li>
                        <li><div id="checkbox"></div>Buy bread</li>
                        <li><div id="checkbox"></div>Finish homework</li>
                        <li class="done"><div id="checkbox"></div>Be awesome</li>
                    </ul>
                </div>

                <div class="list">
                    <h3>IT course</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat facere asperiores, voluptas enim nihil, porro temporibus nam, autem beatae assumenda consequuntur soluta hic, harum consectetur. Quis nobis temporibus, neque de nihil, porro temporibus nam...
                    </p>
                </div>

                <div class="list">
                    <h3>Shopping list</h3>
                    <p></p>
                    <ul class="task-list">
                        <li><div id="checkbox"></div>Sugar</li>
                        <li><div id="checkbox"></div>Bread</li>
                        <li><div id="checkbox"></div>Pastas</li>
                        <li><div id="checkbox"></div>Mozarellas</li>
                        <li><div id="checkbox"></div>Salad</li>
                        <li><div id="checkbox"></div>Pesto</li>
                    </ul>
                </div>


            </div>
        </div>

    <script src="./js/lists.js"></script>
    </body>
</html>
