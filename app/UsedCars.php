<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsedCars extends Model
{
    protected $table = 'used_cars';
    protected $fillable = ['year', 'model', 'color','mileage','image'];
}
