<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    use HasFactory;
    protected $table='car_models';
    protected $fillable = ['brand','title','uri'];



    public function generations()
    {
        return $this->hasMany(Generation::class, 'carmodel_id', 'id');
    }
}
