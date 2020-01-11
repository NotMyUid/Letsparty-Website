<?php
    session_start();
    // remove all session variables
    // destroy the session
    session_destroy();
    header('Location: ../html/Index.html');
?>