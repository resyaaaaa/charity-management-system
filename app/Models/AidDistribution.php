<?php

// app/Models/AidDistribution.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AidDistribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'beneficiary_id',
        'donation_id',
        'amount',
        'aid_type',
        'distribution_date',
        'remarks'
    ];

    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class);
    }

    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }
}
