<?php

require "libs/rb.php";
R::setup( 'mysql:host=localhost;dbname=users_nsk',
        'root', 'root' );

session_start();
?>