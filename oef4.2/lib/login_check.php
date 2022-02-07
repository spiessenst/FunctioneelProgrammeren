<?php
require_once "autoload.php";

if ( LoginCheck() )
{

    header( "Location: ../steden.php" );

}
else
{
    unset( $_SESSION['user'] ) ;
    header( "Location: ../no_access.php" );
}

function LoginCheck()
{

    $validUser = $validPass = "";


    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //controle CSRF token
        if (!key_exists("csrf", $_POST)) die("Missing CSRF");
        if (!hash_equals($_POST['csrf'], $_SESSION['lastest_csrf'])) die("Problem with CSRF");

        $_SESSION['lastest_csrf'] = "";

        $_POST = StripSpaces($_POST);


        $sql = "SELECT * FROM user WHERE usr_email='" . $_POST['usr_email'] . "'";
        $rows = GetData($sql);


        if (key_exists("usr_email", $_POST)) {
            if ($rows > 0) $validUser = true;
            else $validUser = false;
        }
        if (key_exists("usr_password", $_POST)) {

            if (password_verify($_POST['usr_password'], $rows[0]['usr_password'])) $validPass = true;
            else $validPass = false;
        }

        if ($validUser == true && $validPass == true){
            $_SESSION['user'] = $_POST ;
            $_SESSION['msgs'] = 'Welkom, ' . ucfirst($rows[0]['usr_voornaam']);

            return true;
        }

}
}


