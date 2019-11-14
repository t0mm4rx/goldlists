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
                <button type="button" name="button" onclick="toggle_menu()">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <h1>TODO</h1>
                <button type="button" name="button" onclick="">
                    <i class="far fa-trash-alt"></i>
                </button>
        </nav>

        <div id="page">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis neque, ullam necessitatibus maiores rerum est. Accusantium illum, tenetur ipsa ratione obcaecati quasi tempore magnam, voluptas cupiditate magni laborum quis, dolorum.
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo autem ipsa quibusdam soluta doloremque reprehenderit! Aliquam minima consectetur quis. Voluptatem, blanditiis, numquam. Aliquam consequuntur sit, maxime tempore, enim illum vero.
            </p>
            <div id="separator"></div>
            <ul class="task-list">
                <li><div id="checkbox"></div>Call Micheal</li>
                <li><div id="checkbox"></div>Clean the living room</li>
                <li><div id="checkbox"></div>Buy bread</li>
                <li><div id="checkbox"></div>Finish homework</li>
                <li class="done"><div id="checkbox"></div>Be awesome</li>
            </ul>
            <button id="add-button"><i class="fas fa-plus"></i>Add task</button>
        </div>

    <script src="./js/list.js"></script>
    </body>
</html>
