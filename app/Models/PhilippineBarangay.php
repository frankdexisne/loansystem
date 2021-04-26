<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhilippineBarangay extends Model
{
    use HasFactory;

    protected $connection = 'dbsystem';

    public function philippine_city(){
        return $this->belongsTo('App\Models\PhilippineCity','city_municipality_code','city_municipality_code');
    }

    public function philippine_province(){
        return $this->belongsTo('App\Models\PhilippineProvince','province_code','province_code');
    }

    public function philippine_region(){
        return $this->belongsTo('App\Models\PhilippineRegion','region_code','region_code');
    }
}
