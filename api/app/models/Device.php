<?php

namespace App\models;

class Device extends Model
{
    protected static $tableName = 'device';
    protected static $columns = [
        'code',
        'description',
        'id'
    ];

    public function newDevice($values)
    {   
        if (!empty($values)) {
            return parent::insert($values);
        }else{
            return false;
        }
    }
}