<?php

namespace App\ModelFolder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CarModel extends Model
{
    //
    protected $table = 'car_models';
    protected $primaryKeys = 'id';

    //car model belongs to a car

    public function cars()
    {
        // return $this->belongsTo(cars::class);
        return $this->belongsTo('App\ModelFolder\cars', 'car_id');
    }
}
