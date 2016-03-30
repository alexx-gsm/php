<?php

namespace App;


abstract class Model
{
    const TABLE = '';

    protected $id;
    
    public static function findById($id)
    {
        $db = Db::instance();
        return $db->query('SELECT * FROM ' . static::TABLE . ' WHERE id=' . $id, static::class)[0];
    }

    public static function findAll()
    {
        $db = Db::instance();
        return $db->query('SELECT * FROM ' . static::TABLE, static::class);
    }

    public function isNew()
    {
        return empty($this->id);
    }

    public function getId()
    {
        return $this->id;
    }

    public function insert()
    {
        if( !$this->isNew() ) {
            return;
        }
        
        $columns = [];
        $values = [];
        
        foreach( $this as $key => $val ) {
            if( 'id' == $key ) {
                continue;
            }
            $columns[] = $key;
            $values[':'.$key] = $val;
            
        }

        $sql = 'INSERT' . ' INTO ' . static::TABLE . '
            (' . implode(',', $columns) . ') 
            VALUES
            (' . implode(',', array_keys($values)) . ')';

        $db = Db::instance();
        $db->execute($sql, $values);
    }

    public function save($id)
    {
        if( $this->isNew() ) {
            return;
        }

        $columns = [];
        $values = [];

        foreach( $this as $key => $val ) {
            if( 'id' == $key ) {
                continue;
            }
            $columns[] = $key . '=:' . $key;
            $values[':'.$key] = $val;
        }

        $sql = 'UPDATE ' . static::TABLE . '
                SET ' . implode(',', $columns) . '
                WHERE id=' .$id;

        $db = Db::instance();
        $db->execute($sql, $values);
    }
    
    public function delete($id)
    {
        if( $this->isNew() ) {
            return;
        }
        
        $sql = 'DELETE' . ' FROM ' . static::TABLE . '
                WHERE id=' .$id;
        
        $db = Db::instance();
        $db->execute($sql);    
    }
}