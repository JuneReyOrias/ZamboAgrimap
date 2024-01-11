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
    public function seeds(){
        return$this->hasMany(Seed::class, 'seeds_id','id');
    }
    public function fertilizers(){
        return$this->hasMany(Fertilizer::class, 'fertilizers_id','id');
    }
    public function labors(){
        return$this->hasMany(Labor::class, 'labors_id','id');
    }
    public function pesticides(){
        return$this->hasMany(Pesticide::class, 'pesticides_id','id');
    }
    public function transports(){
        return$this->hasMany(Transport::class, 'transports_id','id');
    }
}
