<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
   protected $fillable = [
    'affiliation',
    'name',
    'email',
    'phone',
    'address',
];
 
}

