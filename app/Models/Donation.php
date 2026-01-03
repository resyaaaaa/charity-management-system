<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'donor_id',
        'amount',
        'donation_type',
        'campaign',
        'donation_date',
        'notes',
    ];

    // Relation to donor
    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }
}
