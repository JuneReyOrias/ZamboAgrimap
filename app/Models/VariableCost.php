<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariableCost extends Model
{
    use HasFactory;
    protected $table='variable_costs';
    protected $fillable=[
        'personal_informations_id',
        'farm_profiles_id',
        'seeds_id',
        'labors_id',
        'fertilizers_id',
        'pesticides_id',
        'transports_id',
        'total_machinery_fuel_cost',
        'total_variable_cost',


    ];
    
  
   
    

    // relations to personal info and farm profile
    public function personalinformation()
    {
        return $this->belongsTo(PersonalInformations::class, 'personal_informations_id');
    }

    public function farmprofile()
    {
        return $this->belongsTo(FarmProfile::class, 'farm_profiles_id');
    }
    // relation to seeds
   public function seeds()
  {
      return $this->belongsTo(Seed::class, 'seeds_id');
  }
     // relation to labors
     public function labors()
     {
         return $this->belongsTo(Labor::class, 'labors_id');
     }

      // relation to fertilizers
      public function fertilizers()
      {
          return $this->belongsTo(Fertilizer::class, 'fertilizers_id');
      }
      // relation to pesticides
      public function pesticides()
      {
          return $this->belongsTo(Pesticide::class, 'pesticides_id');
      }

         // relation to transports
         public function transports()
         {
             return $this->belongsTo(Transport::class, 'transports_id');
         }
}
