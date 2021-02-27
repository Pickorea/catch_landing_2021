<?php

namespace App\Imports;

use App\Models\Trip;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\withHeadingRow;

class TripReport implements ToModel, withHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Trip([
            //
            'fisherman_id'          =>         $row['fisherman_id'],
            'trip_hrs'              =>         $row['trip_hrs'],
             'number_of_fishers'    =>         $row['number_of_fishers'],
            'trip_date'             =>         $row['trip_date'],
             'location_id'          =>         $row['location_id'],
            'method_id'             =>         $row['method_id'],
        ]);
    }
}
