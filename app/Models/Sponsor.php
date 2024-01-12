<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;

    public function apartments () {
        return $this->hasMany(Apartment::class);
    }

    protected $fillable = [
        'name',
        'description',
        'price',
        'duration'
    ];
}
