<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\ImportFarmProfile;
use App\Models\PersonalInformations;
class ImportMultipleFile implements WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            'Personal Informations'=> new PersonalInformationsImport(),
            'FarmProfile'=> new  ImportFarmProfile(),
            'Fixed Cost'=> new ImportFixedCost(),
            'Machineries Used'=> new ImportMachineriesUseds(),
            'Variable Cost'=>new ImportVariableCost(),
            'Seed'=> new ImportSeed(),
            'Labor'=> new ImportLabor(),
            'Fertilizer'=> new ImportFertilizer(),
            'Pesticides'=> new ImportPesticide(),
            'Transport'=> new ImportTransport(),
            'Last Production Data'=> new ImportLastProductionDatas(),

        ];
    }
}