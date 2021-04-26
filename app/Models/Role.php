<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $connection = 'dbsystem';

    protected $fillable=['name','guard_name'];

    public function role_has_permission(){
        return $this->hasMany('App\Models\RoleHasPermission','role_id','role_id');
    }

    public function permissions(): BelongsToMany{
        return $this->belongsToMany('App\Models\Permission','App\Models\RoleHasPermission','role_id','permission_id');
    }

    
}
