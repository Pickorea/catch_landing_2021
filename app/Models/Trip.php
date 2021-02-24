<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Trip extends Model
{
    use HasFactory;

    protected $table ='trips';

    protected $fillable = ['fisherman_id','trip_hrs','number_of_fishers', 'trip_date', 'location_id', 'method_id'];

    public function fisherman(){

        return $this->belongsTo(Fisherman::class);
    }

    public function species()
    {
        return $this->belongsToMany(Species::class,'species_trip')->withPivot(['species_id'],['weight']);
       
    }

    public function locations()
    {

        return $this->hasMany(Location::class);

    }

    public function methods()
    {

        return $this->hasMany(Method::class);

    }

    public static function getTrips()
    {
        
       $records = SpeciesTrip::leftjoin('species','species.id','=','species_trip.species_id')
       ->leftjoin('trips','trips.id','=','species_trip.trip_id')
       ->leftJoin('fishermans', 'fishermans.id', '=', 'trips.fisherman_id')
        ->leftJoin('locations', 'locations.id', '=', 'trips.location_id')
        ->leftJoin('methods', 'methods.id', '=', 'trips.method_id')
        ->leftJoin('islands', 'islands.id', '=', 'fishermans.island_id')
      ->select('islands.island_name','fishermans.first_name','fishermans.last_name', 'trips.trip_hrs', 'trips.number_of_fishers','trips.trip_date','locations.location_name', 'methods.method_name', 'species.species_name','species_trip.weight')
                ->get()->toArray();

                 return $records;

    }
   
}
