<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Polygon extends Model
{
    use HasFactory;
   protected $table='polygons';
    protected $fillable=[
          // 'user_id',
          'agri_districts_id',
          'verone_latitude',
          'verone_longitude',
          'vertwo_latitude',
          'vertwo_longitude',
          'verthree_latitude',
          'verthree_longitude',
          'vertfour_latitude',
          'vertfour_longitude',
         'verfive_latitude',
         'verfive_longitude',
         'versix_latitude',
         'versix_longitude',
         'verseven_latitude',
         'verseven_longitude',
         'vereight_latitude',
         'verteight_longitude', 
          'verfive_latitude',
         'verfive_longitude',
         'versix_latitude',
         'versix_longitude',
         'verseven_latitude',
         'verseven_longitude',
         'vereight_latitude',
         'verteight_longitude',
          'coordinates',
          'strokecolor',
          'area',
          'perimeter',
       
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'users_id','id' )->withDefault();
    }
    public function agridistricts ()
    {
        return $this->belongsTo(AgriDistrict::class,'agri_districts_id','id')->withDefault();
    }
    public function farmprofile()
    {
        return $this->hasOne(FarmProfile::class,'id','polygons_id' );
    }

}
