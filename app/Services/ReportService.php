<?php

namespace App\Services;
use App\Models\Trip;
use DB;

use App\Models\SpeciesTrip;

// use Illuminate\Support\Facades\Paginator;

class ReportService
{
    public function getTripReport()
    {
        $records = SpeciesTrip::leftjoin('species', 'species.id', '=', 'species_trip.species_id')
            ->leftjoin('trips', 'trips.id', '=', 'species_trip.trip_id')
            ->leftJoin('fishermans', 'fishermans.id', '=', 'trips.fisherman_id')
            ->leftJoin('locations', 'locations.id', '=', 'trips.location_id')
            ->leftJoin('methods', 'methods.id', '=', 'trips.method_id')
            ->leftJoin('islands', 'islands.id', '=', 'fishermans.island_id')
            ->select('islands.island_name', 'first_name', 'last_name', 'trip_hrs', 'number_of_fishers', 'trip_date', 'location_name', 'method_name', 'species_name', 'weight')
            ->paginate(5);

        return $records;
    }

    public function getSumOfweightByMonth2()
    {
        $records = SpeciesTrip::leftjoin('species', 'species.id', '=', 'species_trip.species_id')
            ->leftjoin('trips', 'trips.id', '=', 'species_trip.trip_id')
            ->leftJoin('fishermans', 'fishermans.id', '=', 'trips.fisherman_id')
            ->leftJoin('locations', 'locations.id', '=', 'trips.location_id')
            ->leftJoin('methods', 'methods.id', '=', 'trips.method_id')
            ->leftJoin('islands', 'islands.id', '=', 'fishermans.island_id')
            ->select(DB::raw('MONTHNAME(trip_date) as Month'), DB::raw('YEAR(trip_date) as Year'),'island_name', 'species_name','trip_date',   DB::raw('sum(weight) as total_weight'))
            ->groupBy('island_name', 'species_name','trip_date')
            ->get();


        return $records;
    }

    public function getSumOfweightByMonth()
    {
        $records = SpeciesTrip::query()
            ->leftJoin('species', 'species.id', '=', 'species_trip.species_id')
            ->leftJoin('trips', 'trips.id', '=', 'species_trip.trip_id')
            ->leftJoin('fishermans', 'fishermans.id', '=', 'trips.fisherman_id')
            ->leftJoin('locations', 'locations.id', '=', 'trips.location_id')
            ->leftJoin('methods', 'methods.id', '=', 'trips.method_id')
            ->leftJoin('islands', 'islands.id', '=', 'fishermans.island_id')
            ->select(DB::raw("DATE_FORMAT(trips.trip_date,'%b') as Month"),DB::raw("DATE_FORMAT(trips.trip_date,'%Y') as Year"),'island_name', 'species_name',  DB::raw('sum(weight) as total_weight'))
            ->groupBy('Month','Year', 'island_name', 'species_name')
            ->get();

        return $records;
    }

    public function getSumOfweightByYear()
    {
        $records = SpeciesTrip::query()
            ->leftJoin('species', 'species.id', '=', 'species_trip.species_id')
            ->leftJoin('trips', 'trips.id', '=', 'species_trip.trip_id')
            ->leftJoin('fishermans', 'fishermans.id', '=', 'trips.fisherman_id')
            ->leftJoin('locations', 'locations.id', '=', 'trips.location_id')
            ->leftJoin('methods', 'methods.id', '=', 'trips.method_id')
            ->leftJoin('islands', 'islands.id', '=', 'fishermans.island_id')
            ->select(DB::raw("DATE_FORMAT(trips.trip_date,'%Y') as Year"),'island_name',  DB::raw('sum(weight) as total_weight'))
            ->groupBy('Year', 'island_name')
            ->get();

        return $records;
    }

    public function catctUnitEffortByIslandByYear()
       {
//        $records = SpeciesTrip::query()
//            ->leftJoin('species', 'species.id', '=', 'species_trip.species_id')
//            ->leftJoin('trips', 'trips.id', '=', 'species_trip.trip_id')
//            ->leftJoin('fishermans', 'fishermans.id', '=', 'trips.fisherman_id')
//            ->leftJoin('locations', 'locations.id', '=', 'trips.location_id')
//            ->leftJoin('methods', 'methods.id', '=', 'trips.method_id')
//            ->leftJoin('islands', 'islands.id', '=', 'fishermans.island_id')

        $records = Trip::query()
            ->leftJoin('islands', 'islands.id', '=', 'fishermans.island_id')
            ->select(
                DB::raw("DATE_FORMAT(trips.trip_date,'%Y') as Year"),
                'island_name',
                DB::raw('sum(weight) / ( avg(trip_hrs) / avg(number_of_fishers)) as cpue')
            )
            ->groupBy('Year', 'island_name')
            ->get();

        return $records;
    }

}
