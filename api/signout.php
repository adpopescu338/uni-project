<?php
// sig out
session_start();
session_destroy();
header("Location: ../index.html");
?>