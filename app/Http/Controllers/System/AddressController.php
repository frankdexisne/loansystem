<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PhilippineCity;
use App\Models\PhilippineBarangay;
use App\Http\Resources\System\PhilippineCityResource;
use App\Http\Resources\System\PhilippineBarangayResource;
class AddressController extends Controller
{
    public function jsonData(){
        $data = PhilippineCity::where('province_code','0505')->get();
        return PhilippineCityResource::collection($data);
    }

    public function getBarangays($id){
        $data = PhilippineBarangay::where('city_municipality_code',$id)->orderBy('barangay_description','ASC')->get();
        return PhilippineBarangayResource::collection($data);   
    }
}
