<?php
function isLoggedIn() {
    return isset($_SESSION['user']);
}

function redirectIfNotLoggedIn() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}
?>
