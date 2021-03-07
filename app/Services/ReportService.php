<?php

    namespace App\Services;


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
                ->select('islands.island_name', 'fishermans.first_name', 'fishermans.last_name', 'trips.trip_hrs', 'trips.number_of_fishers', 'trips.trip_date', 'locations.location_name', 'methods.method_name', 'species.species_name', 'species_trip.weight')
                ->paginate(5);

            return $records;
        }
    }
