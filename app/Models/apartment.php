<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    public function type () {
        return $this->belongsTo(Type::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function messages () {
        return $this->hasMany(Message::class);
    }

    public function views () {
        return $this->belongsToMany(View::class);
    }

    public function sponsors () {
        return $this->belongsToMany(Sponsor::class)->withPivot('expiration_date');;
    }

    public function services () {
        return $this->belongsToMany(Service::class);
    }

    public function images () {
        return $this->belongsToMany(Image::class);
    }

    protected $fillable = [
        'title',
        'type_id',
        'user_id',
        'slug',
        'description',
        'price',
        'square_meters',
        'num_of_room',
        'num_of_bed',
        'num_of_bathroom',
        'address',
        'lat',
        'lon',
        'image_path',
        'visible'
    ];
}
