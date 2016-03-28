<?php

require __DIR__ . '/autoload.php';

$db = new \App\Db();
var_dump( $db->execute('SHOW DATABASES'));