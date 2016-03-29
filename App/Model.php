<?php

namespace App;


class Model
{
    const Table = '';

    public static function findAll()
    {
        $db = new Db();
        return $db->query('SELECT * FROM ' . static::TABLE, static::class);
    }
}