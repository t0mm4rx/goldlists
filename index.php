<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,400,700|Poppins:200,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/login_desktop.css" media="screen and (min-width: 800px)">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" integrity="sha256-qM7QTJSlvtPSxVRjVWNM2OfTAz/3k5ovHOKmKXuYMO4=" crossorigin="anonymous"></script>
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
        <h1>GoldLists</h1>
        <div id="drawer">
            <form action="form_login.php" method="POST" id="form" class="form" open>
                <div class="icon-input"><i class="fas fa-user"></i><input name="login" type="text" placeholder="LOGIN"></div>
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
