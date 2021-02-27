<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpeciesTrip extends Model
{
    use HasFactory;

    protected $table ='species_trip';

    protected $fillable = ['trip_id','species_id','weight'];
   
    // public function fisherman(){

    //     return $this->hasMany(Fisherman::class);
        
    // }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function method()
    {
        return $this->belongsTo(Method::class);
    }
}
