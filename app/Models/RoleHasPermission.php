<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleHasPermission extends Model
{
    use HasFactory;

    protected $connection = 'dbsystem';

    public function permission(){
        return $this->hasMany('App\Models\Permission');
    }
}
