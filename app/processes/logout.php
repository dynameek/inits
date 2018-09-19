<?php
    #
    session_destroy();
    $_SESSION = null;
    $_COOKIE = null;
    unset($_SESSION);
    unset($_COOKIE);
    
    header('Location: ./');