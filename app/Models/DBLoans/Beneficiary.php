<?php

namespace App\Models\DBLoans;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;
    protected $connection = 'mysql';

    protected $fillable = ['client_id','lname','fname','mname','gender','relationship_id'];
}
