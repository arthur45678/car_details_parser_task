<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Generation extends Model
{
    use HasFactory;
    protected $fillable = ['title','market', 'period','img_path','uri','carmodel_id'];

    protected $description = 'Import generations';

    public function model()
    {
        return $this->belongsTo(Carmodel::class, 'carmodel_id', 'id');
    }

}
