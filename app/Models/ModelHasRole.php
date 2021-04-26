<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelHasRole extends Model
{
    use HasFactory;

    protected $connection = 'dbsystem';

    public $timestamps = false;

    protected $primaryKey = 'model_id';

    public $incrementing = false;

    protected $fillable = ['model_id','role_id','model_type'];

    public function role(){
        return $this->belongsTo('App\Models\Role');
    }
}
