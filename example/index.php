<?php
session_start();
require_once('/classes/Facebook/Facebook.php');
require_once('/classes/Facebook/User.php');
if (isset($_GET['code'])) {
    $_SESSION['code'] = $_GET['code'];
    header('Location: /profile.php');
} else if (isset($_SESSION['code'])) //&& !isset($_GET['code']))
    header('Location: /profile.php');

if (!isset($_SESSION['code']) && !isset($_GET['code']))
    echo '<div style = "margin: 0;
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    -ms-transform: translate(-50%, -50%);
                    transform: translate(-50%, -50%);"><a href="' . Facebook::getAuthLink() . '"><img src=" img/login.png"</img></a></div>';

?>


