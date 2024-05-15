<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineriesUseds extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table="machineries_useds";
    protected $fillable=[
        'personal_informations_id',
        'farm_profiles_id',
        'plowing_machineries_used',
        'plo_ownership_status',
        'no_of_plowing',
        'plowing_cost',
        'harrowing_machineries_used',
        'harro_ownership_status',
        'no_of_harrowing',
        'harrowing_cost',
        'harvesting_machineries_used',
        'harvest_ownership_status',
        'harvesting_cost',
        'postharvest_machineries_used',
        'postharv_ownership_status',
        'post_harvest_cost',
        'total_cost_for_machineries',
       
    ];

    public function farmprofiles()
    {
        return $this->belongsTo(FarmProfile::class,'farm_profiles_id','id')->withDefault();
    }
    public function personalInformations()
{
    return $this->belongsTo(PersonalInformations::class,'personal_informations_id','id')->withDefault();
}

public function personalinformation()
{
    return $this->belongsTo(PersonalInformations::class, 'personal_informations_id');
}

public function farmprofile()
{
    return $this->belongsTo(FarmProfile::class, 'farm_profiles_id');
}
}
