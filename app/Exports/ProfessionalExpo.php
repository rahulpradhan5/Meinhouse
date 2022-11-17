<?php

namespace App\Exports;

use App\Models\ProfessionalExport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProfessionalExpo implements FromCollection,WithHeadings
{
    public function headings():array{
        return[
            'Id',
            'Name',
            'Email',
            'Phone Number',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Assignment::all();
        return collect(ProfessionalExport::getProff());
    }

}
