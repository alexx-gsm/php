<?php

namespace App\Models;

use App\Model;

class User extends Model implements hasEmail
{
    const TABLE = 'users';

    public $name;
    public $email;

    public function getEmail()
    {
        return $this->email;
    }
    
}