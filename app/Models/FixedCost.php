<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixedCost extends Model
{
    use HasFactory;
    protected $table="fixed_costs";
    protected $fillable=[
        'name_of_fertilizer',
        'type_of_fertilizer',
        'no_ofsacks',
        'unitprice_per_sacks',
        'total_cost_fertilizers',
        'users_id',
        'personal_informations_id'
    ];


    public function personalInformations()
{
    return $this->belongsTo(PersonalInformations::class,'personal_informations_id')->withDefault();
}

    public function farmprofiles()
    {
        return $this->belongsTo(FarmProfile::class, 'farm_profiles_id','id')->withDefault();
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
