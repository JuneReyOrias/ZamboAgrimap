<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FarmProfile;
class PersonalInformations extends Model
{
    use HasFactory;
 protected $table ='personal_informations';

    protected $fillable=[
   
      
       'agri_districts_id',
       'crop_categorys_id',
       'livestock_categorys_id',
       'fisheries_categories_id',
       'first_name',
       'middle_name',
       'last_name',
       'extension_name',
       'home_address',
       'sex',
       'religion',
       'date_of_birth',
       'place_of_birth',
       'contact_no',
       'civil_status',
       'name_legal_spouse',
       'no_of_children',
       'mothers_maiden_name',
       'highest_formal_education',
       'person_with_disability',
       'pwd_id_no',
       'government_issued_id',
       'id_type',
       'gov_id_no',
       'member_ofany_farmers_ass_org_coop',
       'nameof_farmers_ass_org_coop',
       'name_contact_person',
       'cp_tel_no',
       'users_id',
      'personal_photo',
      'city',
      'image',
      
    ];

         // relationship  machineries used farm profiles
 public function lastProduction()
 {
     return $this->hasMany(LastProductionDatas::class, 'personal_informations_id');
 }
     // relationship  machineries used farm profiles
 public function variableCosts()
 {
     return $this->hasMany(VariableCost::class, 'personal_informations_id');
 }
 // relationship  machineries used farm profiles
 public function machineries()
 {
     return $this->hasMany(MachineriesUseds::class, 'personal_informations_id');
 }
  // relatioship  fixed farm profiles
    public function fixedCosts()
    {
        return $this->hasMany(FixedCost::class, 'personal_informations_id');
    }
 // relatioship  farmprofiles farm profiles
    public function farmProfiles()
    {
        return $this->hasMany(FarmProfile::class, 'personal_informations_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'id','users_id', )->withDefault();
    }

    // Define the relationship with FarmProfile
    // public function farmProfiles()
    // {
    //     return $this->hasMany(FarmProfile::class,'id','personal_informations_id')->withDefault();
    // }
    public function fixedcost()
    {
        return $this->hasMany(FixedCost::class, 'id','personal_informations_id');
    }
    public function Machineriesuseds()
    {
        return $this->hasMany(MachineriesUseds::class, 'id','personal_informations_id');
    }
    public function variablecost()
    {
        return $this->hasMany(VariableCost::class, 'id','personal_informations_id');
    }
    
    // protected static function boot()
    // {
    //     parent::boot();

    //     // Listen for the 'created' event
    //     static::created(function ($personalInformations) {
    //         // Automatically fetch the related PersonalInformation
    //         $personalInformations->load('farmProfile');
    //     });
    // }
}
//     public function VariableCost(){
//         return$this->hasOne(\app\VariableCost::class);
//     }
//     public function FixedCost(){
//         return$this->hasOne(\app\FixedCost::class);
//     }
//     public function LastProduction(){
//         return$this->hasOne(\app\LastProduction::class);
//     }
//     public function MachineriesUsed(){
//         return$this->hasMany(\app\MachineriesUsed::class);
//     }
//     public function LastProductionData(){
//         return$this->hasMany(\app\LastProductionData::class);
// }


