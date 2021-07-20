<?php

session_start();
//session_destroy();

//$_SESSION['name'] = 'lexx';
setcookie('test', 'test_cookie', time() + 3600); /* срок действия 1 час */


//echo 'cookie ' . htmlspecialchars($_COOKIE["name"]);

//var_dump($_COOKIE);
var_dump($_SESSION);
