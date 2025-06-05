<?php

define('DB_USER', 'uql0gwg3affoo');
define('DB_PASSWORD', 'cosw30!2025');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'dbg3rggzgivk5u');

$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
    OR die('Could not connect to MySQL: ' . mysqli_connect_error());

mysqli_set_charset($dbc, 'utf8');
