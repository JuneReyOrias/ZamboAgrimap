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
    protected $personalInformationId;

    public function __construct($id)
    {
        // Set the personalInformationId to the provided $id
        $this->personalInformationId = $id;
    }

    public function sheets(): array
    {
        return [
            'Personal Informations' => new PersonalInformationsImport(),
            'FarmProfile' => new ImportFarmProfile($this->personalInformationId),
            'Fixed Cost' => new ImportFixedCost($this->personalInformationId),
            'Machineries Used' => new ImportMachineriesUsed($this->personalInformationId),
            'Variable Cost' => new ImportVariableCost($this->personalInformationId),
            'Seed' => new ImportSeed($this->personalInformationId),
            'Labor' => new ImportLabor($this->personalInformationId),
            'Fertilizer' => new ImportFertilizer($this->personalInformationId),
            'Pesticides' => new ImportPesticide($this->personalInformationId),
            'Transport' => new ImportTransport($this->personalInformationId),
            'Last Production Data' => new ImportLastProductionDatas($this->personalInformationId),
        ];
    }
}