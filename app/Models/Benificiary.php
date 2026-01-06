<?php

// app/Models/Beneficiary.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'phone',
        'address',
        'assistance_category',
        'status'
    ];

    public function distributions()
    {
        return $this->hasMany(AidDistribution::class);
    }
}
