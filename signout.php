<?php
function signout(){
    session_start();
    session_destroy();
    header('Location: ../index.php');
}
signout();
?>