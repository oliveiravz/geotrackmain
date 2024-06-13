<?php

namespace App\models;

class Coord extends Model
{
    protected static $tableName = 'coord';
    protected static $columns = [
        'latitude',
        'longitude',
        'id'
    ];

    public function newCoord($values)
    {   
        var_dump($values);
        $coords = json_decode($values, true);

        foreach ($coords as $key => $value) {
            $coords[$key] = str_replace(["-", "."], "", $value);
        }
        
        $values = json_encode($coords);
        
        if (!empty($values)) {
            return parent::insert($values);
        }else{
            return false;
        }
    }
}