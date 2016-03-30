<?php

use \App\Models\User;

require __DIR__ . '/autoload.php';

//$users = User::findAll();

$user = User::findById(3);
$user->name = 'Maximus';

$user->delete(3);
