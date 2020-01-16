<!DOCTYPE html>
<?php
include_once('./config.php');
?>
<html lang="en" dir="ltr">

<head>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/login_desktop.css" media="screen and (min-width: 800px)">
    <?php include_once("includes.php"); ?>
    <title>Lists - login</title>
</head>

<body>

    <?php
        if (isset($_GET["error"])) {
            ?>
    <div class="popup">
        <?php echo $_GET["error"]; ?>
    </div>
    <?php } ?>

    <div id="graphics-section">
        <h3>Organize your time <span id="word-changer">better</span></h3>
        <img src="./res/illustration-login.svg" alt="" />
    </div>

    <div id="form-section">
        <div id="drawer">
            <form action="form_login.php" method="POST" id="form" class="form" open>
              <h1>GoldLists</h1>
                <div class="icon-input"><i class="fas fa-user"></i><input name="login" type="text" placeholder="LOGIN" value="<?php if (isset($_GET["login"])) echo $_GET["login"]; ?>"></div>
                <div class="icon-input"><i class="fas fa-key"></i><input name="password" type="password" placeholder="PASSWORD"></div>
                <button type="submit">LOGIN<i class="fas fa-arrow-right"></i></button>
                <span class="no-account" id="no-account">No account yet ?</span>
            </form>
            <form action="form_signup.php" method="POST" id="form-signup" class="form">
                <div class="icon-input"><i class="fas fa-user"></i><input name="login" type="text" placeholder="LOGIN"></div>
                <div class="icon-input"><i class="fas fa-at"></i><input name="mail" type="email" placeholder="EMAIL"></div>
                <div class="icon-input"><i class="fas fa-key"></i><input name="password" type="password" placeholder="PASSWORD"></div>
                <button type="submit" name="button">SIGN UP<i class="fas fa-arrow-right"></i></button>
                <span class="no-account" id="already-account">Already have an account ?</span>
            </form>
        </div>
    </div>

    <script type="text/javascript" src="./js/login.js"></script>
    <script type="text/javascript" src="./js/script.js"></script>
</body>

</html>
