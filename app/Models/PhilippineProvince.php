<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhilippineProvince extends Model
{
    use HasFactory;

    protected $connection = 'dbsystem';

    public function philippine_city(){
        return $this->hasMany('App\Models\PhilippineCity','province_code','province_code');
    }

    public function philippine_region(){
        return $this->belongsTo('App\Models\PhilippineRegion','region_code','region_code');
    }

}
