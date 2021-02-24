<?php

namespace App\Exports;

use App\Models\Trip;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\withHeadings;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Facades\Excel;

class TripExport implements FromCollection,withHeadings
{

    public function headings():array{

        return[
            'Island Name',
            'First Name',
             'Last Name ',
             'Trip Hrs',
            'Nbrs of Fisherman' ,
             'Trip Date',
            'Fishing Area' ,
            'Fishing Methods' ,     
            'Species Name',
            'Weight'           
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect(Trip::getTrips());
    }
}
