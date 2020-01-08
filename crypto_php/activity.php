<?php
const TIME_TO_LOGOUT = 300;
if (isset($_SESSION['login'])) {
    if (isset($_COOKIE['active'])) {
        setcookie('active', 'true', time() + TIME_TO_LOGOUT);
    } else {
        unset($_SESSION['login']);
    }
}


