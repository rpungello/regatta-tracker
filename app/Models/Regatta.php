<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Regatta extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'venue_id',
        'name',
        'date',
    ];

    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }

    protected function casts()
    {
        return [
            'date' => 'date',
        ];
    }
}
